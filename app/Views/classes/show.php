<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold">

            Detail Kelas

        </h2>

        <p class="text-muted mb-0">

            Informasi lengkap data kelas.

        </p>

    </div>

    <a
        href="<?= base_url('classes') ?>"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </a>

</div>

<div class="card shadow-sm border-0">

    <div class="card-body">

        <table class="table">

            <tr>

                <th width="250">

                    Program Studi

                </th>

                <td>

                    <?= esc($class['education_level']) ?>

                    -

                    <?= esc($class['program_name']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Nama Kelas

                </th>

                <td>

                    <?= esc($class['class_name']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Status

                </th>

                <td>

                    <?php if ($class['status']) : ?>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>

                    Dibuat

                </th>

                <td>

                    <?= date('d F Y H:i', strtotime($class['created_at'])) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Terakhir Diubah

                </th>

                <td>

                    <?= date('d F Y H:i', strtotime($class['updated_at'])) ?>

                </td>

            </tr>

        </table>

    </div>

</div>

<div class="mt-4">

    <a
        href="<?= base_url('classes/edit/' . $class['id']) ?>"
        class="btn btn-warning">

        <i class="bi bi-pencil-fill me-2"></i>

        Edit

    </a>

</div>

<?= $this->endSection() ?>