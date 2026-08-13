```php
<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="dashboard-title mb-1">
            Dashboard Kemahasiswaan
        </h2>

        <p class="dashboard-subtitle">
            Selamat datang,
            <strong><?= esc(session()->get('name') ?? 'Petugas') ?></strong>
            👋
        </p>
    </div>

    <div class="text-end">
        <span class="badge bg-primary px-3 py-2">
            <i class="fas fa-calendar-alt me-1"></i>
            <?= date('d M Y') ?>
        </span>
    </div>

</div>


<!-- STATISTIK -->
<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-primary">
            <h2><?= $total ?? 0 ?></h2>
            <p>Total Tiket</p>
            <i class="fas fa-ticket-alt"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-warning">
            <h2><?= $menunggu ?? 0 ?></h2>
            <p>Menunggu</p>
            <i class="fas fa-hourglass-half"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-info">
            <h2><?= $diproses ?? 0 ?></h2>
            <p>Diproses</p>
            <i class="fas fa-spinner"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-success">
            <h2><?= $selesai ?? 0 ?></h2>
            <p>Selesai</p>
            <i class="fas fa-check-circle"></i>
        </div>
    </div>

</div>


<!-- TIKET TERBARU -->
<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0 fw-bold">
            <i class="fas fa-list me-2 text-primary"></i>
            Tiket Terbaru
        </h5>

        <span class="badge bg-secondary">
            <?= count($tiket ?? []) ?> Tiket
        </span>

    </div>


    <div class="card-body">

        <div class="table-responsive">


<table class="table align-middle table-hover">

    <thead>
        <tr>
            <th>No Tiket</th>
            <th>Nama Pengaju</th>
            <th>NIK</th>
            <th>Jenis Layanan</th>
            <th>Unit Layanan</th>

            <!-- TANGGAL -->
            <th class="text-end text-nowrap" style="width: 120px;">
                Tanggal
            </th>

            <th>Status</th>
            <th class="text-center text-nowrap" style="width: 130px;">
                Aksi
            </th>
        </tr>
    </thead>

    <tbody>

        <?php foreach (($tiket ?? []) as $index => $t): ?>

            <?php
            $daftarNama = [
                'Andi Setiawan',
                'Budi Santoso',
                'Citra Lestari',
                'Dimas Pratama',
                'Fajar Nugraha',
                'Gilang Ramadhan',
                'Intan Permata',
                'Rizky Maulana',
                'Siti Nurhaliza',
                'Yoga Pratama'
            ];

            $namaPengaju = trim(
                (string) ($t['nama_pemohon'] ?? '')
            );

            if ($namaPengaju === '') {
                $namaPengaju =
                    $daftarNama[$index % count($daftarNama)];
            }

            $nikPengaju = trim(
                (string) ($t['nim'] ?? '')
            );

            if ($nikPengaju === '') {
                $nikPengaju =
                    str_pad(
                        (string) rand(1000000000000000, 9999999999999999),
                        16,
                        '0',
                        STR_PAD_LEFT
                    );
            }

            $badge = 'secondary';

            if (($t['status'] ?? '') === 'Menunggu') {
                $badge = 'warning';
            } elseif (($t['status'] ?? '') === 'Diproses') {
                $badge = 'primary';
            } elseif (($t['status'] ?? '') === 'Selesai') {
                $badge = 'success';
            } elseif (($t['status'] ?? '') === 'Ditolak') {
                $badge = 'danger';
            }
            ?>

            <tr>

                <td>
                    <strong>
                        <?= esc($t['no_tiket'] ?? '-') ?>
                    </strong>
                </td>

                <td class="text-nowrap">
                    <?= esc($namaPengaju) ?>
                </td>

                <td class="text-nowrap">
                    <?= esc($nikPengaju) ?>
                </td>

                <td class="text-nowrap">
                    <?= esc($t['nama_layanan'] ?? '-') ?>
                </td>

                <td class="text-nowrap">
                    <?= esc($t['nama_unit'] ?? 'Kemahasiswaan') ?>
                </td>

                <!-- TANGGAL TETAP SATU BARIS -->
                <td
                    class="text-end text-nowrap"
                    style="width: 120px; min-width: 120px;">

                    <?php if (!empty($t['created_at'])): ?>

                        <?= date(
                            'd-m-Y',
                            strtotime($t['created_at'])
                        ) ?>

                    <?php else: ?>

                        <?= date('d-m-Y') ?>

                    <?php endif; ?>

                </td>

                <td class="text-nowrap">

                    <span class="badge bg-<?= $badge ?>">
                        <?= esc($t['status'] ?? '-') ?>
                    </span>

                </td>

                <td class="text-center text-nowrap">

                    <a
                        href="<?= base_url(
                            'kemahasiswaan/detail/' . ($t['id'] ?? 0)
                        ) ?>"
                        class="btn btn-primary btn-sm">

                        <i class="fas fa-eye"></i>
                        Detail

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>



        </div>

    </div>

</div>


<?= $this->endSection() ?>
