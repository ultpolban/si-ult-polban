<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Management Program Studi</h3>
            <p class="text-muted mb-0">Kelola data program studi di lingkungan POLBAN</p>
        </div>
        <button class="btn btn-filter-submit d-flex align-items-center" data-toggle="modal" data-target="#tambahProdiModal" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15); border: none; font-weight: 600;">
            <i class="fas fa-plus mr-1"></i> Tambah Program Studi
        </button>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer"></div>

    <!-- Program Studi Table Card -->
    <div class="card card-premium">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0; border-bottom: 4px solid #F58220 !important;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.05rem; letter-spacing: 0.4px;">Daftar Program Studi</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 120px;">Kode</th>
                            <th>Program Studi</th>
                            <th>Jurusan</th>
                            <th style="width: 100px;">Jenjang</th>
                            <th style="width: 110px; text-align: center;">Status</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($programs) && count($programs) > 0): ?>
                            <?php $no = 1; foreach ($programs as $p): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                            <?= esc($p['kode']) ?>
                                        </span>
                                    </td>
                                    <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($p['nama_program']) ?></td>
                                    <td><?= esc($p['jurusan_nama'] ?? '-') ?></td>
                                    <td>
                                        <span class="badge badge-info px-2 py-1"><?= esc($p['jenjang'] ?? '-') ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-badge <?= ($p['status'] == 'Aktif') ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                            <?= esc($p['status'] ?? 'Aktif') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                            <button type="button" class="btn-icon-action" title="Edit" onclick="editProgram(<?= $p['id'] ?>)" style="background: #f59e0b; color: #fff;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn-icon-action" title="Hapus" onclick="hapusProgram(<?= $p['id'] ?>)" style="background: #ef4444; color: #fff;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Tidak ada data program studi.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Program Studi -->
<div class="modal fade" id="tambahProdiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Program Studi Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahProdi">
                    <div class="form-group mb-3">
                        <label for="kode" class="font-weight-bold text-dark mb-1">Kode Program Studi</label>
                        <input type="text" class="form-control" id="kode" placeholder="Contoh: D3-JTK, D4-TPK" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_program" class="font-weight-bold text-dark mb-1">Nama Program Studi</label>
                        <input type="text" class="form-control" id="nama_program" placeholder="Masukkan nama program studi" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jurusan_id" class="font-weight-bold text-dark mb-1">Jurusan</label>
                        <select id="jurusan_id" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php if (isset($jurusans)): foreach ($jurusans as $j): ?>
                                <option value="<?= $j['id'] ?>"><?= esc($j['nama_jurusan']) ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="jenjang" class="font-weight-bold text-dark mb-1">Jenjang</label>
                        <select id="jenjang" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="status" class="font-weight-bold text-dark mb-1">Status</label>
                        <select id="status" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="simpanProgram()" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 8px; padding: 8px 20px;">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Program Studi -->
<div class="modal fade" id="editProdiModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>Edit Program Studi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditProdi">
                    <input type="hidden" id="editId">
                    <div class="form-group mb-3">
                        <label for="editKode" class="font-weight-bold text-dark mb-1">Kode Program Studi</label>
                        <input type="text" class="form-control" id="editKode" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editNama" class="font-weight-bold text-dark mb-1">Nama Program Studi</label>
                        <input type="text" class="form-control" id="editNama" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editJurusan" class="font-weight-bold text-dark mb-1">Jurusan</label>
                        <select id="editJurusan" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="">-- Pilih Jurusan --</option>
                            <?php if (isset($jurusans)): foreach ($jurusans as $j): ?>
                                <option value="<?= $j['id'] ?>"><?= esc($j['nama_jurusan']) ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="editJenjang" class="font-weight-bold text-dark mb-1">Jenjang</label>
                        <select id="editJenjang" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editStatus" class="font-weight-bold text-dark mb-1">Status</label>
                        <select id="editStatus" class="form-control select-filter w-100" style="height: 42px; border-radius: 8px;">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="updateProgram()" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff; border-radius: 8px; padding: 8px 20px; border: none;">
                    <i class="fas fa-save mr-1"></i> Perbarui
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function simpanProgram() {
        const kode = document.getElementById('kode').value.trim();
        const nama = document.getElementById('nama_program').value.trim();
        const jurusan_id = document.getElementById('jurusan_id').value;
        const jenjang = document.getElementById('jenjang').value;
        const status = document.getElementById('status').value;

        if (!kode || !nama) {
            alert('Kode dan Nama program studi tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('program-studi/store') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'kode=' + encodeURIComponent(kode) +
                '&nama_program=' + encodeURIComponent(nama) +
                '&jurusan_id=' + encodeURIComponent(jurusan_id) +
                '&jenjang=' + encodeURIComponent(jenjang) +
                '&status=' + encodeURIComponent(status)
        })
        .then(r => r.json())
        .then(d => {
            if (d.status === 'success') {
                document.getElementById('formTambahProdi').reset();
                $('#tambahProdiModal').modal('hide');
                location.reload();
            } else {
                alert(d.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function editProgram(id) {
        fetch('<?= base_url('program-studi/edit') ?>/' + id, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(d => {
            if (d.status === 'success') {
                const p = d.data;
                document.getElementById('editId').value = p.id;
                document.getElementById('editKode').value = p.kode || '';
                document.getElementById('editNama').value = p.nama_program || '';
                document.getElementById('editJurusan').value = p.jurusan_id || '';
                document.getElementById('editJenjang').value = p.jenjang || 'D3';
                document.getElementById('editStatus').value = p.status || 'Aktif';
                $('#editProdiModal').modal('show');
            } else {
                alert(d.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function updateProgram() {
        const id = document.getElementById('editId').value;
        const kode = document.getElementById('editKode').value.trim();
        const nama = document.getElementById('editNama').value.trim();
        const jurusan_id = document.getElementById('editJurusan').value;
        const jenjang = document.getElementById('editJenjang').value;
        const status = document.getElementById('editStatus').value;

        if (!kode || !nama) {
            alert('Kode dan Nama program studi tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('program-studi/update') ?>/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'kode=' + encodeURIComponent(kode) +
                '&nama_program=' + encodeURIComponent(nama) +
                '&jurusan_id=' + encodeURIComponent(jurusan_id) +
                '&jenjang=' + encodeURIComponent(jenjang) +
                '&status=' + encodeURIComponent(status)
        })
        .then(r => r.json())
        .then(d => {
            if (d.status === 'success') {
                $('#editProdiModal').modal('hide');
                location.reload();
            } else {
                alert(d.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function hapusProgram(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus program studi ini?')) return;

        fetch('<?= base_url('program-studi/delete') ?>/' + id, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(d => {
            if (d.status === 'success') {
                location.reload();
            } else {
                alert(d.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }
</script>
<?= $this->endSection() ?>
