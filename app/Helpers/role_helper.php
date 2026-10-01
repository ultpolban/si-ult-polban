<?php

/**
 * =====================================================================
 *  ROLE HELPER - SI ULT POLBAN
 * =====================================================================
 *
 *  Sumber tunggal (single source of truth) untuk:
 *   1. Pemetaan ROLE -> dashboard tujuan setelah login
 *   2. Pemetaan JENIS PEMOHON (applicant type) -> dashboard tujuan
 *   3. Definisi MENU per role / per jenis pemohon
 *
 *  Semua halaman (dashboard, sidebar, proses login, route) memakai
 *  helper ini sehingga tidak ada lagi menu yang "nyasar" / error.
 */

if (! function_exists('ult_roles')) {
    /**
     * Seluruh role kanonik aplikasi.
     */
    function ult_roles(): array
    {
        return [
            'SUPER_ADMIN',
            'ADMIN_ULT',
            'PETUGAS_ULT',
            'UNIT_TUJUAN',
            'PIMPINAN',
            'PEMOHON',

            // Role unit lama (tetap dipakai agar data lama tidak rusak)
            'PETUGAS_AKADEMIK',
            'PETUGAS_KEUANGAN',
            'PETUGAS_KEMAHASISWAAN',
            'PETUGAS_PERPUSTAKAAN',
            'PETUGAS_JURUSAN',
            'PETUGAS_TIK',
            'PETUGAS_UMUM',
        ];
    }
}

if (! function_exists('ult_role_group')) {
    /**
     * Kelompokkan role ke dalam grup aplikasi.
     *
     * @return string admin|petugas|unit|pimpinan|pemohon|unknown
     */
    function ult_role_group(?string $roleCode = null): string
    {
        $roleCode = strtoupper(trim((string) ($roleCode ?? ult_current_role_code())));

        return match ($roleCode) {
            'SUPER_ADMIN', 'ADMIN_ULT'  => 'admin',
            'PETUGAS_ULT'                => 'petugas',
            'PIMPINAN'                   => 'pimpinan',
            'UNIT_TUJUAN',
            'PETUGAS_AKADEMIK',
            'PETUGAS_KEUANGAN',
            'PETUGAS_KEMAHASISWAAN',
            'PETUGAS_PERPUSTAKAAN',
            'PETUGAS_JURUSAN',
            'PETUGAS_TIK',
            'PETUGAS_UMUM'               => 'unit',
            'PEMOHON'                    => 'pemohon',
            default                      => 'unknown',
        };
    }
}

if (! function_exists('ult_is_admin')) {
    function ult_is_admin(?string $roleCode = null): bool
    {
        return ult_role_group($roleCode) === 'admin';
    }
}

// ---------------------------------------------------------------------
// SESSION
// ---------------------------------------------------------------------

if (! function_exists('ult_current_role_code')) {
    function ult_current_role_code(): string
    {
        return strtoupper(trim((string) session()->get('role_code')));
    }
}

if (! function_exists('ult_current_role_name')) {
    function ult_current_role_name(): string
    {
        $name = trim((string) session()->get('role_name'));

        return $name !== '' ? $name : 'Pengguna';
    }
}

if (! function_exists('ult_current_user_id')) {
    function ult_current_user_id(): int
    {
        return (int) session()->get('user_id');
    }
}

if (! function_exists('ult_normalize_applicant_code')) {
    /**
     * Samakan variasi penamaan kode jenis pemohon.
     */
    function ult_normalize_applicant_code(string $code): string
    {
        $code = strtoupper(trim($code));

        return match ($code) {
            'MAHASISWA'                        => 'MHS',
            'DOSEN'                            => 'DOSEN',
            'TENDIK', 'TENAGA_KEPENDIDIKAN'     => 'TENDIK',
            'ALUMNI'                           => 'ALUMNI',
            'MITRA'                            => 'MITRA',
            'WALI', 'ORANG_TUA', 'ORANGTUA'    => 'WALI',
            'UMUM', 'MASYARAKAT', 'PUBLIK'     => 'UMUM',
            default                            => $code,
        };
    }
}

if (! function_exists('ult_applicant_labels')) {
    function ult_applicant_labels(): array
    {
        return [
            'MHS'    => 'Mahasiswa',
            'DOSEN'  => 'Dosen',
            'TENDIK' => 'Tenaga Kependidikan',
            'ALUMNI' => 'Alumni',
            'MITRA'  => 'Mitra',
            'WALI'   => 'Orang Tua / Wali',
            'UMUM'   => 'Umum / Masyarakat',
        ];
    }
}

if (! function_exists('ult_current_applicant_code')) {
    /**
     * Kode jenis pemohon aktif (MHS, DOSEN, TENDIK, ALUMNI, MITRA, WALI, UMUM).
     */
    function ult_current_applicant_code(): string
    {
        $code = (string) session()->get('applicant_type_code');

        if (trim($code) === '') {
            $code = (string) session()->get('applicant_type');
        }

        return ult_normalize_applicant_code($code);
    }
}

if (! function_exists('ult_current_applicant_name')) {
    function ult_current_applicant_name(): string
    {
        $code = ult_current_applicant_code();

        return ult_applicant_labels()[$code] ?? 'Pemohon';
    }
}

// ---------------------------------------------------------------------
// DASHBOARD PER ROLE
// ---------------------------------------------------------------------

if (! function_exists('ult_role_dashboard')) {
    /**
     * Dashboard tujuan untuk sebuah role.
     */
    function ult_role_dashboard(?string $roleCode = null): string
    {
        $roleCode = strtoupper(trim((string) ($roleCode ?? ult_current_role_code())));

        $map = [
            'SUPER_ADMIN'           => 'admin/dashboard',
            'ADMIN_ULT'             => 'admin/dashboard',
            'PETUGAS_ULT'           => 'petugas/dashboard',
            'PIMPINAN'              => 'pimpinan/dashboard',
            'UNIT_TUJUAN'           => 'unit/dashboard',
            'PETUGAS_AKADEMIK'      => 'akademik/dashboard',
            'PETUGAS_KEUANGAN'      => 'keuangan/dashboard',
            'PETUGAS_KEMAHASISWAAN' => 'kemahasiswaan/dashboard',
            'PETUGAS_PERPUSTAKAAN'  => 'perpustakaan/dashboard',
            'PETUGAS_JURUSAN'       => 'jurusan/dashboard',
            'PETUGAS_TIK'           => 'upt-tik/dashboard',
            'PETUGAS_UMUM'          => 'administrasi-umum/dashboard',
        ];

        if (isset($map[$roleCode])) {
            return $map[$roleCode];
        }

        // Role PEMOHON / tidak dikenal -> dashboard sesuai jenis pemohon
        return ult_applicant_dashboard(ult_current_applicant_code());
    }
}

if (! function_exists('ult_applicant_dashboard')) {
    /**
     * Dashboard tujuan untuk jenis pemohon.
     */
    function ult_applicant_dashboard(string $applicantCode): string
    {
        $map = [
            'MHS'    => 'mahasiswa/dashboard',
            'DOSEN'  => 'dosen/dashboard',
            'TENDIK' => 'tendik/dashboard',
            'ALUMNI' => 'alumni/dashboard',
            'MITRA'  => 'mitra/dashboard',
            'WALI'   => 'orangtua/dashboard',
            'UMUM'   => 'umum/dashboard',
        ];

        $code = ult_normalize_applicant_code($applicantCode);

        return $map[$code] ?? 'umum/dashboard';
    }
}

if (! function_exists('ult_applicant_menu_prefix')) {
    /**
     * Prefix route milik sebuah jenis pemohon.
     */
    function ult_applicant_menu_prefix(?string $applicantCode = null): string
    {
        $map = [
            'MHS'    => 'mahasiswa',
            'DOSEN'  => 'dosen',
            'TENDIK' => 'tendik',
            'ALUMNI' => 'alumni',
            'MITRA'  => 'mitra',
            'WALI'   => 'orangtua',
            'UMUM'   => 'umum',
        ];

        $code = ult_normalize_applicant_code(
            (string) ($applicantCode ?? ult_current_applicant_code())
        );

        return $map[$code] ?? 'umum';
    }
}

if (! function_exists('ult_dashboard_url')) {
    /**
     * URL absolut dashboard untuk role.
     */
    function ult_dashboard_url(?string $roleCode = null): string
    {
        return base_url(ult_role_dashboard($roleCode));
    }
}

if (! function_exists('ult_redirect_url')) {
    /**
     * URL tujuan setelah login (dashboard sesuai role & jenis pemohon).
     *
     * Mengembalikan path relatif terhadap baseURL aplikasi.
     */
    function ult_redirect_url(?string $roleCode = null): string
    {
        return base_url(ult_role_dashboard($roleCode));
    }
}

if (! function_exists('ult_redirect_site_url')) {
    /**
     * URL tujuan redirect memakai site_url (dipakai pada proses login).
     */
    function ult_redirect_site_url(?string $roleCode = null): string
    {
        return site_url(ult_role_dashboard($roleCode));
    }
}

if (! function_exists('ult_user_display_name')) {
    function ult_user_display_name(): string
    {
        $name = trim((string) session()->get('full_name'));

        if ($name === '') {
            $name = trim((string) session()->get('name'));
        }

        if ($name === '') {
            $user = session()->get('user');
            $name = is_array($user) ? trim((string) ($user['full_name'] ?? '')) : '';
        }

        return $name !== '' ? $name : 'Pengguna';
    }
}

if (! function_exists('ult_user_initials')) {
    function ult_user_initials(): string
    {
        $parts = preg_split('/\s+/', ult_user_display_name()) ?: [];
        $parts = array_values(array_filter($parts));

        if ($parts === []) {
            return 'U';
        }

        $first = strtoupper(substr((string) $parts[0], 0, 1));
        $last  = count($parts) > 1
            ? strtoupper(substr((string) end($parts), 0, 1))
            : strtoupper(substr((string) $parts[0], 1, 1));

        return $first . $last;
    }
}
// ---------------------------------------------------------------------
// MENU
// ---------------------------------------------------------------------

if (! function_exists('ult_menu')) {
    /**
     * Daftar menu sesuai role / jenis pemohon aktif.
     *
     * @return array<int, array{label:string, items:array}>
     */
    function ult_menu(?string $roleCode = null, ?string $applicantCode = null): array
    {
        $group = ult_role_group($roleCode);

        if ($group === 'pemohon') {
            return ult_applicant_menu(
                ult_normalize_applicant_code(
                    (string) ($applicantCode ?? ult_current_applicant_code())
                )
            );
        }

        return match ($group) {
            'admin'    => ult_admin_menu(),
            'petugas'  => ult_petugas_menu(),
            'unit'     => ult_unit_menu($roleCode),
            'pimpinan' => ult_pimpinan_menu(),
            default    => ult_applicant_menu(ult_current_applicant_code()),
        };
    }
}

if (! function_exists('ult_admin_menu')) {
    function ult_admin_menu(): array
    {
        return [
            [
                'label' => 'Utama',
                'items' => [
                    ['label' => 'Dashboard Admin',   'icon' => 'fa-tachometer-alt', 'url' => 'admin/dashboard'],
                    ['label' => 'Data Tiket',        'icon' => 'fa-ticket-alt',     'url' => 'datatiket'],
                    ['label' => 'Verifikasi Tiket',  'icon' => 'fa-check-double',   'url' => 'verification'],
                    ['label' => 'Disposisi Tiket',   'icon' => 'fa-share-nodes',    'url' => 'disposition'],
                    ['label' => 'Pengajuan Online',  'icon' => 'fa-file-lines',     'url' => 'service-requests'],
                    ['label' => 'Laporan Tamu',      'icon' => 'fa-door-open',      'url' => 'guest-report'],
                ],
            ],
            [
                'label' => 'Manajemen Pengguna',
                'items' => [
                    ['label' => 'Pengguna',        'icon' => 'fa-users',           'url' => 'admin-users'],
                    ['label' => 'Role',            'icon' => 'fa-user-shield',     'url' => 'roles'],
                    ['label' => 'Permission',      'icon' => 'fa-key',             'url' => 'permissions'],
                    ['label' => 'Izin Registrasi', 'icon' => 'fa-clipboard-check', 'url' => 'registration-requests'],
                ],
            ],
            [
                'label' => 'Master Data',
                'items' => [
                    ['label' => 'Unit Layanan',        'icon' => 'fa-building',       'url' => 'master/service-units'],
                    ['label' => 'Kategori Layanan',    'icon' => 'fa-sitemap',        'url' => 'master/service-categories'],
                    ['label' => 'Layanan',             'icon' => 'fa-bell-concierge', 'url' => 'master/services'],
                    ['label' => 'Persyaratan',         'icon' => 'fa-list-check',     'url' => 'master/service-requirements'],
                    ['label' => 'Jenis Pemohon',       'icon' => 'fa-id-card',        'url' => 'master/applicant-types'],
                    ['label' => 'Departemen',          'icon' => 'fa-diagram-project', 'url' => 'master/departments'],
                    ['label' => 'Program Studi',       'icon' => 'fa-graduation-cap', 'url' => 'master/study-programs'],
                    ['label' => 'Kelas',               'icon' => 'fa-chalkboard',     'url' => 'master/classes'],
                    ['label' => 'Deskripsi Unit',      'icon' => 'fa-circle-info',    'url' => 'units-profiles'],
                    ['label' => 'FAQ',                 'icon' => 'fa-circle-question', 'url' => 'faqs'],
                ],
            ],
            [
                'label' => 'Unit Layanan Tujuan',
                'items' => [
                    ['label' => 'Administrasi Umum', 'icon' => 'fa-folder-open',   'url' => 'administrasi-umum/dashboard'],
                    ['label' => 'Akademik',           'icon' => 'fa-book',          'url' => 'akademik/dashboard'],
                    ['label' => 'Keuangan',           'icon' => 'fa-coins',         'url' => 'keuangan/dashboard'],
                    ['label' => 'Kemahasiswaan',      'icon' => 'fa-user-graduate', 'url' => 'kemahasiswaan/dashboard'],
                    ['label' => 'Perpustakaan',       'icon' => 'fa-book-open',     'url' => 'perpustakaan/dashboard'],
                    ['label' => 'Jurusan',            'icon' => 'fa-layer-group',   'url' => 'jurusan/dashboard'],
                    ['label' => 'UPA TIK',            'icon' => 'fa-laptop-code',   'url' => 'upt-tik/dashboard'],
                ],
            ],
            [
                'label' => 'Monitoring & Laporan',
                'items' => [
                    ['label' => 'Statistik Layanan',      'icon' => 'fa-chart-pie',          'url' => 'statistics'],
                    ['label' => 'Laporan Tiket',         'icon' => 'fa-file-invoice',       'url' => 'report'],
                    ['label' => 'Rekap Tiket',           'icon' => 'fa-file-csv',           'url' => 'reports'],
                    ['label' => 'Tracking Tiket',        'icon' => 'fa-route',              'url' => 'tracking'],
                    ['label' => 'Log Aktivitas',         'icon' => 'fa-history',            'url' => 'activity-logs'],
                    ['label' => 'Log Aktivitas (Arsip)', 'icon' => 'fa-clock-rotate-left',  'url' => 'log-aktivitas'],
                ],
            ],
            [
                'label' => 'Akun Saya',
                'items' => [
                    ['label' => 'Profil',       'icon' => 'fa-user-gear',         'url' => 'profile'],
                    ['label' => 'Notifikasi',   'icon' => 'fa-bell',              'url' => 'notifications'],
                    ['label' => 'Keluar',       'icon' => 'fa-right-from-bracket', 'url' => 'logout', 'danger' => true],
                ],
            ],
        ];
    }
}
if (! function_exists('ult_petugas_menu')) {
    function ult_petugas_menu(): array
    {
        return [
            [
                'label' => 'Petugas ULT',
                'items' => [
                    ['label' => 'Dashboard',     'icon' => 'fa-tachometer-alt',   'url' => 'petugas/dashboard'],
                    ['label' => 'Verifikasi',    'icon' => 'fa-check-double',     'url' => 'petugas/verifikasi'],
                    ['label' => 'Disposisi',     'icon' => 'fa-share-nodes',      'url' => 'petugas/disposisi'],
                    ['label' => 'Data Tiket',    'icon' => 'fa-ticket-alt',       'url' => 'petugas/tiket'],
                    ['label' => 'Tracking Tiket', 'icon' => 'fa-route',           'url' => 'petugas/tracking-tiket'],
                ],
            ],
            [
                'label' => 'Laporan',
                'items' => [
                    ['label' => 'Statistik Tiket', 'icon' => 'fa-chart-column',  'url' => 'petugas/statistik-tiket'],
                    ['label' => 'Laporan Tiket',   'icon' => 'fa-file-invoice', 'url' => 'petugas/laporan-tiket'],
                    ['label' => 'Rekap Tiket',     'icon' => 'fa-file-csv',     'url' => 'reports'],
                    ['label' => 'Laporan Tamu',    'icon' => 'fa-user-group',   'url' => 'petugas/laporan-tamu'],
                    ['label' => 'Log Aktivitas',   'icon' => 'fa-history',      'url' => 'petugas/log-aktivitas'],
                ],
            ],
            [
                'label' => 'Akun Saya',
                'items' => [
                    ['label' => 'Profil',       'icon' => 'fa-user-gear',         'url' => 'petugas/profile'],
                    ['label' => 'Notifikasi',   'icon' => 'fa-bell',              'url' => 'notifications'],
                    ['label' => 'Keluar',       'icon' => 'fa-right-from-bracket', 'url' => 'logout', 'danger' => true],
                ],
            ],
        ];
    }
}

if (! function_exists('ult_unit_menu')) {
    function ult_unit_menu(?string $roleCode = null): array
    {
        $roleCode = strtoupper(trim((string) ($roleCode ?? ult_current_role_code())));

        $prefix = match ($roleCode) {
            'PETUGAS_AKADEMIK'      => 'akademik',
            'PETUGAS_KEUANGAN'      => 'keuangan',
            'PETUGAS_KEMAHASISWAAN' => 'kemahasiswaan',
            'PETUGAS_PERPUSTAKAAN'  => 'perpustakaan',
            'PETUGAS_JURUSAN'       => 'jurusan',
            'PETUGAS_TIK'           => 'upt-tik',
            'PETUGAS_UMUM'          => 'administrasi-umum',
            default                 => 'unit',
        };

        $isLegacyUnit = $prefix === 'unit';

        $tiketUrl = $isLegacyUnit
            ? 'unit/tiket'
            : $prefix . '/data-tiket';

        $laporan = [
            ['label' => 'Laporan Unit', 'icon' => 'fa-chart-column', 'url' => $prefix . '/laporan'],
        ];

        $akun = [];

        // Unit dengan modul lengkap (akademik, keuangan, perpustakaan, jurusan, dan upt_tik)
        // punya halaman statistik, log aktivitas, dan profil sendiri.
        if (! $isLegacyUnit) {
            $laporan[] = ['label' => 'Statistik Tiket', 'icon' => 'fa-chart-line', 'url' => $prefix . '/statistik'];
            $laporan[] = ['label' => 'Log Aktivitas',   'icon' => 'fa-history',    'url' => $prefix . '/log-aktivitas'];
            $akun[]    = ['label' => 'Profil Unit',     'icon' => 'fa-user-gear',  'url' => $prefix . '/profile'];
        } else {
            // Unit Tujuan (dan unit generik lain ber-prefix "unit") memakai
            // halaman profil global, sehingga pengguna tetap dapat melihat
            // dan memperbarui data akunnya dari sidebar.
            $akun[] = ['label' => 'Profil',      'icon' => 'fa-user-gear', 'url' => 'profile'];

            $laporan[] = ['label' => 'Log Aktivitas', 'icon' => 'fa-history', 'url' => 'unit/log-aktivitas'];
        }

        $akun[] = ['label' => 'Notifikasi', 'icon' => 'fa-bell',              'url' => 'notifications'];
        $akun[] = ['label' => 'Keluar',     'icon' => 'fa-right-from-bracket', 'url' => 'logout', 'danger' => true];

        return [
            [
                'label' => 'Layanan Unit',
                'items' => [
                    ['label' => 'Dashboard Unit', 'icon' => 'fa-tachometer-alt', 'url' => $prefix . '/dashboard'],
                    ['label' => 'Data Tiket',     'icon' => 'fa-ticket-alt',     'url' => $tiketUrl],
                    ['label' => 'Tracking Tiket',  'icon' => 'fa-route',          'url' => 'tracking'],
                ],
            ],
            [
                'label' => 'Pelaporan',
                'items' => $laporan,
            ],
            [
                'label' => 'Akun Saya',
                'items' => $akun,
            ],
        ];
    }
}

if (! function_exists('ult_pimpinan_menu')) {
    function ult_pimpinan_menu(): array
    {
        return [
            [
                'label' => 'Pimpinan',
                'items' => [
                    ['label' => 'Dashboard',       'icon' => 'fa-tachometer-alt', 'url' => 'pimpinan/dashboard'],
                    ['label' => 'Ringkasan Tiket', 'icon' => 'fa-chart-simple',   'url' => 'pimpinan/ringkasan'],
                ],
            ],
            [
                'label' => 'Laporan',
                'items' => [
                    ['label' => 'Laporan Tiket',  'icon' => 'fa-file-invoice', 'url' => 'report'],
                    ['label' => 'Rekap Tiket',    'icon' => 'fa-file-csv',     'url' => 'reports'],
                    ['label' => 'Laporan Tamu',   'icon' => 'fa-user-group',   'url' => 'guest-report'],
                    ['label' => 'Log Aktivitas',  'icon' => 'fa-history',      'url' => 'activity-logs'],
                    ['label' => 'Statistik',      'icon' => 'fa-chart-pie',    'url' => 'statistics'],
                    ['label' => 'Tracking Tiket', 'icon' => 'fa-route',        'url' => 'tracking'],
                ],
            ],
            [
                'label' => 'Akun Saya',
                'items' => [
                    ['label' => 'Profil',       'icon' => 'fa-user-gear',         'url' => 'profile'],
                    ['label' => 'Notifikasi',   'icon' => 'fa-bell',              'url' => 'notifications'],
                    ['label' => 'Keluar',       'icon' => 'fa-right-from-bracket', 'url' => 'logout', 'danger' => true],
                ],
            ],
        ];
    }
}
if (! function_exists('ult_applicant_menu')) {
    /**
     * Menu untuk jenis pemohon (mahasiswa, dosen, tendik, alumni,
     * mitra, orang tua, umum).
     */
    function ult_applicant_menu(string $applicantCode): array
    {
        $code   = ult_normalize_applicant_code($applicantCode);
        $prefix = ult_applicant_menu_prefix($code);
        $label  = ult_applicant_labels()[$code] ?? 'Pemohon';

        $items = [
            ['label' => 'Dashboard',      'icon' => 'fa-tachometer-alt',    'url' => $prefix . '/dashboard'],
            ['label' => 'Ajukan Layanan', 'icon' => 'fa-file-circle-plus', 'url' => $prefix . '/ticket/create'],
        ];

        if ($code === 'MHS') {
            $items[] = ['label' => 'Pusat Bantuan', 'icon' => 'fa-circle-question', 'url' => 'mahasiswa/help'];
        }

        $items[] = ['label' => 'Draft Pengajuan', 'icon' => 'fa-file-pen',   'url' => $prefix . '/ticket/draft'];
        $items[] = ['label' => 'Riwayat Tiket',   'icon' => 'fa-ticket-alt', 'url' => $prefix . '/ticket/history'];

        // Menu pendukung yang tersedia untuk semua jenis pemohon.
        $layanan = [
            ['label' => 'Daftar Layanan', 'icon' => 'fa-list-check', 'url' => 'services'],
            ['label' => 'Lacak Tiket',    'icon' => 'fa-route',      'url' => 'tracking'],
        ];

        return [
            [
                'label' => $label,
                'items' => $items,
            ],
            [
                'label' => 'Layanan',
                'items' => $layanan,
            ],
            [
                'label' => 'Akun Saya',
                'items' => [
                    ['label' => 'Profil Saya',  'icon' => 'fa-user-gear',         'url' => $prefix . '/profile'],
                    ['label' => 'Notifikasi',   'icon' => 'fa-bell',              'url' => $prefix . '/notification'],
                    ['label' => 'Keluar',       'icon' => 'fa-right-from-bracket', 'url' => 'logout', 'danger' => true],
                ],
            ],
        ];
    }
}

if (! function_exists('ult_menu_is_active')) {
    /**
     * Cek apakah sebuah item menu sedang aktif.
     */
    function ult_menu_is_active(string $url): bool
    {
        $url = trim($url, '/');

        if ($url === '') {
            return false;
        }

        $current = trim(uri_string(), '/');

        if ($current === $url) {
            return true;
        }

        // Sidebar: "/akademik" juga aktif saat berada di "/akademik/data-tiket"
        return str_starts_with($current, $url . '/');
    }
}

if (! function_exists('ult_normalize_route_pattern')) {
    /**
     * Ubah placeholder route menjadi wildcard sederhana.
     */
    function ult_normalize_route_pattern(string $from): string
    {
        $from = preg_replace('#\([^)]*\)#', '*', $from);
        $from = preg_replace('#\[:\w+\]#', '*', (string) $from);
        $from = str_replace('(.*)', '*', (string) $from);

        return trim((string) $from, '/');
    }
}

if (! function_exists('ult_menu_url_exists')) {
    /**
     * Pastikan target menu benar-benar tersedia sebagai route sehingga
     * menu tidak pernah menghasilkan 404 / halaman error.
     */
    function ult_menu_url_exists(string $url): bool
    {
        $url = trim($url, '/');

        if ($url === '' || $url === 'logout') {
            return true;
        }

        static $patterns = null;

        if ($patterns === null) {
            $patterns = [];

            try {
                foreach (service('routes')->getRoutes() as $route) {
                    $from = trim((string) $route->from, '/');

                    if ($from === '') {
                        continue;
                    }

                    $patterns[] = ult_normalize_route_pattern($from);
                }
            } catch (\Throwable $e) {
                $patterns = [];
            }
        }

        if ($patterns === []) {
            return true;
        }

        if (in_array($url, $patterns, true)) {
            return true;
        }

        foreach ($patterns as $pattern) {
            if (str_ends_with($pattern, '*')
                && str_starts_with($url, substr($pattern, 0, -1))
            ) {
                return true;
            }
        }

        return false;
    }
}
if (! function_exists('ult_ticket_index_url')) {
    /**
     * URL daftar tiket sesuai role / jenis pemohon.
     *
     * Dipakai navbar & tombol aksi supaya tidak pernah mengarah ke
     * halaman milik role lain.
     */
    function ult_ticket_index_url(?string $roleCode = null): string
    {
        $group = ult_role_group($roleCode);

        return match ($group) {
            'admin'   => 'datatiket',
            'petugas' => 'petugas/tiket',
            'unit'    => ult_unit_ticket_url($roleCode),
            'pimpinan'=> 'report',
            default   => ult_applicant_menu_prefix() . '/ticket/history',
        };
    }
}

if (! function_exists('ult_unit_ticket_url')) {
    /**
     * URL daftar tiket untuk role unit.
     */
    function ult_unit_ticket_url(?string $roleCode = null): string
    {
        $roleCode = strtoupper(trim((string) ($roleCode ?? ult_current_role_code())));

        $prefix = match ($roleCode) {
            'PETUGAS_AKADEMIK'      => 'akademik',
            'PETUGAS_KEUANGAN'      => 'keuangan',
            'PETUGAS_KEMAHASISWAAN' => 'kemahasiswaan',
            'PETUGAS_PERPUSTAKAAN'  => 'perpustakaan',
            'PETUGAS_JURUSAN'       => 'jurusan',
            'PETUGAS_TIK'           => 'upt-tik',
            'PETUGAS_UMUM'          => 'administrasi-umum',
            default                 => 'unit',
        };

        return $prefix === 'unit'
            ? 'unit/tiket'
            : $prefix . '/data-tiket';
    }
}
if (! function_exists('ult_user_photo')) {
    /**
     * Foto profil pengguna (jika ada).
     */
    function ult_user_photo(): ?string
    {
        $photo = session()->get('photo');

        if (empty($photo)) {
            $user = session()->get('user');
            $photo = is_array($user) ? ($user['profile_photo'] ?? null) : null;
        }

        if (empty($photo)) {
            $profile = session()->get('user_profile');
            $photo = is_array($profile) ? ($profile['photo'] ?? null) : null;
        }

        return $photo ? trim((string) $photo) : null;
    }
}
