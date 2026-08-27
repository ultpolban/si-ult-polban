<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Buat Pengajuan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?= base_url('pengajuan-layanan') ?>">Pengajuan Layanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Buat Pengajuan</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0"><i class="bi bi-send-fill me-2"></i>Buat Pengajuan Layanan</h5>
    </div>
    <div class="card-body">

        <?php if (session()->has('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('pengajuan-layanan/store') ?>" method="post" id="form-pengajuan">
            <?= csrf_field() ?>
            <input type="hidden" name="unit_layanan_id" id="hidden_unit_layanan_id">

            <div class="row">
                <!-- Jenis Unit Layanan -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jenis Unit Layanan <span class="text-danger">*</span></label>
                    <select class="form-select" id="select_unit_layanan" required>
                        <option value="">-- Pilih Jenis Unit Layanan --</option>
                        <?php foreach ($unitLayanans as $unit) : ?>
                            <option value="<?= $unit['id'] ?>">
                                <?= esc($unit['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Layanan (dinamis berdasarkan unit) -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Layanan <span class="text-danger">*</span></label>
                    <select class="form-select" name="layanan_id" id="select_layanan" required disabled>
                        <option value="">-- Pilih Layanan --</option>
                    </select>
                    <div id="loading_layanan" class="text-muted small mt-1 d-none">
                        <span class="spinner-border spinner-border-sm me-1"></span> Memuat layanan...
                    </div>
                </div>
            </div>

            <!-- Box Persyaratan (muncul setelah layanan dipilih) -->
            <div id="box_persyaratan" class="d-none mb-3">
                <div class="card border-warning">
                    <div class="card-header bg-warning bg-opacity-10 py-2">
                        <h6 class="mb-0 text-warning-emphasis">
                            <i class="bi bi-clipboard-check me-1"></i>
                            Persyaratan Layanan
                        </h6>
                    </div>
                    <div class="card-body" id="list_persyaratan">
                        <!-- Diisi via AJAX -->
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Judul -->
                <div class="col-md-8 mb-3">
                    <label class="form-label">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="judul" value="<?= old('judul') ?>" required placeholder="Tulis judul pengajuan...">
                </div>

                <!-- Prioritas -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Prioritas</label>
                    <select class="form-select" name="prioritas" required>
                        <option value="Normal" <?= old('prioritas') == 'Normal' ? 'selected' : '' ?>>Normal</option>
                        <option value="Penting" <?= old('prioritas') == 'Penting' ? 'selected' : '' ?>>Penting</option>
                        <option value="Mendesak" <?= old('prioritas') == 'Mendesak' ? 'selected' : '' ?>>Mendesak</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="4" placeholder="Jelaskan keperluan pengajuan Anda..."><?= old('deskripsi') ?></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Ajukan
                </button>
                <a href="<?= base_url('pengajuan-layanan') ?>" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

<script>
const baseUrl = '<?= base_url() ?>';

// --- Event: Pilih Unit Layanan → Load Layanan via AJAX ---
document.getElementById('select_unit_layanan').addEventListener('change', function () {
    const unitId = this.value;
    const selectLayanan = document.getElementById('select_layanan');
    const hiddenUnit = document.getElementById('hidden_unit_layanan_id');
    const loadingLayanan = document.getElementById('loading_layanan');
    const boxPersyaratan = document.getElementById('box_persyaratan');

    // Reset layanan dropdown
    selectLayanan.innerHTML = '<option value="">-- Pilih Layanan --</option>';
    selectLayanan.disabled = true;
    hiddenUnit.value = unitId;

    // Sembunyikan persyaratan
    boxPersyaratan.classList.add('d-none');

    if (!unitId) return;

    // Tampilkan loading
    loadingLayanan.classList.remove('d-none');

    fetch(`${baseUrl}pengajuan-layanan/layanan-by-unit/${unitId}`)
        .then(res => res.json())
        .then(data => {
            loadingLayanan.classList.add('d-none');

            if (data.length === 0) {
                selectLayanan.innerHTML = '<option value="">-- Tidak ada layanan tersedia --</option>';
                return;
            }

            data.forEach(item => {
                const opt = document.createElement('option');
                opt.value = item.id;
                opt.textContent = item.name;
                selectLayanan.appendChild(opt);
            });

            selectLayanan.disabled = false;
        })
        .catch(() => {
            loadingLayanan.classList.add('d-none');
            selectLayanan.innerHTML = '<option value="">-- Gagal memuat layanan --</option>';
        });
});

// --- Event: Pilih Layanan → Load Persyaratan via AJAX ---
document.getElementById('select_layanan').addEventListener('change', function () {
    const layananId = this.value;
    const boxPersyaratan = document.getElementById('box_persyaratan');
    const listPersyaratan = document.getElementById('list_persyaratan');

    if (!layananId) {
        boxPersyaratan.classList.add('d-none');
        return;
    }

    listPersyaratan.innerHTML = '<div class="text-center py-2"><span class="spinner-border spinner-border-sm"></span> Memuat persyaratan...</div>';
    boxPersyaratan.classList.remove('d-none');

    fetch(`${baseUrl}pengajuan-layanan/persyaratan-by-layanan/${layananId}`)
        .then(res => res.json())
        .then(data => {
            if (data.length === 0) {
                listPersyaratan.innerHTML = '<p class="text-muted mb-0"><i class="bi bi-info-circle me-1"></i>Layanan ini tidak memiliki persyaratan khusus.</p>';
                return;
            }

            let html = '<ul class="list-group list-group-flush">';
            data.forEach(item => {
                const badge = item.is_required == 1
                    ? '<span class="badge bg-danger ms-2">Wajib</span>'
                    : '<span class="badge bg-secondary ms-2">Opsional</span>';

                const fileInfo = item.file_type
                    ? `<small class="text-muted d-block">Format: ${item.file_type}${item.max_file_size ? ' | Maks: ' + item.max_file_size + ' MB' : ''}</small>`
                    : '';

                html += `
                    <li class="list-group-item px-0 border-0">
                        <i class="bi bi-check2-circle text-success me-2"></i>
                        <strong>${item.name}</strong>${badge}
                        ${fileInfo}
                    </li>`;
            });
            html += '</ul>';

            listPersyaratan.innerHTML = html;
        })
        .catch(() => {
            listPersyaratan.innerHTML = '<p class="text-danger mb-0">Gagal memuat persyaratan.</p>';
        });
});
</script>

<?= $this->endSection() ?>
