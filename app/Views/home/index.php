<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<?php
$categories   = $categories ?? [];
$services     = $services ?? [];
$units        = $units ?? [];
$unitProfiles = $unitProfiles ?? [];
$faqs         = $faqs ?? [];
$popular      = $popular_services ?? [];

$isLoggedIn = (bool) session()->get('isLoggedIn');

$unitIcons = [
    'akademik'      => 'bi-mortarboard',
    'keuangan'      => 'bi-cash-coin',
    'kemahasiswaan' => 'bi-people',
    'perpustakaan'  => 'bi-journals',
    'administrasi'  => 'bi-folder2-open',
    'jurusan'       => 'bi-diagram-3',
    'tik'           => 'bi-cpu',
    'umum'          => 'bi-building',
];
?>

<!-- ============================================================
     1. HERO
     ------------------------------------------------------------
     Foto gedung POLBAN (img/landingpage.jpg) kini dipakai sebagai
     LATAR BELAKANG section ini, bukan gambar di dalam kolom.

     Agar teks tetap terbaca di atas foto yang terang, ditumpuk
     beberapa lapis overlay (lihat .hero::before / .hero::after
     pada theme-polban-landing.css):
       - gradient navy di sisi kiri supaya kolom teks menjadi gelap
       - gradient navy di bawah, menyatu dengan section putih
       - vignette, tepi dibuat sedikit lebih gelap
     ============================================================ -->
<section id="beranda" class="hero">

    <div class="container">

        <div class="hero-copy">

            <span class="hero-badge">
                <i class="bi bi-patch-check-fill"></i>
                Politeknik Negeri Bandung
            </span>

            <h1>
                Layanan kampus <span class="accent">satu pintu</span>,
                lebih cepat &amp; mudah.
            </h1>

            <p class="hero-lead">
                Unit Layanan Terpadu POLBAN menyatukan layanan akademik,
                keuangan, kemahasiswaan, perpustakaan, hingga layanan
                umum masyarakat dalam satu sistem yang terhubung.
            </p>

            <div class="d-flex flex-wrap gap-3 mt-4 hero-actions">

                <?php if ($isLoggedIn): ?>
                    <a href="<?= base_url(ult_role_dashboard()) ?>" class="btn-ajukan">
                        <i class="bi bi-speedometer2"></i> Masuk Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('login/form') ?>" class="btn-ajukan">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk
                    </a>
                    <a href="<?= base_url('registration-request') ?>" class="btn-avits">
                        <i class="bi bi-send"></i> Ajukan Izin
                    </a>
                <?php endif ?>

                <a href="#layanan" class="btn-avits">
                    <i class="bi bi-grid"></i> Lihat Layanan
                </a>

            </div>

        </div>

        <div class="hero-stats">

            <div class="hero-stat">
                <strong><?= (int) ($total_services ?? 0) ?></strong>
                <span>Layanan</span>
            </div>
            <div class="hero-stat">
                <strong><?= count($units) ?></strong>
                <span>Unit</span>
            </div>
            <div class="hero-stat">
                <strong><?= count($categories) ?></strong>
                <span>Kategori</span>
            </div>
            <div class="hero-stat">
                <strong><?= count($faqs) ?></strong>
                <span>FAQ</span>
            </div>

        </div>

    </div>

    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none">
            <path d="M0,40 C360,90 1080,0 1440,40 L1440,70 L0,70 Z"></path>
        </svg>
    </div>

</section>

<!-- ============================================================
     2. JENIS PEMOHON
     ------------------------------------------------------------
     Sebelumnya section ini memakai "marquee" (teks berjalan
     horizontal). Akibatnya nama jenis pemohon TERPOTONG keluar
     dari layar dan tidak bisa diklik -> membingungkan pengguna.

     Sekarang memakai grid kartu yang:
       - tidak terpotong (wrap rapi di layar kecil)
       - bisa diklik -> langsung ke halaman pengajuan izin
       - diambil dari master_applicant_types di database

     Latar memakai gradien kontinu (.px-flow) yang membungkus
     seluruh section di bawah hero.
     ============================================================ -->
<!-- ============================================================
     ALIRAN LATAR KONTINU
     ------------------------------------------------------------
     Seluruh section di bawah hero dibungkus satu wadah (.px-flow)
     supayalatar flowing dari atas ke bawah dalam satu gradien
     panjang, bukan berganti-ganti warna tiap section.
     ============================================================ -->
<div class="px-flow">

<section class="audience" id="pemohon">

    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Untuk Siapa</span>
            <h2 class="section-title">Layanan untuk Setiap Komunitas</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">
                Pilih jenis pemohon Anda untuk melihat formulir dan alur
                pengajuan yang sesuai.
            </p>
        </div>

        <div class="row g-3 g-lg-4" data-audience-list>
            <?php
            /*
             * Sumber data: master_applicant_types (database).
             * Bila kosong / tidak tersedia, pakai daftar bawaan.
             */
            $ultApplicantTypes = $applicantTypes ?? [];

            if (! is_array($ultApplicantTypes) || $ultApplicantTypes === []) {
                $ultApplicantTypes = [
                    ['code' => 'MHS',    'name' => 'Mahasiswa'],
                    ['code' => 'DOSEN',  'name' => 'Dosen'],
                    ['code' => 'TENDIK', 'name' => 'Tenaga Kependidikan'],
                    ['code' => 'ALUMNI', 'name' => 'Alumni'],
                    ['code' => 'MITRA',  'name' => 'Mitra'],
                    ['code' => 'WALI',   'name' => 'Orang Tua / Wali'],
                    ['code' => 'UMUM',   'name' => 'Masyarakat Umum'],
                ];
            }

            $ultAudienceIcons = [
                'MHS'    => 'bi-mortarboard',
                'DOSEN'  => 'bi-person-video3',
                'TENDIK' => 'bi-person-badge',
                'ALUMNI' => 'bi-mortarboard-fill',
                'MITRA'  => 'bi-briefcase',
                'WALI'   => 'bi-people',
                'UMUM'   => 'bi-globe',
            ];

            $ultAudienceDesc = [
                'MHS'    => 'KTM, KRS, nilai, Surat Aktif Kuliah',
                'DOSEN'  => 'Surat tugas, izin, administrasi perkuliahan',
                'TENDIK' => 'Surat tugas, cuti, administrasi pegawai',
                'ALUMNI' => 'Surat keterangan, transkrip, legalisir',
                'MITRA'  => 'Kerja sama, program sponsored',
                'WALI'   => 'Surat keterangan anak, info akademik',
                'UMUM'   => 'Pengesahan, surat, layanan umum',
            ];

            foreach ($ultApplicantTypes as $ultType):
                $ultCode = strtoupper(trim((string) ($ultType['code'] ?? '')));
                $ultName = trim((string) ($ultType['name'] ?? '')) ?: 'Pemohon';
                $ultIcon = $ultAudienceIcons[$ultCode] ?? 'bi-person';
                $ultDesc = $ultAudienceDesc[$ultCode] ?? 'Layanan terpadu POLBAN';
            ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <a class="audience-card reveal"
                       href="<?= base_url('registration-request') ?>"
                       data-applicant-code="<?= esc($ultCode) ?>">

                        <span class="audience-icon">
                            <i class="bi <?= esc($ultIcon) ?>"></i>
                        </span>

                        <span class="audience-body">
                            <strong><?= esc($ultName) ?></strong>
                            <small><?= esc($ultDesc) ?></small>
                        </span>

                        <i class="bi bi-arrow-right audience-arrow"></i>
                    </a>
                </div>
            <?php endforeach ?>
        </div>

        <p class="text-center mt-4 mb-0 reveal" style="font-size:.9rem;">
            Tidak yakin jenis pemohon Anda?
            <a href="<?= base_url('registration-request') ?>" style="font-weight:700;">
                Ajukan izin registrasi
            </a>
            atau hubungi ULT POLBAN.
        </p>

    </div>
</section>
<!-- ============================================================
     3. KEUNGGULAN
============================================================ -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Keunggulan</span>
            <h2 class="section-title">Mengapa Memilih ULT POLBAN?</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">
                Kami menyatukan seluruh layanan kampus agar waktu Anda lebih
                efisien untuk hal yang benar-benar penting.
            </p>
        </div>

        <div class="row g-4">

            <?php
            $features = [
                ['bi-lightning-charge', 'Proses Cepat', 'Pengajuan diverifikasi Petugas ULT dan diteruskan ke unit tujuan tanpa perlu bolak-balik.'],
                ['bi-shield-check', 'Data Ter Aman', 'Seluruh data pengajuan tersimpan terstruktur dan hanya dapat diakses pihak yang berwenang.'],
                ['bi-eye', 'Status Transparan', 'Pantau progres pengajuan Anda secara real-time lewat nomor tiket yang unik.'],
                ['bi-collection', 'Semua Unit', 'Akademik, keuangan, kemahasiswaan, perpustakaan, hingga layanan umum dalam satu akun.'],
                ['bi-file-earmark-text', 'Dokumen Online', 'Unggah dan kelola berkas pendukung secara digital tanpa datang langsung.'],
                ['bi-headset', 'Pendampingan', 'Tim ULT siap membantu mulai dari pendaftaran hingga layanan selesai.'],
            ];

            foreach ($features as $feature):
            ?>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card reveal">
                        <div class="feature-icon">
                            <i class="bi <?= esc($feature[0]) ?>"></i>
                        </div>
                        <h4><?= esc($feature[1]) ?></h4>
                        <p><?= esc($feature[2]) ?></p>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

    </div>
</section>

<!-- ============================================================
     4. UNIT & LAYANAN
============================================================ -->
<section id="layanan" class="py-5">

    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Layanan</span>
            <h2 class="section-title">Pilih Unit Layanan</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">
                Setiap unit punya layanan yang bisa Anda ajukan langsung dari akun Anda.
            </p>
        </div>

        <div class="row g-4">

            <?php if ($units === []): ?>
                <div class="col-12 text-center text-muted">Belum ada unit layanan aktif.</div>
            <?php else: ?>
                <?php foreach (array_slice($units, 0, 6) as $index => $unit): ?>
                    <?php
                    $unitId   = (int) ($unit['id'] ?? 0);
                    $unitKey  = strtolower((string) ($unit['code'] ?? $unit['name'] ?? ''));
                    $icon     = 'bi-building';
                    foreach ($unitIcons as $key => $ico) {
                        if (str_contains($unitKey, $key)) {
                            $icon = $ico;
                            break;
                        }
                    }

                    $unitServices = array_values(array_filter(
                        $services,
                        static fn ($s) => (int) ($s['service_unit_id'] ?? 0) === $unitId
                    ));
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="service-card reveal">
                            <h3>
                                <i class="bi <?= esc($icon) ?>"></i>
                                <?= esc($unit['name'] ?? 'Unit Layanan') ?>
                            </h3>

                            <?php if ($unitServices === []): ?>
                                <p class="service-empty">Layanan pada unit ini sedang disiapkan.</p>
                            <?php else: ?>
                                <ul class="service-list">
                                    <?php foreach (array_slice($unitServices, 0, 4) as $svc): ?>
                                        <li>
                                            <i class="bi bi-check2"></i>
                                            <?= esc($svc['name'] ?? '-') ?>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php endif ?>

                            <a href="<?= base_url('services') ?>" class="btn-ajukan">
                                Lihat Layanan <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

        </div>

        <!-- Accordion kategori -->
        <?php if ($categories !== []): ?>
            <?php
            $catIcons = [
                'akademik'      => 'bi-mortarboard-fill',
                'keuangan'      => 'bi-cash-coin',
                'kemahasiswaan' => 'bi-people-fill',
                'perpustakaan'  => 'bi-journals',
                'administrasi'  => 'bi-folder2-open',
                'jurusan'       => 'bi-diagram-3-fill',
                'wawasan'       => 'bi-lightbulb-fill',
                'kemitraan'     => 'bi-handshake',
                'umum'          => 'bi-building-fill',
            ];

            $totalLayanan = count($services);
            ?>

            <div class="lcat reveal">
                <div class="lcat-top">
                    <span class="lcat-eyebrow">
                        <i class="bi bi-collection-fill"></i> Kategori
                    </span>

                    <h3 class="lcat-title">Layanan Berdasarkan Kategori</h3>

                    <p class="lcat-sub">
                        Jelajahi seluruh layanan ULT POLBAN yang dikelompokkan
                        menurut bidangnya. Klik kategori untuk melihat detail layanan.
                    </p>

                    <div class="lcat-stats">
                        <span class="lcat-stat">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <?= count($categories) ?> Kategori
                        </span>
                        <span class="lcat-stat">
                            <i class="bi bi-list-check"></i>
                            <?= $totalLayanan ?> Layanan
                        </span>
                    </div>
                </div>

                <div class="lcat-list" id="kategoriAccordion">
                    <?php foreach ($categories as $index => $category): ?>
                        <?php
                        $catId   = 'kategori-' . (int) ($category['id'] ?? $index);
                        $catName = (string) ($category['name'] ?? 'Kategori');
                        $catKey  = strtolower($catName);
                        $catDesc = trim((string) ($category['description'] ?? ''));

                        $catIcon = 'bi-collection-fill';
                        foreach ($catIcons as $key => $ico) {
                            if (str_contains($catKey, $key)) {
                                $catIcon = $ico;
                                break;
                            }
                        }

                        $catServices = array_values(array_filter(
                            $services,
                            static fn ($s) => (int) ($s['service_category_id'] ?? 0) === (int) ($category['id'] ?? 0)
                        ));

                        $isOpen = $index === 0;
                        ?>
                        <div class="lcat-group<?= $isOpen ? ' is-open' : '' ?>">

                            <h4 class="lcat-head">
                                <button class="lcat-toggle<?= $isOpen ? '' : ' collapsed' ?>"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#<?= esc($catId) ?>"
                                        aria-expanded="<?= $isOpen ? 'true' : 'false' ?>"
                                        aria-controls="<?= esc($catId) ?>">

                                    <span class="lcat-icon">
                                        <i class="bi <?= esc($catIcon) ?>"></i>
                                    </span>

                                    <span class="lcat-text">
                                        <span class="lcat-name"><?= esc($catName) ?></span>
                                        <span class="lcat-meta">
                                            <?= count($catServices) ?> layanan
                                            <?php if ($catDesc !== ''): ?>
                                                &middot; <?= esc($catDesc) ?>
                                            <?php endif ?>
                                        </span>
                                    </span>

                                    <span class="lcat-count"><?= count($catServices) ?></span>
                                    <i class="bi bi-chevron-down lcat-arrow"></i>
                                </button>
                            </h4>

                            <div id="<?= esc($catId) ?>"
                                 class="collapse lcat-collapse<?= $isOpen ? ' show' : '' ?>"
                                 data-bs-parent="#kategoriAccordion">
                                <div class="lcat-body">
                                    <?php if ($catServices === []): ?>
                                        <p class="lcat-empty">Belum ada layanan pada kategori ini.</p>
                                    <?php else: ?>
                                        <div class="lcat-items">
                                            <?php foreach ($catServices as $svc): ?>
                                                <?php
                                                $svcHours = $svc['service_hours'] ?? null;
                                                $svcDesc  = trim((string) ($svc['description'] ?? ''));
                                                $svcName  = (string) ($svc['name'] ?? '-');
                                                $svcUnit  = trim((string) ($svc['unit_name'] ?? ''));
                                                ?>
                                                <a class="lcat-item"
                                                   href="<?= base_url('layanan/detail/' . (int) ($svc['id'] ?? 0)) ?>">

                                                    <span class="lcat-item-icon">
                                                        <i class="bi <?= esc($catIcon) ?>"></i>
                                                    </span>

                                                    <span class="lcat-item-body">
                                                        <span class="lcat-item-title"><?= esc($svcName) ?></span>
                                                        <span class="lcat-item-desc">
                                                            <?= esc($svcDesc !== '' ? $svcDesc : 'Layanan siap diajukan melalui Unit Layanan Terpadu.') ?>
                                                        </span>
                                                    </span>

                                                    <span class="lcat-item-meta">
                                                        <?php if ($svcUnit !== ''): ?>
                                                            <span class="lcat-item-unit"><?= esc($svcUnit) ?></span>
                                                        <?php endif ?>
                                                        <?php if ($svcHours !== null && $svcHours !== ''): ?>
                                                            <span class="lcat-item-hours">
                                                                <i class="bi bi-clock"></i>
                                                                <?= esc((string) $svcHours) ?> Jam
                                                            </span>
                                                        <?php endif ?>
                                                    </span>

                                                    <i class="bi bi-arrow-right lcat-item-go"></i>
                                                </a>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif ?>

                                    <a class="lcat-more" href="<?= base_url('services') ?>">
                                        Lihat katalog lengkap
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>

    </div>
</section>

<!-- ============================================================
     4b. DESKRIPSI UNIT
     ------------------------------------------------------------
     Sumber: tabel units_profiles (admin -> Master Data ->
     Deskripsi Unit). Hanya deskripsi ber-status aktif yang tampil,
     jadi isinya selalu sinkron dengan yang dikelola admin.
============================================================ -->
<section id="deskripsi-unit" class="py-5 unit-desc-section">

    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Profil Unit</span>
            <h2 class="section-title">Kenali Lebih Dekat Unit Layanan</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">
                Baca penjelasan resmi dari tiap unit sebelum mengajukan tiket,
                agar permohonan Anda langsung diarahkan ke unit yang tepat.
            </p>
        </div>

        <div class="row g-4">

            <?php if ($unitProfiles === []): ?>
                <div class="col-12 text-center text-muted">
                    Deskripsi unit belum tersedia.
                </div>
            <?php else: ?>
                <?php foreach ($unitProfiles as $profile): ?>
                    <?php
                    $upKey  = strtolower((string) ($profile['unit_code'] ?? $profile['unit_name'] ?? ''));
                    $upIcon = 'bi-building';
                    foreach ($unitIcons as $key => $ico) {
                        if (str_contains($upKey, $key)) {
                            $upIcon = $ico;
                            break;
                        }
                    }

                    $upName = trim((string) ($profile['unit_name'] ?? ''));
                    if ($upName === '') {
                        $upName = 'Unit Layanan';
                    }

                    $upDesc = trim((string) ($profile['description'] ?? ''));
                    if ($upDesc === '') {
                        $upDesc = 'Deskripsi unit ini sedang disiapkan.';
                    }
                    ?>

                    <div class="col-md-6 col-lg-4">
                        <article class="unit-desc-card reveal">

                            <span class="unit-desc-icon">
                                <i class="bi <?= esc($upIcon) ?>"></i>
                            </span>

                            <div class="unit-desc-body">
                                <h3><?= esc($upName) ?></h3>

                                <?php if (trim((string) ($profile['unit_code'] ?? '')) !== ''): ?>
                                    <span class="unit-desc-code"><?= esc($profile['unit_code']) ?></span>
                                <?php endif ?>

                                <p class="unit-desc-text" title="<?= esc($upDesc) ?>">
                                    <?= esc($upDesc) ?>
                                </p>
                            </div>

                            <a class="unit-desc-link" href="<?= base_url('services') ?>">
                                Lihat Layanan <i class="bi bi-arrow-right"></i>
                            </a>

                        </article>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

        </div>

    </div>
</section>

<!-- ============================================================
     5. ALUR PENGAJUAN
============================================================ -->
<section id="alur" class="py-5">

    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Alur</span>
            <h2 class="section-title">Alur Pengajuan</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">Lima langkah sederhana dari pendaftaran hingga layanan selesai.</p>
        </div>

        <div class="row g-4 process">

            <?php
            $steps = [
                ['Masuk',   'Akun yang telah diverifikasi Unit Layanan Terpadu.'],
                ['Pilih',   'Pilih unit dan jenis layanan yang dibutuhkan.'],
                ['Isi',     'Lengkapi formulir dan unggah dokumen pendukung.'],
                ['Verifikasi', 'Petugas ULT memeriksa berkas pengajuan Anda.'],
                ['Selesai', 'Unit tujuan memproses, Anda memantau statusnya.'],
            ];

            foreach ($steps as $index => $step):
            ?>
                <div class="col-lg">
                    <div class="process-step reveal">
                        <div class="process-num"><?= $index + 1 ?></div>
                        <h5><?= esc($step[0]) ?></h5>
                        <p><?= esc($step[1]) ?></p>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

    </div>
</section>

<!-- ============================================================
     6. STATISTIK
============================================================ -->
<section id="statistik" class="py-5">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Statistik</span>
            <h2 class="section-title">Statistik Layanan</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">Rekapulasi kunjungan dan penggunaan layanan ULT POLBAN.</p>
        </div>

        <div class="row g-4 mb-5">

            <?php
            $visitors = [
                ['bi-calendar-day',   (int) ($visitors_today ?? 0),  'Hari Ini'],
                ['bi-calendar-week',  (int) ($visitors_week ?? 0),  'Pekan Ini'],
                ['bi-calendar-month', (int) ($visitors_month ?? 0), 'Bulan Ini'],
                ['bi-calendar3',      (int) ($visitors_year ?? 0),  'Tahun ' . date('Y')],
            ];

            foreach ($visitors as $visitor):
            ?>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card reveal">
                        <div class="stat-icon"><i class="bi <?= esc($visitor[0]) ?>"></i></div>
                        <p class="counter"><?= number_format($visitor[1], 0, ',', '.') ?></p>
                        <h5><?= esc($visitor[2]) ?></h5>
                        <p>Jumlah pengunjung</p>
                    </div>
                </div>
            <?php endforeach ?>

        </div>

        <!-- ============================================================
             RANGKUMAN: LAYANAN SERING DIACCESSED / DIGUNAKAN
             ------------------------------------------------------------
             - Diakses  : jumlah kunjungan halaman detail layanan
             - Digunakan : jumlah pengajuan (tiket + arsip)
         ============================================================ -->
        <?php
        $ultViewed  = $top_viewed ?? [];
        $ultUsed    = $top_used ?? [];
        $ultHasData = $ultViewed !== [] || $ultUsed !== [];

        // Total pengajuan satu layanan = tiket hari ini + arsip + agregat
        $ultUsedTotal = static function (array $row): int {
            return (int) ($row['ticket_submission'] ?? 0)
                + (int) ($row['archive_submission'] ?? 0)
                + (int) ($row['pop_submission'] ?? 0);
        };
        ?>

        <?php if ($ultHasData): ?>

            <!-- ========== 6a. PALING BANYAK DIACCESSED ========== -->
            <div class="text-center mb-4 mt-5 reveal">
                <h3 class="section-title" style="font-size:1.5rem;">
                    <i class="bi bi-eye"></i> Layanan Paling Banyak Diakses
                </h3>
                <p class="section-sub" style="margin:0;">
                    Layanan yang paling sering dibuka oleh pengunjung.
                </p>
            </div>

            <?php if ($ultViewed === []): ?>
                <p class="stat-empty reveal">Belum ada data kunjungan layanan.</p>
            <?php else: ?>
                <div class="row g-4 mb-5">
                    <?php foreach ($ultViewed as $i => $row): ?>
                        <?php $ultVal = (int) ($row['view_count'] ?? 0); ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?= base_url('layanan/detail/' . (int) ($row['service_id'] ?? 0)) ?>"
                               class="stat-card stat-card-link reveal">

                                <div class="stat-icon">
                                    <i class="bi bi-eye"></i>
                                    <span class="stat-rank"><?= $i + 1 ?></span>
                                </div>

                                <p class="counter"><?= number_format($ultVal, 0, ',', '.') ?></p>
                                <h5><?= esc($row['service_name'] ?? 'Layanan') ?></h5>
                                <p>
                                    <?= number_format($ultVal, 0, ',', '.') ?> kali diakses
                                    &middot; <?= esc($row['unit_name'] ?? 'Unit Layanan') ?>
                                </p>
                                <span class="stat-more">
                                    <i class="bi bi-arrow-right-circle"></i> Lihat layanan
                                </span>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <!-- ========== 6b. PALING BANYAK DIGUNAKAN ========== -->
            <div class="text-center mb-4 mt-5 reveal">
                <h3 class="section-title" style="font-size:1.5rem;">
                    <i class="bi bi-send-check"></i> Layanan Paling Banyak Digunakan
                </h3>
                <p class="section-sub" style="margin:0;">
                    Layanan yang paling sering diajukan oleh pemohon.
                </p>
            </div>

            <?php if ($ultUsed === []): ?>
                <p class="stat-empty reveal">Belum ada pengajuan layanan tercatat.</p>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($ultUsed as $i => $row): ?>
                        <?php $ultUsedVal = $ultUsedTotal($row); ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?= base_url('layanan/detail/' . (int) ($row['service_id'] ?? 0)) ?>"
                               class="stat-card stat-card-link reveal">

                                <div class="stat-icon stat-icon-orange">
                                    <i class="bi bi-send-check"></i>
                                    <span class="stat-rank"><?= $i + 1 ?></span>
                                </div>

                                <p class="counter"><?= number_format($ultUsedVal, 0, ',', '.') ?></p>
                                <h5><?= esc($row['service_name'] ?? 'Layanan') ?></h5>
                                <p>
                                    <?= number_format($ultUsedVal, 0, ',', '.') ?> pengajuan
                                    &middot; <?= esc($row['unit_name'] ?? 'Unit Layanan') ?>
                                </p>
                                <span class="stat-more">
                                    <i class="bi bi-arrow-right-circle"></i> Lihat layanan
                                </span>
                            </a>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

        <?php else: ?>

            <!-- ========== KONDISI BELUM ADA DATA ========== -->
            <div class="stat-empty-state reveal">
                <i class="bi bi-bar-chart-line"></i>
                <h4>Statistik sedang dikumpulkan</h4>
                <p>
                    Daftar layanan yang paling banyak diakses &amp; digunakan akan
                    muncul di sini secara otomatis begitu ada kunjungan dan
                    pengajuan masuk.
                </p>
                <a href="<?= base_url('services') ?>" class="btn-ajukan">
                    <i class="bi bi-grid"></i> Lihat Semua Layanan
                </a>
            </div>

        <?php endif ?>

    </div>
</section>

<!-- ============================================================
     7. TENTANG POLBAN
============================================================ -->
<section id="tentang" class="py-5">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Tentang</span>
            <h2 class="section-title">Tentang Politeknik Negeri Bandung</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">
               cate            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="about-card reveal">
                    <div class="about-icon"><i class="bi bi-building"></i></div>
                    <h4>Sejarah</h4>
                    <p>Perjalanan berdirinya POLBAN, dari Politeknik ITB hingga institusi mandiri.</p>
                    <button class="btn-outline-soft" data-bs-toggle="modal" data-bs-target="#sejarahModal">
                        Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card reveal">
                    <div class="about-icon"><i class="bi bi-bullseye"></i></div>
                    <h4>Visi</h4>
                    Arah POLBAN sebagai institusi pendidikan vokasi unggulan.
                    <button class="btn-outline-soft" data-bs-toggle="modal" data-bs-target="#visiModal">
                        Lihat Visi <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card reveal">
                    <div class="about-icon"><i class="bi bi-flag"></i></div>
                    <h4>Misi</h4>
                    <p>Empat pilar: pendidikan, penelitian, pengabdian, dan tata kelola.</p>
                    <button class="btn-outline-soft" data-bs-toggle="modal" data-bs-target="#misiModal">
                        Lihat Misi <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- ============================================================
     8. FAQ
============================================================ -->
<section id="faq" class="py-5">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">FAQ</span>
            <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">Jawaban singkat untuk hal-hal yang paling sering ditanyakan.</p>
        </div>

        <div class="faq-wrap faq-accordion accordion" id="faqAccordion">

            <?php if ($faqs === []): ?>
                <div class="faq-empty">
                    <i class="bi bi-chat-square-dots fs-2 d-block mb-2"></i>
                    Belum ada pertanyaan yang sering diajukan.
                </div>
            <?php else: ?>
                <?php foreach ($faqs as $faq): ?>
                    <?php $faqId = 'faq-' . (int) ($faq['id'] ?? 0); ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#<?= esc($faqId) ?>"
                                    aria-expanded="false">
                                <?= esc($faq['question'] ?? '-') ?>
                            </button>
                        </h2>
                        <div id="<?= esc($faqId) ?>"
                             class="accordion-collapse collapse"
                             data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <?= esc($faq['answer'] ?? '') ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

        </div>

    </div>
</section>

<!-- ============================================================
     9. KONTAK
     ------------------------------------------------------------
     Section CTA "Ajukan Layanan Anda Sekarang" sebelumnya ada di
     sini (tepat di atas kontak) dan sudah dihapus.

     Tombol ajukan kini hanya tersedia di tempat yang relevan:
       - Hero   : Masuk / Ajukan Izin
       - Kartu jenis pemohon -> /registration-request
       - Footer : menu "Akses"
     ============================================================ -->

<section id="kontak" class="py-5" style="padding-top:0;">
    <div class="container">

        <div class="text-center mb-5 reveal">
            <span class="section-badge">Kontak</span>
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="eyebrow-line"></div>
            <p class="section-sub">Kami siap membantu setiap hari kerja, 08.00 - 16.00 WIB.</p>
        </div>

        <div class="row g-4 justify-content-center">

            <div class="col-md-4">
                <div class="contact-card reveal">
                    <div class="about-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    <h4 class="mb-2">Alamat</h4>
                    <p class="mb-3">
                        Jl. Gegerkalong Hilir, Ciwaruga,<br>
                        Parongpong, Bandung Barat 40559
                    </p>
                    <a href="https://maps.google.com/?q=Politeknik+Negeri+Bandung"
                       target="_blank" rel="noopener"
                       class="fw-bold" style="color:var(--px-navy);text-decoration:none;">
                        Lihat di Google Maps <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-card reveal">
                    <div class="about-icon"><i class="bi bi-telephone-fill"></i></div>
                    <h4 class="mb-2">Telepon</h4>
                    <p class="mb-3">Unit Layanan Terpadu<br>Politeknik Negeri Bandung</p>
                    <a href="tel:+62222013789" class="fw-bold" style="color:var(--px-navy);text-decoration:none;">
                        (022) 2013789
                    </a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-card reveal">
                    <div class="about-icon"><i class="bi bi-envelope-fill"></i></div>
                    <h4 class="mb-2">Email</h4>
                    <p class="mb-3">Untuk pertanyaan dan<br>permintaan informasi</p>
                    <a href="mailto:ult@polban.ac.id" class="fw-bold" style="color:var(--px-navy);text-decoration:none;">
                        ult@polban.ac.id
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
</section>

<!-- ============================================================
     MODAL: SEJARAH
============================================================ -->
<div class="modal fade" id="sejarahModal" tabindex="-1" aria-labelledby="sejarahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border:0;border-radius:var(--px-r-lg);overflow:hidden;">
            <div class="modal-header" style="border-bottom:1px solid var(--px-line);">
                <h5 class="modal-title fw-bold" id="sejarahModalLabel" style="color:var(--px-navy);">Sejarah Politeknik Negeri Bandung</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>
                    Politeknik Negeri Bandung (POLBAN) merupakan perguruan tinggi
                    vokasi yang berawal dari Politeknik Institut Teknologi Bandung
                    (ITB). Pendidikan politeknik berkembang untuk memenuhi
                    kebutuhan tenaga terampil yang siap bekerja di dunia industri.
                </p>
                <p>
                    Pada tahun 1997, berdasarkan Keputusan Menteri Pendidikan dan
                    Kebudayaan, Politeknik ITB resmi menjadi institusi mandiri dengan
                    nama <strong>Politeknik Negeri Bandung (POLBAN)</strong>. Sejak
                    itu POLBAN terus membuka jurusan dan program studi baru sesuai
                    kebutuhan dunia industri.
                </p>
                <p class="mb-0">
                    Kini POLBAN menjadi salah satu perguruan tinggi vokasi
                    unggulan di Indonesia dengan program Diploma Tiga (D3),
                    Sarjana Terapan (D4), dan Magister Terapan.
                </p>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--px-line);">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        style="background:var(--px-navy);border-color:var(--px-navy);border-radius:30px;padding:.5rem 1.4rem;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     MODAL: VISI
============================================================ -->
<div class="modal fade" id="visiModal" tabindex="-1" aria-labelledby="visiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border:0;border-radius:var(--px-r-lg);overflow:hidden;">
            <div class="modal-header" style="border-bottom:1px solid var(--px-line);">
                <h5 class="modal-title fw-bold" id="visiModalLabel" style="color:var(--px-navy);">Visi POLBAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>
                    Menjadi institusi yang unggul dan terdepan dalam pendidikan
                    vokasi yang inovatif dan adaptif terhadap perkembangan ilmu
                    pengetahuan dan teknologi terapan.
                </p>
                <p class="mb-0 text-muted">
                    Visi ini menjadi landasan bagi POLBAN menyelenggarakan
                    pendidikan vokasi yang berorientasi pada pengembangan
                    kompetensi, inovasi, serta kesiapan lulusan.
                </p>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--px-line);">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        style="background:var(--px-navy);border-color:var(--px-navy);border-radius:30px;padding:.5rem 1.4rem;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- ============================================================
     MODAL: MISI
============================================================ -->
<div class="modal fade" id="misiModal" tabindex="-1" aria-labelledby="misiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border:0;border-radius:var(--px-r-lg);overflow:hidden;">
            <div class="modal-header" style="border-bottom:1px solid var(--px-line);">
                <h5 class="modal-title fw-bold" id="misiModalLabel" style="color:var(--px-navy);">Misi POLBAN</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <ul class="mb-0 ps-3">
                    <li class="mb-2">Menyelenggarakan pendidikan untuk menghasilkan lulusan yang kompeten, berjiwa kewirausahaan, dan berwawasan lingkungan.</li>
                    <li class="mb-2">Melaksanakan penelitian dan menyebarkan hasil-hasilnya untuk mengembangkan ilmu pengetahuan dan teknologi.</li>
                    <li class="mb-2">Melaksanakan kegiatan pengabdian kepada masyarakat melalui pemanfaatan ilmu pengetahuan dan teknologi.</li>
                    <li>Menyelenggarakan tata kelola yang efisien, akuntabel, transparan, dan berkeadilan.</li>
                </ul>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--px-line);">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                        style="background:var(--px-navy);border-color:var(--px-navy);border-radius:30px;padding:.5rem 1.4rem;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
