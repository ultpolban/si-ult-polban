<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Management Jurusan</h3>
            <p class="text-muted mb-0">Kelola data jurusan di lingkungan POLBAN</p>
        </div>
        <button class="btn btn-filter-submit d-flex align-items-center" data-toggle="modal" data-target="#tambahJurusanModal" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15); border: none; font-weight: 600;">
            <i class="fas fa-plus mr-1"></i> Tambah Jurusan
        </button>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer"></div>

    <!-- Jurusan Table Card -->
    <div class="card card-premium">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0; border-bottom: 4px solid #F58220 !important;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.05rem; letter-spacing: 0.4px;">Daftar Jurusan</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 150px;">Kode</th>
                            <th>Nama Jurusan</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($jurusans) && count($jurusans) > 0): ?>
                            <?php $no = 1; foreach ($jurusans as $j): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                            <?= esc($j['kode']) ?>
                                        </span>
                                    </td>
                                    <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($j['nama_jurusan']) ?></td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                            <button type="button" class="btn-icon-action" title="Edit" onclick="editJurusan(<?= $j['id'] ?>)" style="background: #f59e0b; color: #fff;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn-icon-action" title="Hapus" onclick="hapusJurusan(<?= $j['id'] ?>)" style="background: #ef4444; color: #fff;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Tidak ada data jurusan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Jurusan Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahJurusan">
                    <div class="form-group mb-3">
                        <label for="kode" class="font-weight-bold text-dark mb-1">Kode Jurusan</label>
                        <input type="text" class="form-control" id="kode" placeholder="Contoh: AN, ELE, JTK" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="namaJurusan" class="font-weight-bold text-dark mb-1">Nama Jurusan</label>
                        <input type="text" class="form-control" id="namaJurusan" placeholder="Masukkan nama jurusan" style="border-radius: 8px; height: 42px;" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="simpanJurusan()" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 8px; padding: 8px 20px;">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Jurusan -->
<div class="modal fade" id="editJurusanModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>Edit Jurusan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditJurusan">
                    <input type="hidden" id="jurusanIdEdit">
                    <div class="form-group mb-3">
                        <label for="editKode" class="font-weight-bold text-dark mb-1">Kode Jurusan</label>
                        <input type="text" class="form-control" id="editKode" placeholder="Contoh: AN, ELE, JTK" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editNamaJurusan" class="font-weight-bold text-dark mb-1">Nama Jurusan</label>
                        <input type="text" class="form-control" id="editNamaJurusan" placeholder="Masukkan nama jurusan" style="border-radius: 8px; height: 42px;" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="updateJurusan()" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff; border-radius: 8px; padding: 8px 20px; border: none;">
                    <i class="fas fa-save mr-1"></i> Perbarui
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function simpanJurusan() {
        const kode = document.getElementById('kode').value.trim();
        const nama = document.getElementById('namaJurusan').value.trim();

        if (!kode || !nama) {
            alert('Kode dan Nama jurusan tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('jurusan/store') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'kode=' + encodeURIComponent(kode) + '&nama_jurusan=' + encodeURIComponent(nama)
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('formTambahJurusan').reset();
                $('#tambahJurusanModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function editJurusan(id) {
        fetch('<?= base_url('jurusan/edit') ?>/' + id, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('editKode').value = data.data.kode || '';
                document.getElementById('editNamaJurusan').value = data.data.nama_jurusan || '';
                document.getElementById('jurusanIdEdit').value = id;
                $('#editJurusanModal').modal('show');
            } else {
                alert(data.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function updateJurusan() {
        const id = document.getElementById('jurusanIdEdit').value;
        const kode = document.getElementById('editKode').value.trim();
        const nama = document.getElementById('editNamaJurusan').value.trim();

        if (!kode || !nama) {
            alert('Kode dan Nama jurusan tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('jurusan/update') ?>/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'kode=' + encodeURIComponent(kode) + '&nama_jurusan=' + encodeURIComponent(nama)
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                $('#editJurusanModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }

    function hapusJurusan(id) {
        if (!confirm('Apakah Anda yakin ingin menghapus jurusan ini?')) return;

        fetch('<?= base_url('jurusan/delete') ?>/' + id, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === 'success') {
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(e => {
            console.error(e);
            alert('Request error: ' + e.message);
        });
    }
</script>
<?= $this->endSection() ?>
