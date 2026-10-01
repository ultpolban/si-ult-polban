<?php
/**
 * Layout `main` kini menjadi alias dari layout utama `layouts/template`
 * agar SETIAP halaman memakai chrome, sidebar per-role, navbar, dan
 * tema POLBAN yang sama.
 *
 * View lama yang memakai `extend('layouts/main')` tetap bekerja karena
 * section `content` diteruskan ke layout utama.
 */
?>

<?= $this->extend('layouts/template') ?>
