<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-question-circle-fill me-2"></i> Manajemen FAQ
        </h5>
        <a href="<?= base_url('faqs/create') ?>" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah FAQ
        </a>
    </div>

    <div class="card-body">
        
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="faqTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Kategori</th>
                        <th width="35%">Pertanyaan</th>
                        <th width="10%">Urutan</th>
                        <th width="10%">Status</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($faqs)) : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Tidak ada data FAQ.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($faqs as $faq) : ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td><?= esc($faq['category'] ?: '-') ?></td>
                                <td><?= esc($faq['question']) ?></td>
                                <td class="text-center"><?= $faq['sort_order'] ?></td>
                                <td class="text-center">
                                    <?php if ($faq['is_active']) : ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('faqs/edit/' . $faq['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('faqs/delete/' . $faq['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?');" title="Hapus">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
