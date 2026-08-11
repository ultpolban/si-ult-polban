<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail Jenis Pemohon

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

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

    <div class="card-footer">

        <a
            href="<?= site_url('master/applicant-types') ?>"
            class="btn btn-secondary">

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