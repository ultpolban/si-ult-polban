<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Filters as FiltersConfig;
use Throwable;

/**
 * RateLimitFilter
 *
 * Pembatas jumlah request per alamat IP untuk endpoint sensitif
 * (login, registrasi, verifikasi MFA) guna mencegah brute force,
 * credential stuffing, dan pengiriman formulir massal (spam).
 *
 * Didaftarkan pada `Config\Filters::$globals['before']` di posisi paling awal
 * (sebelum `csrf`) agar request yang gagal validasi CSRF pun tetap terhitung,
 * sehingga flood tanpa token tidak bisa menghindari pembatasan.
 * Endpoint yang dibatasi ditentukan oleh `Config\Filters::$rateLimitPaths`;
 * request di luar daftar tersebut langsung dilewatkan.
 *
 * Argumen filter opsional: 'ratelimit:5:300' (maksimal 5 request per 300
 * detik). Tanpa argumen dipakai nilai default 10 request per 60 detik.
 *
 * Riwayat percobaan disimpan pada cache CodeIgniter sehingga tidak menambah
 * query ke database.
 */
class RateLimitFilter implements FilterInterface
{
    /**
     * Jumlah maksimal request yang diizinkan per jendela waktu.
     */
    protected int $maxAttempts = 10;

    /**
     * Panjang jendela waktu (detik).
     */
    protected int $windowSeconds = 60;

    /**
     * Prefix key cache agar tidak bertabrakan dengan data lain.
     */
    protected string $keyPrefix = 'ratelimit_';

    /**
     * Batas panjang daftar riwayat yang disimpan per key.
     */
    protected int $maxHistory = 200;

    /**
     * Dijalankan sebelum controller.
     *
     * @param list<string>|null $arguments
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Filter ini didaftarkan sebagai filter GLOBAL pada Config\Filters
        // (posisi sebelum `csrf`) supaya flood/brute force tertahan lebih
        // dahulu. Karena itu endpoint yang dibatasi diverifikasi di sini.
        if (! $this->isLimitedEndpoint($request)) {
            return null;
        }

        // Hanya batasi request yang mengubah data / berpotensi disalahgunakan.
        if (! in_array(strtoupper($request->getMethod()), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return null;
        }

        [$max, $window] = $this->resolveLimits($arguments);

        $endpoint = $request->getUri()->getPath() !== '' ? $request->getUri()->getPath() : '/';
        $key      = $this->keyPrefix . md5(strtolower($endpoint) . '|' . $request->getIPAddress());
        $now      = time();

        try {
            $cache = cache();

            $history = $cache->get($key);
            $history = is_array($history) ? array_map('intval', $history) : [];

            // Buang catatan di luar jendela waktu.
            $history = array_values(array_filter(
                $history,
                static fn (int $timestamp): bool => ($now - $timestamp) < $window
            ));

            if (count($history) >= $max) {
                return $this->tooManyRequests($request, $history, $now, $window);
            }

            $history[] = $now;

            if (count($history) > $this->maxHistory) {
                $history = array_slice($history, -$this->maxHistory);
            }

            // Disimpan dua kali jendela agar tetap tersedia selama pengamatan.
            $cache->save($key, $history, $window * 2);
        } catch (Throwable $e) {
            // Jangan sampai kegagalan cache membuat aplikasi tidak bisa dipakai.
            log_message('error', 'RateLimitFilter gagal mengakses cache: {message}', [
                'message' => $e->getMessage(),
            ]);
        }

        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Tidak digunakan
    }

    /**
     * Apakah URI termasuk endpoint yang dibatasi rate limit.
     *
     * Daftar endpoint diambil dari Config\Filters::$rateLimitPaths agar
     * konfigurasi terpusat. Pola mendukung tanda bintang (*), seperti
     * 'register/*'.
     */
    protected function isLimitedEndpoint(RequestInterface $request): bool
    {
        $paths = config(FiltersConfig::class)->rateLimitPaths ?? [];

        if ($paths === []) {
            return false;
        }

        $uri = strtolower(trim($request->getUri()->getPath(), '/ '));

        foreach ($paths as $path) {
            $pattern = strtolower(trim((string) $path, '/ '));
            $pattern = str_replace(['/', '*'], ['\\/', '.*'], $pattern);

            if (preg_match('#\A' . $pattern . '\z#u', $uri) === 1) {
                return true;
            }
        }

        return false;
    }

    /**
     * Tentukan batas request dari argumen filter.
     *
     * @param list<string>|null $arguments
     *
     * @return array{0: int, 1: int} [max, window]
     */
    protected function resolveLimits($arguments): array
    {
        $max    = $this->maxAttempts;
        $window = $this->windowSeconds;

        if (is_array($arguments)) {
            if (isset($arguments[0]) && is_numeric($arguments[0])) {
                $max = max(1, (int) $arguments[0]);
            }

            if (isset($arguments[1]) && is_numeric($arguments[1])) {
                $window = max(1, (int) $arguments[1]);
            }
        }

        return [$max, $window];
    }

    /**
     * Bangun respons HTTP 429 beserta header Retry-After.
     *
     * @param list<int> $history
     */
    protected function tooManyRequests(
        RequestInterface $request,
        array $history,
        int $now,
        int $window
    ): ResponseInterface {
        $retryAfter = max(1, $window - ($now - (int) min($history)));

        log_message('warning', 'RateLimitFilter memblokir request uri:{uri} ip:{ip} jumlah:{count}', [
            'uri'   => $request->getUri()->getPath(),
            'ip'    => $request->getIPAddress(),
            'count' => count($history),
        ]);

        $response = service('response');

        $response->setStatusCode(429)
            ->setHeader('Retry-After', (string) $retryAfter)
            ->setHeader('X-Robots-Tag', 'noindex, nofollow');

        if ($request->isAJAX()) {
            return $response->setJSON([
                'status'      => 'error',
                'message'     => 'Terlalu banyak permintaan. Silakan coba beberapa saat lagi.',
                'retry_after' => $retryAfter,
            ]);
        }

        return $response->setBody(view('errors/rate_limited', ['retryAfter' => $retryAfter]));
    }
}
