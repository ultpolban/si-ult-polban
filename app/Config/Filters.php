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
     *
     * [filter_name => classname]
     * or [filter_name => [classname1, classname2, ...]]
     */
    public array $aliases = [
        'csrf'            => CSRF::class,
        'toolbar'         => DebugToolbar::class,
        'honeypot'        => Honeypot::class,
        'invalidchars'    => InvalidChars::class,
        'secureheaders'   => SecureHeaders::class,
        'cors'            => Cors::class,
        'forcehttps'      => ForceHTTPS::class,
        'pagecache'       => PageCache::class,
        'performance'     => PerformanceMetrics::class,
        'role'            => \App\Filters\RoleFilter::class,
        'auth'            => \App\Filters\AuthFilter::class,
        'permission'      => \App\Filters\PermissionFilter::class,
        'sanitize'        => \App\Filters\SanitizeInputFilter::class,
        'ratelimit'       => \App\Filters\RateLimitFilter::class,
        'securityheaders' => \App\Filters\SecurityHeadersFilter::class,
    ];

    /**
     * List of special required filters.
     *
     * The filters listed here are special. They are applied before and after
     * other kinds of filters, and always applied even if a route does not exist.
     *
     * Filters set by default provide framework functionality. If removed,
     * those functions will no longer work.
     *
     * @see https://codeigniter.com/user_guide/incoming/filters.html#provided-filters
     *
     * @var array{before: list<string>, after: list<string>}
     */
    public array $required = [
        'before' => [
            'forcehttps', // Force Global Secure Requests
            'pagecache',  // Web Page Caching
        ],
        'after' => [
            'pagecache',   // Web Page Caching
            'performance', // Performance Metrics
            // 'toolbar',     // Debug Toolbar — dinonaktifkan di production
        ],
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array{
     *     before: array<string, array{except: list<string>|string}>|list<string>,
     *     after: array<string, array{except: list<string>|string}>|list<string>
     * }
     */
    public array $globals = [
        'before' => [
            // Rate limit dievaluasi lebih dulu (didahului filter wajib
            // forcehttps & pagecache) supaya flood, brute force, dan spam
            // tertahan sebelum sesi/CSRF diproses. Filter ini hanya
            // membatasi endpoint pada $rateLimitPaths di bawah.
            'ratelimit',
            'csrf',     // Validasi token CSRF untuk semua request POST/PUT/PATCH/DELETE
            'sanitize', // Netralkan payload XSS & tolak signature injection
            // 'honeypot',
            // 'invalidchars',
        ],
        'after' => [
            'securityheaders', // X-Frame-Options, nosniff, Referrer-Policy, CSP report-only
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'POST' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
    public array $filters = [];

    /**
     * Endpoint yang dibatasi RateLimitFilter (per alamat IP).
     *
     * Daftar ini dipakai filter untuk memutuskan apakah request perlu
     * dibatasi, karena `ratelimit` dijalankan sebagai filter global agar
     * dievaluasi lebih dahulu daripada `csrf`. Pola harus cocok PENUH dengan
     * URI relatif terhadap baseURL dan mendukung tanda bintang (*),
     * contoh: 'register/*'.
     *
     * @var list<string>
     */
    public array $rateLimitPaths = [
        'login',
        'login/mfa/verify',
        'register',
        'register/gate',
        'register/mfa/verify',
        'registration-request',
    ];
}
