<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Detail Data') ?></h4><p class="text-muted">Informasi lengkap data.</p></div>

<div class="card card-premium">

    <div class="card-header">

        <h3 class="card-title">

            Detail Jenis Pemohon

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-premium mb-0">

            <tr>
                <th width="250">Kode</th>
                <td><?= esc($applicantType['code']) ?></td>
            </tr>

            <tr>
                <th>Nama</th>
                <td><?= esc($applicantType['name']) ?></td>
            </tr>

            <tr>
                <th>Jenis</th>
                <td>

                    <?= $applicantType['is_internal']
                        ? '<span class="badge bg-primary">Internal</span>'
                        : '<span class="badge bg-info">Eksternal</span>' ?>

                </td>
            </tr>

            <tr>
                <th>Deskripsi</th>
                <td><?= nl2br(esc($applicantType['description'])) ?></td>
            </tr>

            <tr>
                <th>Urutan</th>
                <td><?= esc($applicantType['sort_order']) ?></td>
            </tr>

            <tr>
                <th>Status</th>
                <td>

                    <?= $applicantType['is_active']
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-danger">Nonaktif</span>' ?>

                </td>
            </tr>

            <tr>
                <th>Dibuat</th>
                <td><?= esc($applicantType['created_at']) ?></td>
            </tr>

            <tr>
                <th>Diubah</th>
                <td><?= esc($applicantType['updated_at']) ?></td>
            </tr>

        </table>

    </div>

    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4 text-end">

        <a
            href="<?= site_url('master/applicant-types') ?>"
            class="btn btn-light px-4">

            Kembali

        </a>

        <a
            href="<?= site_url('master/applicant-types/edit/' . $applicantType['id']) ?>"
            class="btn btn-warning">

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>

