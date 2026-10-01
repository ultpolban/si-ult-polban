<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseFilters
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>>
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'      => ForceHTTPS::class,
        'pagecache'       => PageCache::class,
        'performance'     => PerformanceMetrics::class,
        'auth'            => \App\Filters\AuthFilter::class,
        'role'            => \App\Filters\RoleFilter::class,
        'permission'      => \App\Filters\PermissionFilter::class,
        'sanitize'        => \App\Filters\SanitizeInputFilter::class,
        'ratelimit'       => \App\Filters\RateLimitFilter::class,
        'securityheaders' => \App\Filters\SecurityHeadersFilter::class,
    ];

    /**
     * Filter yang selalu dijalankan.
     *
     * forcehttps sengaja tidak digunakan karena
     * aplikasi berjalan di localhost menggunakan HTTP.
     */
    public array $required = [
        'before' => [
            // 'forcehttps', // dikembangkan di localhost (HTTP)
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    /**
     * Global filters.
     *
     * ratelimit + securityheaders aktif. csrf dan sanitize dibiarkan
     * non-aktif karena sebagian view lama (frontend2/3/4) belum
     * menyisipkan csrf_field() pada formulir POST-nya.
     * Aktifkan kembali setelah seluruh form POST diberi token CSRF
     * dengan membuka komentar 'csrf' dan 'sanitize' di bawah.
     */
    public array $globals = [
        'before' => [
            'ratelimit',
            // 'csrf',
            // 'sanitize',
            // 'honeypot',
            // 'invalidchars',
        ],
        'after' => [
            'securityheaders',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * Method filters.
     */
    public array $methods = [];

    /**
     * Filters berdasarkan pola URL.
     */
    public array $filters = [];

    /**
     * Endpoint yang dibatasi RateLimitFilter (per alamat IP).
     *
     * Pola harus cocok PENUH dengan URI relatif terhadap baseURL dan
     * mendukung tanda bintang (*), contoh: 'register/*'.
     *
     * @var list<string>
     */
    public array $rateLimitPaths = [
        'login',
        'login/mfa/verify',
        'register',
        'register/gate',
        'register/mfa/verify',

        // Daftar langung sudah ditutup (route dihapus), tetap
        // dicantumkan agar terlindungi bila suatu saat diaktifkan lagi.
        'register/daftar',

        'registration-request',
        'registration-request/status',
    ];
}
