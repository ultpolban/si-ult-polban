<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Kategori</label>

                <input
                    type="text"
                    name="category"
                    class="form-control"
                    placeholder="Contoh: Pengajuan Layanan"
                    value="<?= old('category', $faq['category'] ?? '') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $faq['sort_order'] ?? 1) ?>">

            </div>

            <div class="col-md-2 mb-3">

                <label>Status</label>

                <select
                    name="is_active"
                    class="form-control">

                    <option value="1"
                        <?= old('is_active', $faq['is_active'] ?? '1') == '1' ? 'selected' : '' ?>>
                        Aktif
                    </option>

                    <option value="0"
                        <?= old('is_active', $faq['is_active'] ?? '1') == '0' ? 'selected' : '' ?>>
                        Nonaktif
                    </option>

                </select>

            </div>

        </div>

        <div class="mb-3">

            <label>Pertanyaan</label>

            <input
                type="text"
                name="question"
                class="form-control"
                value="<?= old('question', $faq['question'] ?? '') ?>">

        </div>

        <div class="mb-3">

            <label>Jawaban</label>

            <textarea
                name="answer"
                rows="6"
                class="form-control"><?= old('answer', $faq['answer'] ?? '') ?></textarea>

            <small class="text-muted">
                Gunakan &lt;br&gt; untuk baris baru, atau biarkan teks apa adanya.
            </small>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a
            href="<?= site_url('faqs') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>