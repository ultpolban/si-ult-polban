<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2" style="max-width: 1000px; margin: 0 auto;">

    <!-- Page Title + Back Button -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark mb-0" style="font-weight: 700;">Tambah User</h4>
        <a href="<?= base_url('users') ?>" class="btn btn-sm btn-secondary d-flex align-items-center px-3"
           style="border-radius: 6px; font-weight: 600; background:#6c757d; border:none;">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-3" role="alert" style="border-radius: 8px;">
            <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Perbaiki input berikut:</h6>
            <ul class="mb-0 pl-4">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('users/store') ?>" method="post" enctype="multipart/form-data" id="addUserForm">
        <?= csrf_field() ?>

        <!-- ══════════════════════════════════════════════
             SECTION 1: DATA AKUN
             ══════════════════════════════════════════════ -->
        <div class="card card-premium mb-3" style="border-radius: 10px; overflow: hidden;">
            <div class="section-header" style="background: linear-gradient(90deg, #1e2f99 0%, #2d43c7 100%); padding: 10px 18px;">
                <h6 class="text-white font-weight-bold mb-0" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                    <i class="fas fa-user-shield mr-2"></i>Data Akun
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Role -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="role_id" class="form-label-sm">Role <span class="text-danger">*</span></label>
                        <select name="role_id" id="role_id" class="form-control form-control-sm" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= old('role_id') == $role['id'] ? 'selected' : '' ?>>
                                    <?= $role['role_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Jenis Pemohon — only when role = Pemohon -->
                    <div class="col-md-6 form-group mb-3" id="jenisPemohonWrap" style="display:none;">
                        <label for="jenis_pemohon" class="form-label-sm">Jenis Pemohon</label>
                        <select name="jenis_pemohon" id="jenis_pemohon" class="form-control form-control-sm">
                            <option value="">Pilih</option>
                            <option value="Mahasiswa"  <?= old('jenis_pemohon') == 'Mahasiswa'  ? 'selected' : '' ?>>Mahasiswa</option>
                            <option value="Dosen"      <?= old('jenis_pemohon') == 'Dosen'      ? 'selected' : '' ?>>Dosen</option>
                            <option value="Tendik"     <?= old('jenis_pemohon') == 'Tendik'     ? 'selected' : '' ?>>Tendik</option>
                            <option value="Alumni"     <?= old('jenis_pemohon') == 'Alumni'     ? 'selected' : '' ?>>Alumni</option>
                            <option value="Umum"       <?= old('jenis_pemohon') == 'Umum'       ? 'selected' : '' ?>>Umum</option>
                        </select>
                    </div>
                    <!-- Unit Kerja — only when role != Pemohon -->
                    <div class="col-md-6 form-group mb-3" id="unitKerjaWrap">
                        <label for="unit_kerja" class="form-label-sm">Unit Kerja</label>
                        <select name="unit_kerja" id="unit_kerja" class="form-control form-control-sm">
                            <option value="">Pilih Unit Kerja</option>
                            <option value="Direktorat"          <?= old('unit_kerja') == 'Direktorat'          ? 'selected' : '' ?>>Direktorat</option>
                            <option value="Bagian Akademik"     <?= old('unit_kerja') == 'Bagian Akademik'     ? 'selected' : '' ?>>Bagian Akademik</option>
                            <option value="Bagian Keuangan"     <?= old('unit_kerja') == 'Bagian Keuangan'     ? 'selected' : '' ?>>Bagian Keuangan</option>
                            <option value="Bagian Kemahasiswaan"<?= old('unit_kerja') == 'Bagian Kemahasiswaan'? 'selected' : '' ?>>Bagian Kemahasiswaan</option>
                            <option value="Perpustakaan"        <?= old('unit_kerja') == 'Perpustakaan'        ? 'selected' : '' ?>>Perpustakaan</option>
                            <option value="UPT TIK"             <?= old('unit_kerja') == 'UPT TIK'             ? 'selected' : '' ?>>UPT TIK</option>
                            <option value="UPT Bahasa"          <?= old('unit_kerja') == 'UPT Bahasa'          ? 'selected' : '' ?>>UPT Bahasa</option>
                            <option value="UPT K3"              <?= old('unit_kerja') == 'UPT K3'              ? 'selected' : '' ?>>UPT K3</option>
                            <option value="Humas"               <?= old('unit_kerja') == 'Humas'               ? 'selected' : '' ?>>Humas</option>
                            <option value="SPI"                 <?= old('unit_kerja') == 'SPI'                 ? 'selected' : '' ?>>SPI</option>
                        </select>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="name" class="form-label-sm">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm"
                               placeholder="Masukkan nama lengkap" value="<?= old('name') ?>" required>
                    </div>
                    <!-- Email Personal -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="email_pribadi" class="form-label-sm">Email Personal <span class="text-danger">*</span></label>
                        <input type="email" name="email_pribadi" id="email_pribadi" class="form-control form-control-sm"
                               placeholder="example@gmail.com" value="<?= old('email_pribadi') ?>">
                    </div>

                    <!-- Email Institusi -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="email" class="form-label-sm">Email Institusi</label>
                        <input type="email" name="email" id="email" class="form-control form-control-sm"
                               placeholder="example@polban.ac.id" value="<?= old('email') ?>">
                    </div>
                    <!-- Password -->
                    <div class="col-md-4 form-group mb-3">
                        <label for="password" class="form-label-sm">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" id="password" class="form-control form-control-sm"
                               placeholder="Minimal 6 karakter" required>
                    </div>
                    <!-- Status -->
                    <div class="col-md-2 form-group mb-3">
                        <label for="is_active" class="form-label-sm">Status</label>
                        <select name="is_active" id="is_active" class="form-control form-control-sm">
                            <option value="1" <?= old('is_active','1') == '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= old('is_active') == '0' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════
             SECTION 2: DATA PRIBADI
             ══════════════════════════════════════════════ -->
        <div class="card card-premium mb-3" style="border-radius: 10px; overflow: hidden;">
            <div class="section-header" style="background: linear-gradient(90deg, #166534 0%, #16a34a 100%); padding: 10px 18px;">
                <h6 class="text-white font-weight-bold mb-0" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                    <i class="fas fa-id-card mr-2"></i>Data Pribadi
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- Photo upload column -->
                    <div class="col-md-3 d-flex flex-column align-items-center mb-3">
                        <div id="photoPreview" style="
                            width: 130px; height: 130px; background: #e9ecef;
                            border: 2px dashed #adb5bd; border-radius: 10px;
                            display: flex; align-items: center; justify-content: center;
                            overflow: hidden; cursor: pointer; margin-bottom: 8px;">
                            <div class="text-center text-muted" id="photoPlaceholder">
                                <i class="fas fa-camera fa-2x mb-1"></i>
                                <div style="font-size: 0.75rem;">Foto</div>
                            </div>
                        </div>
                        <div style="font-size: 0.72rem; color: #6c757d; text-align: center; margin-bottom: 6px;">
                            JPG, JPEG, PNG (Maks. 2 MB)
                        </div>
                        <input type="file" name="foto" id="foto" accept="image/jpg,image/jpeg,image/png"
                               style="font-size: 0.78rem;" onchange="previewPhoto(this)">
                    </div>

                    <!-- Fields column -->
                    <div class="col-md-9">
                        <div class="row">
                            <!-- Jenis Kelamin -->
                            <div class="col-md-6 form-group mb-3">
                                <label for="jenis_kelamin" class="form-label-sm">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-sm">
                                    <option value="">Pilih</option>
                                    <option value="Laki-laki"  <?= old('jenis_kelamin') == 'Laki-laki'  ? 'selected' : '' ?>>Laki-laki</option>
                                    <option value="Perempuan"  <?= old('jenis_kelamin') == 'Perempuan'  ? 'selected' : '' ?>>Perempuan</option>
                                </select>
                            </div>
                            <!-- No HP -->
                            <div class="col-md-6 form-group mb-3">
                                <label for="phone" class="form-label-sm">Nomor HP</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-sm"
                                       placeholder="08xxxxxxxxxx" value="<?= old('phone') ?>">
                            </div>
                            <!-- Tempat Lahir -->
                            <div class="col-md-6 form-group mb-3">
                                <label for="tempat_lahir" class="form-label-sm">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control form-control-sm"
                                       placeholder="Kota tempat lahir" value="<?= old('tempat_lahir') ?>">
                            </div>
                            <!-- Tanggal Lahir -->
                            <div class="col-md-6 form-group mb-3">
                                <label for="tanggal_lahir" class="form-label-sm">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control form-control-sm"
                                       value="<?= old('tanggal_lahir') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Lengkap (full width) -->
                    <div class="col-12 form-group mb-0">
                        <label for="alamat" class="form-label-sm">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control form-control-sm" rows="3"
                                  placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════
             SECTION 3: DATA MAHASISWA (dynamic)
             ══════════════════════════════════════════════ -->
        <div class="card card-premium mb-3" id="dataMahasiswaSection" style="border-radius: 10px; overflow: hidden; display: none;">
            <div class="section-header" style="background: linear-gradient(90deg, #0369a1 0%, #0ea5e9 100%); padding: 10px 18px;">
                <h6 class="text-white font-weight-bold mb-0" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                    <i class="fas fa-graduation-cap mr-2"></i>Data Mahasiswa
                </h6>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <!-- NIM -->
                    <div class="col-md-4 form-group mb-3">
                        <label for="nim" class="form-label-sm">NIM <span class="text-danger">*</span></label>
                        <input type="text" name="nim" id="nim" class="form-control form-control-sm"
                               placeholder="Nomor Induk Mahasiswa" value="<?= old('nim') ?>">
                    </div>
                    <!-- Jurusan -->
                    <div class="col-md-4 form-group mb-3">
                        <label for="jurusan_id" class="form-label-sm">Jurusan</label>
                        <select name="jurusan_id" id="jurusan_id" class="form-control form-control-sm">
                            <option value="">Pilih Jurusan</option>
                            <?php if (!empty($jurusan)): ?>
                                <?php foreach ($jurusan as $j): ?>
                                    <option value="<?= $j['id'] ?>" <?= old('jurusan_id') == $j['id'] ? 'selected' : '' ?>>
                                        <?= esc($j['nama_jurusan']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <!-- Program Studi -->
                    <div class="col-md-4 form-group mb-3">
                        <label for="prodi_id" class="form-label-sm">Program Studi</label>
                        <select name="prodi_id" id="prodi_id" class="form-control form-control-sm">
                            <option value="">Pilih Program Studi</option>
                            <?php if (!empty($prodi)): ?>
                                <?php foreach ($prodi as $p): ?>
                                    <option value="<?= $p['id'] ?>" <?= old('prodi_id') == $p['id'] ? 'selected' : '' ?>>
                                        <?= esc($p['nama_program']) ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <!-- Kelas -->
                    <div class="col-md-3 form-group mb-3">
                        <label for="kelas" class="form-label-sm">Kelas</label>
                        <select name="kelas" id="kelas" class="form-control form-control-sm">
                            <option value="">Pilih</option>
                            <?php foreach (['1A','1B','1C','1D','2A','2B','2C','2D','3A','3B','3C','3D','4A','4B','4C','4D'] as $k): ?>
                                <option value="<?= $k ?>" <?= old('kelas') == $k ? 'selected' : '' ?>><?= $k ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Angkatan -->
                    <div class="col-md-3 form-group mb-3">
                        <label for="angkatan" class="form-label-sm">Angkatan</label>
                        <input type="text" name="angkatan" id="angkatan" class="form-control form-control-sm"
                               placeholder="Contoh: 2022" value="<?= old('angkatan') ?>">
                    </div>
                    <!-- Status Mahasiswa -->
                    <div class="col-md-3 form-group mb-3">
                        <label for="status_mahasiswa" class="form-label-sm">Status Mahasiswa</label>
                        <select name="status_mahasiswa" id="status_mahasiswa" class="form-control form-control-sm">
                            <option value="">Pilih Status</option>
                            <option value="Aktif"    <?= old('status_mahasiswa') == 'Aktif'    ? 'selected' : '' ?>>Aktif</option>
                            <option value="Cuti"     <?= old('status_mahasiswa') == 'Cuti'     ? 'selected' : '' ?>>Cuti</option>
                            <option value="Lulus"    <?= old('status_mahasiswa') == 'Lulus'    ? 'selected' : '' ?>>Lulus</option>
                            <option value="DO"       <?= old('status_mahasiswa') == 'DO'       ? 'selected' : '' ?>>DO</option>
                        </select>
                    </div>
                    <!-- Tahun Masuk -->
                    <div class="col-md-3 form-group mb-3">
                        <label for="tahun_masuk" class="form-label-sm">Tahun Masuk</label>
                        <input type="text" name="tahun_masuk" id="tahun_masuk" class="form-control form-control-sm"
                               placeholder="Contoh: 2022" value="<?= old('tahun_masuk') ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════════════
             ACTION BUTTONS
             ══════════════════════════════════════════════ -->
        <div class="d-flex justify-content-end align-items-center gap-2 mb-4">
            <a href="<?= base_url('users') ?>" class="btn btn-sm btn-secondary mr-2"
               style="border-radius: 6px; font-weight: 600; background:#6c757d; border:none; padding: 8px 20px;">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
            <button type="reset" class="btn btn-sm btn-outline-secondary mr-2"
                    style="border-radius: 6px; font-weight: 600; padding: 8px 20px;">
                <i class="fas fa-redo mr-1"></i> Reset
            </button>
            <button type="submit" class="btn btn-sm btn-primary"
                    style="border-radius: 6px; font-weight: 600; padding: 8px 24px;
                           background: linear-gradient(135deg,#1e2f99,#2d43c7); border:none;
                           box-shadow: 0 4px 12px rgba(30,47,153,.25);">
                <i class="fas fa-save mr-1"></i> Simpan User
            </button>
        </div>

    </form>
</div>

<style>
/* Compact form label */
.form-label-sm {
    font-size: 0.82rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
    display: block;
}
.form-control-sm {
    height: 36px !important;
    font-size: 0.875rem;
    border-radius: 6px !important;
    border: 1px solid #d1d5db;
}
.form-control-sm:focus {
    border-color: #1e2f99;
    box-shadow: 0 0 0 2px rgba(30,47,153,.15);
}
select.form-control-sm {
    height: 36px !important;
}
textarea.form-control-sm {
    height: auto !important;
}
.section-header {
    border-radius: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    var roleSelect     = document.getElementById('role_id');
    var jenisPemohonWrap = document.getElementById('jenisPemohonWrap');
    var unitKerjaWrap    = document.getElementById('unitKerjaWrap');
    var jenisPemohon     = document.getElementById('jenis_pemohon');
    var mahasiswaSection = document.getElementById('dataMahasiswaSection');

    // Role ID for "Pemohon" — adjust if different in your DB
    var ROLE_PEMOHON_ID = '<?= isset($roles) ? array_reduce($roles, fn($c, $r) => $r['role_name'] === 'Pemohon' ? $r['id'] : $c, '') : '' ?>';

    function toggleSections() {
        var selectedText = roleSelect.options[roleSelect.selectedIndex].text.toLowerCase();
        var isPemohon = selectedText.includes('pemohon');

        if (isPemohon) {
            jenisPemohonWrap.style.display = '';
            unitKerjaWrap.style.display    = 'none';
        } else {
            jenisPemohonWrap.style.display = 'none';
            unitKerjaWrap.style.display    = '';
            mahasiswaSection.style.display = 'none';
        }
    }

    function toggleMahasiswaSection() {
        var val = jenisPemohon.value;
        mahasiswaSection.style.display = (val === 'Mahasiswa') ? '' : 'none';
    }

    roleSelect.addEventListener('change', function() {
        toggleSections();
        toggleMahasiswaSection();
    });

    jenisPemohon.addEventListener('change', toggleMahasiswaSection);

    // Dynamic prodi filter by jurusan
    var jurusanSelect = document.getElementById('jurusan_id');
    var prodiSelect   = document.getElementById('prodi_id');
    var allProdi      = <?php
        $prodiJson = [];
        if (!empty($prodi)) {
            foreach ($prodi as $p) {
                $prodiJson[] = ['id' => $p['id'], 'nama' => $p['nama_program'], 'jurusan_id' => $p['jurusan_id'] ?? ''];
            }
        }
        echo json_encode($prodiJson);
    ?>;

    jurusanSelect.addEventListener('change', function() {
        var jid = this.value;
        prodiSelect.innerHTML = '<option value="">Pilih Program Studi</option>';
        allProdi.forEach(function(p) {
            if (!jid || String(p.jurusan_id) === String(jid)) {
                var opt = document.createElement('option');
                opt.value = p.id;
                opt.textContent = p.nama;
                prodiSelect.appendChild(opt);
            }
        });
    });

    // Photo preview
    window.previewPhoto = function(input) {
        var preview = document.getElementById('photoPreview');
        var placeholder = document.getElementById('photoPlaceholder');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                placeholder.style.display = 'none';
                preview.style.backgroundImage = 'url(' + e.target.result + ')';
                preview.style.backgroundSize  = 'cover';
                preview.style.backgroundPosition = 'center';
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    // Init on load (for validation repopulate)
    toggleSections();
    toggleMahasiswaSection();
});
</script>

<?= $this->endSection() ?>
