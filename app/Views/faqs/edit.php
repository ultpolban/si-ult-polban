<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card card-custom">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="bi bi-pencil-square me-2"></i> Edit FAQ
        </h5>
        <a href="<?= base_url('faqs') ?>" class="btn btn-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('faqs/update/' . $faq['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Kategori <span class="text-muted">(Opsional)</span></label>
                <input type="text" name="category" class="form-control" value="<?= old('category', $faq['category']) ?>" placeholder="Misal: Layanan Umum, Pengaduan, dll">
            </div>

            <div class="mb-3">
                <label class="form-label">Pertanyaan <span class="text-danger">*</span></label>
                <input type="text" name="question" class="form-control" value="<?= old('question', $faq['question']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jawaban <span class="text-danger">*</span></label>
                <textarea name="answer" rows="4" class="form-control" required><?= old('answer', $faq['answer']) ?></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="sort_order" class="form-control" value="<?= old('sort_order', $faq['sort_order']) ?>" required>
                    <small class="text-muted">Angka lebih kecil akan tampil lebih dulu.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Status</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" <?= old('is_active', $faq['is_active']) ? 'checked' : '' ?>>
                        <label class="form-check-label" for="isActive">Aktif</label>
                    </div>
                </div>
            </div>

            <hr>
            
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Perbarui FAQ
            </button>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
