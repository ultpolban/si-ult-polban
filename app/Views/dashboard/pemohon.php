<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h2>

                Selamat Datang,

                <?= session('full_name') ?>

            </h2>

            <hr>

            <p>

                Anda login sebagai <strong>Pemohon ULT POLBAN</strong>

            </p>

            <p>

                Pada dashboard ini nantinya pemohon dapat:

            </p>

            <ul>

                <li>Mengajukan layanan</li>

                <li>Melihat status pengajuan</li>

                <li>Melihat riwayat layanan</li>

                <li>Mengelola profil</li>

            </ul>

        </div>

    </div>

</div>

<?= $this->endSection() ?>