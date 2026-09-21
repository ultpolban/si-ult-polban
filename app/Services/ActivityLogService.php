<?php

namespace App\Services;

use App\Models\ActivityLogModel;

class ActivityLogService
{
    protected ActivityLogModel $model;

    public function __construct()
    {
        $this->model = new ActivityLogModel();
    }

    public function getList(string $keyword = '', int $perPage = 15)
    {
        $builder = $this->model->getComplete();

        if ($keyword !== '') {
            $builder = $builder->search($keyword);
        }

        return [
            'logs'  => $builder->paginate($perPage),
            'pager' => $this->model->pager,
        ];
    }

    public function getById(int $id): ?array
    {
        return $this->model->getComplete()->find($id);
    }

    public function storeLog(array $data): int
    {
        if (! $this->model->insert(self::buildRow($data))) {
            return 0;
        }

        return (int) $this->model->getInsertID();
    }

    /**
     * Susun baris activity log yang aman dari data kendali pengguna.
     *
     * Sengaja murni (tanpa akses DB) agar mudah diuji: nilai seperti email,
     * deskripsi, dan user agent dibersihkan dari tag HTML, null byte, dan
     * karakter kontrol; `action`/`module` dibatasi pada karakter aman;
     * email & deskripsi disimpan terstruktur pada kolom JSON `new_data`
     * sehingga tidak pernah dirangkai mentah ke string bebas. Saat
     * ditampilkan, view tetap wajib memakai esc().
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public static function buildRow(array $data): array
    {
        $meta = [];

        if (array_key_exists('description', $data)) {
            $description = self::sanitizeText($data['description'], 1000);

            if ($description !== '') {
                $meta['description'] = $description;
            }
        }

        if (array_key_exists('email', $data)) {
            $email = strtolower(trim((string) $data['email']));

            if ($email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL) !== false) {
                $meta['email'] = mb_substr($email, 0, 150);
            }
        }

        $referenceId = array_key_exists('reference_id', $data) && $data['reference_id'] !== null
            ? self::sanitizeText($data['reference_id'], 100)
            : '';

        return [
            'user_id'      => isset($data['user_id']) ? (int) $data['user_id'] : null,
            'action'       => self::slug((string) ($data['action'] ?? ''), 100, 'unknown'),
            'module'       => self::slug((string) ($data['module'] ?? ''), 100, 'general'),
            'reference_id' => $referenceId !== '' ? $referenceId : null,
            'old_data'     => self::encodeJson($data['old_data'] ?? null),
            'new_data'     => self::encodeJson(self::mergeNewData($data['new_data'] ?? null, $meta)),
            'ip_address'   => array_key_exists('ip_address', $data) && $data['ip_address'] !== null
                ? self::sanitizeText($data['ip_address'], 45)
                : null,
            'user_agent'   => array_key_exists('user_agent', $data) && $data['user_agent'] !== null
                ? self::sanitizeText($data['user_agent'], 1000)
                : null,
            'created_at'   => $data['created_at'] ?? date('Y-m-d H:i:s'),
        ];
    }

    /**
     * Batasi action/module pada karakter aman [A-Za-z0-9_.-].
     */
    public static function slug(string $value, int $max, string $fallback): string
    {
        $value = mb_substr(trim($value), 0, $max);
        $value = (string) preg_replace('/[^A-Za-z0-9_.\-]/', '', $value);

        return $value !== '' ? $value : $fallback;
    }

    /**
     * Bersihkan teks bebas dari tag HTML, null byte, dan karakter kontrol.
     */
    public static function sanitizeText(mixed $value, int $max = 1000): string
    {
        if (! is_scalar($value)) {
            return '';
        }

        $text = strip_tags((string) $value);
        $text = (string) preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $text);
        $text = trim((string) preg_replace('/\s+/', ' ', $text));

        return mb_substr($text, 0, $max);
    }

    /**
     * Gabungkan meta aman (description/email) ke new_data milik pemanggil.
     *
     * @param mixed                $current
     * @param array<string, mixed> $meta
     *
     * @return array<string, mixed>|string|null
     */
    protected static function mergeNewData(mixed $current, array $meta): array|string|null
    {
        if ($meta === []) {
            return is_array($current) ? self::sanitizePayload($current) : $current;
        }

        if (is_string($current)) {
            $decoded = json_decode($current, true);
            $current = is_array($decoded) ? $decoded : ['value' => $current];
        }

        if (! is_array($current)) {
            $current = [];
        }

        return array_merge(self::sanitizePayload($current), $meta);
    }

    /**
     * Bersihkan payload array secara rekursif.
     *
     * @param array<mixed> $payload
     *
     * @return array<mixed>
     */
    protected static function sanitizePayload(array $payload): array
    {
        $clean = [];

        foreach ($payload as $key => $value) {
            $clean[$key] = is_array($value)
                ? self::sanitizePayload($value)
                : (is_string($value) ? self::sanitizeText($value, 5000) : $value);
        }

        return $clean;
    }

    /**
     * Normalisasi kolom JSON: array -> string JSON, skalar string dibersihkan.
     */
    protected static function encodeJson(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (is_array($value)) {
            $encoded = json_encode(self::sanitizePayload($value), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            return $encoded !== false ? $encoded : null;
        }

        if (is_scalar($value)) {
            $text = self::sanitizeText($value, 5000);

            return $text !== '' ? $text : null;
        }

        return null;
    }

    public function getModel(): ActivityLogModel
    {
        return $this->model;
    }
}
