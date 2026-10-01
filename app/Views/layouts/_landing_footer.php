<?php
/**
 * Footer landing page.
 *
 * Catatan: logo image tidak dipakai di sini (sesuai permintaan).
 * Bagian brand cukup judul teks + deskripsi.
 *
 * Susunan footer (dibuat lebih hidup, tidak polos):
 *   1. Gelombang transisi dari gradien .px-flow di atasnya
 *   2. Pita CTA: Jelajahi Layanan (tamu) / Masuk Dashboard (terlogin)
 *   3. Empat kolom: brand, navigasi, akses, kontak
 *   4. Bilah bawah: copyright + tautan pendukung
 *
 * Catatan: tombol "Masuk" dan "Ajukan Izin" sengaja tidak dipakai di
 * footer karena keduanya sudah tersedia di navbar, sehingga tidak
 * lagi diulang di sini.
 */
helper('role');

$isLoggedIn = (bool) session()->get('isLoggedIn');
?>

<footer class="landing-footer">

    <!-- Gelombang transisi: warna mengalir halus dari gradien
         .px-flow (terang) ke footer (navy), tidak ada garis potong -->
    <div class="footer-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 140" preserveAspectRatio="none">
            <defs>
                <linearGradient id="footerFade" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%"   stop-color="#edeffb"></stop>
                    <stop offset="34%"  stop-color="#c9d2f0"></stop>
                    <stop offset="68%"  stop-color="#6f7fd0"></stop>
                    <stop offset="100%" stop-color="#2b3990"></stop>
                </linearGradient>
            </defs>

            <path fill="url(#footerFade)"
                  d="M0,0 L1440,0 L1440,100
                     C1200,140 960,58 720,76
                     C480,94 240,128 0,92 Z"></path>
        </svg>
    </div>

    <!-- ============ PITA CTA ============ -->
    <div class="container">
        <div class="footer-cta reveal">
            <div class="footer-cta-text">
                <span class="footer-cta-eyebrow">
                    <i class="bi bi-stars"></i> Unit Layanan Terpadu
                </span>

                <h2>
                    <?php if ($isLoggedIn): ?>
                        Sudah punya akun? Lanjutkan dari Dashboard.
                    <?php else: ?>
                        Siap mengajukan <span>layanan</span> campus?
                    <?php endif ?>
                </h2>

                <p>
                    Semua kebutuhan kampus POLBAN &mdash; akademik, keuangan,
                    kemahasiswaan, hingga layanan umum &mdash; dalam satu pintu.
                </p>
            </div>

            <div class="footer-cta-actions">
                <?php if ($isLoggedIn): ?>
                    <a href="<?= base_url(ult_role_dashboard()) ?>" class="footer-btn-main">
                        <i class="bi bi-speedometer2"></i> Masuk Dashboard
                    </a>
                    <a href="<?= base_url('logout') ?>" class="footer-btn-ghost">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('services') ?>" class="footer-btn-main">
                        <i class="bi bi-grid-1x2"></i> Jelajahi Layanan
                    </a>
                <?php endif ?>
            </div>
        </div>
    </div>


    <!-- ============ KOLOM KONTEN ============ -->
    <div class="container">
        <div class="row g-4 g-lg-5">

            <!-- Brand -->
            <div class="col-lg-4">
                <span class="footer-brandmark">ULT</span>

                <h5>SI ULT POLBAN</h5>

                <p>
                    Satu pintu untuk seluruh layanan akademik, keuangan,
                    kemahasiswaan, perpustakaan, dan layanan umum
                    Politeknik Negeri Bandung.
                </p>

                <div class="footer-social">
                    <a href="#" aria-label="Facebook" class="is-fb"><i class="bi bi-facebook"></i></a>
                    <a href="#" aria-label="Instagram" class="is-ig"><i class="bi bi-instagram"></i></a>
                    <a href="#" aria-label="X" class="is-x"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" aria-label="YouTube" class="is-yt"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

            <!-- Navigasi -->
            <div class="col-6 col-lg-2">
                <h5>Navigasi</h5>
                <ul>
                    <li><a href="<?= base_url('/') ?>#beranda">Beranda</a></li>
                    <li><a href="<?= base_url('/') ?>#layanan">Layanan</a></li>
                    <li><a href="<?= base_url('/') ?>#alur">Alur Pengajuan</a></li>
                    <li><a href="<?= base_url('/') ?>#statistik">Statistik</a></li>
                    <li><a href="<?= base_url('/') ?>#faq">FAQ</a></li>
                </ul>
            </div>

            <!-- Akses -->
            <div class="col-6 col-lg-2">
                <h5>Akses</h5>
                <ul>
                    <?php if ($isLoggedIn): ?>
                        <li><a href="<?= base_url(ult_role_dashboard()) ?>">Dashboard</a></li>
                        <li><a href="<?= base_url('profile') ?>">Profil Saya</a></li>
                        <li><a href="<?= base_url('notifications') ?>">Notifikasi</a></li>
                        <li><a href="<?= base_url('logout') ?>">Keluar</a></li>
                    <?php else: ?>
                        <li><a href="<?= base_url('/') ?>#pemohon">Jenis Pemohon</a></li>
                        <li><a href="<?= base_url('services') ?>">Daftar Layanan</a></li>
                        <li><a href="<?= base_url('/') ?>#alur">Alur Pengajuan</a></li>
                        <li><a href="<?= base_url('/') ?>#faq">FAQ</a></li>
                    <?php endif ?>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-4">
                <h5>Hubungi Kami</h5>

                <ul class="footer-contact">
                    <li>
                        <span class="footer-contact-icon"><i class="bi bi-geo-alt-fill"></i></span>
                        <span>Jl. Gegerkalong Hilir, Ciwaruga,<br>Parongpong, Bandung Barat 40559</span>
                    </li>
                    <li>
                        <span class="footer-contact-icon"><i class="bi bi-telephone-fill"></i></span>
                        <a href="tel:+62222013789">(022) 2013789</a>
                    </li>
                    <li>
                        <span class="footer-contact-icon"><i class="bi bi-envelope-fill"></i></span>
                        <a href="mailto:ult@polban.ac.id">ult@polban.ac.id</a>
                    </li>
                    <li>
                        <span class="footer-contact-icon"><i class="bi bi-clock-fill"></i></span>
                        <span>Senin - Jumat, 08.00 - 16.00 WIB</span>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- ============ BILAH BAWAH ============ -->
    <div class="landing-footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">

                <p class="mb-0">
                    &copy; <?= date('Y') ?> Unit Layanan Terpadu
                    &mdash; Politeknik Negeri Bandung.
                </p>

                <ul class="footer-legal">
                    <li><a href="<?= base_url('/') ?>#tentang">Tentang</a></li>
                    <li><a href="<?= base_url('/') ?>#faq">Bantuan</a></li>
                    <li><a href="<?= base_url('/') ?>#kontak">Kontak</a></li>
                </ul>

            </div>
        </div>
    </div>

</footer>
