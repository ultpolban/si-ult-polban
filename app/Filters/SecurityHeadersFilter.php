<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * SecurityHeadersFilter
 *
 * Menambahkan header keamanan HTTP pada setiap respons sehingga browser
 * menolak sniffing tipe konten, pembungkusan iframe (clickjacking),
 * pengiriman referer lintas situs, dan pembatasan fitur perangkat.
 *
 * Content-Security-Policy dikirim dalam mode REPORT-ONLY karena aplikasi
 * masih memuat aset dari CDN dan memakai script inline. Mode report-only
 * tidak memblokir apa pun, sehingga tidak berisiko memutus tampilan,
 * namun siap diberlakukan (enforce) setelah seluruh inline script
 * dipindahkan ke file terpisah.
 */
class SecurityHeadersFilter implements FilterInterface
{
    /**
     * Daftar aset eksternal yang dipakai aplikasi.
     */
    protected string $cdnScripts = "'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://cdn.datatables.net https://code.jquery.com";

    /**
     * Daftar stylesheet eksternal yang dipakai aplikasi.
     */
    protected string $cdnStyles = "'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://cdn.datatables.net";

    public function before(RequestInterface $request, $arguments = null)
    {
        // Tidak digunakan
        return null;
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        $response->setHeader('X-Content-Type-Options', 'nosniff');
        $response->setHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->setHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->setHeader('X-Permitted-Cross-Domain-Policies', 'none');
        $response->setHeader('Cross-Origin-Opener-Policy', 'same-origin');
        $response->setHeader('Permissions-Policy', 'geolocation=(), microphone=(), camera=(), payment=(), usb=()');

        // Header lama ini dapat memunculkan kerentanan sendiri pada browser
        // modern; perlindungan XSS ditangani sanitasi input + CSP + esc().
        $response->setHeader('X-XSS-Protection', '0');

        // HSTS hanya boleh dikirim melalui koneksi HTTPS.
        if ($request->isSecure()) {
            $response->setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        $response->setHeader('Content-Security-Policy-Report-Only', $this->buildCsp());

        return null;
    }

    /**
     * Susun kebijakan Content Security Policy.
     */
    protected function buildCsp(): string
    {
        $directives = [
            "default-src 'self'",
            "base-uri 'self'",
            "object-src 'none'",
            "frame-ancestors 'self'",
            "form-action 'self'",
            'script-src ' . $this->cdnScripts,
            'style-src ' . $this->cdnStyles,
            "font-src 'self' data: https://cdnjs.cloudflare.com https://cdn.jsdelivr.net",
            "img-src 'self' data: blob:",
            "connect-src 'self'",
            "media-src 'self'",
        ];

        return implode('; ', $directives);
    }
}
