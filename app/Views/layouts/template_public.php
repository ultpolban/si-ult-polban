<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Unit Layanan Terpadu Politeknik Negeri Bandung">
    <meta name="author" content="SI ULT POLBAN">

    <title><?= esc($title ?? 'Beranda') ?> &mdash; SI ULT POLBAN</title>

    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo-polban.png') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

    <!-- Tema premium landing page -->
    <link rel="stylesheet" href="<?= base_url('assets/css/theme-polban-landing.css') ?>">

    <!-- Drop-down / select (dropdown navbar, dll) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/ult-select.css') ?>">
</head>

<body class="landing-body">

<?php
helper('role');

$isLoggedIn = (bool) session()->get('isLoggedIn');
?>

<?= $this->include('layouts/_landing_navbar') ?>

<main>
    <?= $this->renderSection('content') ?>
</main>

<?= $this->include('layouts/_landing_footer') ?>

<button id="scrollTopBtn" title="Kembali ke Atas" aria-label="Kembali ke Atas">
    <i class="bi bi-arrow-up"></i>
</button>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    /* ------------------------------------------------------------------
       NAVBAR HORISONTAL
       1. Efek kaca (glass) saat halaman di-scroll
       2. Menu aktif mengikuti section yang sedang terlihat (scrollspy)
       3. Menu mobile tertutup otomatis setelah link diklik
    ------------------------------------------------------------------ */
    (function () {
        var nav = document.getElementById('ultNavbar');

        if (!nav) { return; }

        /* --- 1. Glass saat scroll --- */
        var onScroll = function () {
            nav.classList.toggle('is-stuck', window.scrollY > 24);
        };

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();

        /* --- 2. Scrollspy --- */
        var links = Array.prototype.slice.call(
            nav.querySelectorAll('a.nav-link[data-nav-target]')
        );

        var byId = {};

        links.forEach(function (link) {
            var id = link.getAttribute('data-nav-target');
            if (id) { byId[id] = link; }
        });

        var sections = Object.keys(byId)
            .map(function (id) { return document.getElementById(id); })
            .filter(Boolean);

        if (sections.length && 'IntersectionObserver' in window) {
            var spy = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (! entry.isIntersecting) { return; }

                    links.forEach(function (l) { l.classList.remove('is-current'); });

                    var active = byId[entry.target.id];
                    if (active) { active.classList.add('is-current'); }
                });
            }, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });

            sections.forEach(function (s) { spy.observe(s); });
        }

        /* --- 3. Tutup menu mobile setelah link diklik --- */
        Array.prototype.forEach.call(
            nav.querySelectorAll('a.nav-link, a.dropdown-item'),
            function (link) {
                link.addEventListener('click', function () {
                    var collapse = document.getElementById('landingNav');

                    if (collapse && collapse.classList.contains('show')) {
                        var toggler = nav.querySelector('.navbar-toggler');
                        if (toggler) { toggler.click(); }
                    }
                });
            }
        );
    })();

    /* ------------------------------------------------------------------
       Scroll reveal + back to top
    ------------------------------------------------------------------ */
    (function () {
        var items = document.querySelectorAll('.reveal');

        if ('IntersectionObserver' in window && items.length) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) {
                    if (e.isIntersecting) {
                        e.target.classList.add('is-visible');
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

            items.forEach(function (i) { io.observe(i); });
        } else {
            items.forEach(function (i) { i.classList.add('is-visible'); });
        }

        var btn = document.getElementById('scrollTopBtn');

        if (btn) {
            window.addEventListener('scroll', function () {
                btn.classList.toggle('show', window.scrollY > 420);
            }, { passive: true });

            btn.addEventListener('click', function () {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    })();
</script>

</body>

</html>
