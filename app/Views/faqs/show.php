<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Detail FAQ

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="200">

                    Kategori

                </th>

                <td>

                    <?= !empty($faq['category'])
                        ? esc($faq['category'])
                        : '-' ?>

                </td>

            </tr>

            <tr>

                <th>

                    Pertanyaan

                </th>

                <td>

                    <?= esc($faq['question']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Jawaban

                </th>

                <td>

                    <?= nl2br(esc($faq['answer'])) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Urutan

                </th>

                <td>

                    <?= esc($faq['sort_order']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Status

                </th>

                <td>

                    <?php if ($faq['is_active']) : ?>

                        <span class="badge bg-success">

                            Aktif

                        </span>

                    <?php else : ?>

                        <span class="badge bg-danger">

                            Nonaktif

                        </span>

                    <?php endif ?>

                </td>

            </tr>

            <tr>

                <th>

                    Dibuat

                </th>

                <td>

                    <?= esc($faq['created_at']) ?>

                </td>

            </tr>

            <tr>

                <th>

                    Terakhir Diubah

                </th>

                <td>

                    <?= esc($faq['updated_at']) ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a
            href="<?= site_url('faqs') ?>"
            class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <a
            href="<?= site_url('faqs/edit/' . $faq['id']) ?>"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>

            Edit

        </a>

    </div>

</div>

<?= $this->endSection() ?>