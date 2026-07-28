<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Management Unit Kerja</h3>
            <p class="text-muted mb-0">Kelola data unit kerja di lingkungan POLBAN</p>
        </div>
        <button class="btn btn-filter-submit d-flex align-items-center" data-toggle="modal" data-target="#tambahUnitModal" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15); border: none; font-weight: 600;">
            <i class="fas fa-plus mr-1"></i> Tambah Unit Kerja
        </button>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer"></div>

    <!-- Unit Table Card -->
    <div class="card card-premium">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0; border-bottom: 4px solid #F58220 !important;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.05rem; letter-spacing: 0.4px;">Daftar Unit Kerja</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 250px;">Nama Unit</th>
                            <th>Deskripsi</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($units) && count($units) > 0): ?>
                            <?php $no = 1; foreach ($units as $unit): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($unit['unit_name']) ?></td>
                                    <td class="text-muted"><?= esc($unit['description'] ?? '-') ?></td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                            <button type="button" class="btn-icon-action" title="Edit" onclick="editUnit(<?= $unit['id'] ?>)" style="background: #f59e0b; color: #fff;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn-icon-action" title="Hapus" onclick="hapusUnit(<?= $unit['id'] ?>)" style="background: #ef4444; color: #fff;">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Tidak ada data unit kerja.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Unit -->
<div class="modal fade" id="tambahUnitModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Unit Kerja Baru
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formTambahUnit">
                    <div class="form-group mb-3">
                        <label for="namaUnit" class="font-weight-bold text-dark mb-1">Nama Unit</label>
                        <input type="text" class="form-control" id="namaUnit" placeholder="Masukkan nama unit kerja" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="deskripsi" class="font-weight-bold text-dark mb-1">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" rows="3" placeholder="Masukkan deskripsi unit kerja" style="border-radius: 8px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="simpanUnit()" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 8px; padding: 8px 20px;">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Unit -->
<div class="modal fade" id="editUnitModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border-radius: 12px 12px 0 0;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>Edit Unit Kerja
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form id="formEditUnit">
                    <input type="hidden" id="unitIdEdit">
                    <div class="form-group mb-3">
                        <label for="editNamaUnit" class="font-weight-bold text-dark mb-1">Nama Unit</label>
                        <input type="text" class="form-control" id="editNamaUnit" placeholder="Masukkan nama unit kerja" style="border-radius: 8px; height: 42px;" required>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editDeskripsi" class="font-weight-bold text-dark mb-1">Deskripsi</label>
                        <textarea class="form-control" id="editDeskripsi" rows="3" placeholder="Masukkan deskripsi unit kerja" style="border-radius: 8px;"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 px-4 pb-4 pt-0">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
                <button type="button" class="btn font-weight-bold" onclick="updateUnit()" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: #fff; border-radius: 8px; padding: 8px 20px; border: none;">
                    <i class="fas fa-save mr-1"></i> Perbarui
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    function showAlert(message, type = 'success') {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} mr-2"></i> ${message}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `;
        document.getElementById('alertContainer').innerHTML = alertHtml;
    }

    function simpanUnit() {
        const namaUnit = document.getElementById('namaUnit').value.trim();
        const deskripsi = document.getElementById('deskripsi').value.trim();

        if (namaUnit === '') {
            alert('Nama unit tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('units/store') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'unit_name=' + encodeURIComponent(namaUnit) +
                '&description=' + encodeURIComponent(deskripsi)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('formTambahUnit').reset();
                $('#tambahUnitModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan/server: ' + error.message);
        });
    }

    function editUnit(id) {
        fetch('<?= base_url('units/edit') ?>/' + id, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                document.getElementById('editNamaUnit').value = data.data.unit_name || '';
                document.getElementById('editDeskripsi').value = data.data.description || '';
                document.getElementById('unitIdEdit').value = id;
                $('#editUnitModal').modal('show');
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan data: ' + error.message);
        });
    }

    function updateUnit() {
        const id = document.getElementById('unitIdEdit').value;
        const namaUnit = document.getElementById('editNamaUnit').value.trim();
        const deskripsi = document.getElementById('editDeskripsi').value.trim();

        if (namaUnit === '') {
            alert('Nama unit tidak boleh kosong!');
            return;
        }

        fetch('<?= base_url('units/update') ?>/' + id, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: 'unit_name=' + encodeURIComponent(namaUnit) +
                '&description=' + encodeURIComponent(deskripsi)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                $('#editUnitModal').modal('hide');
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan update: ' + error.message);
        });
    }

    function hapusUnit(id) {
        if (confirm('Apakah Anda yakin ingin menghapus unit kerja ini?')) {
            fetch('<?= base_url('units/delete') ?>/' + id, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus: ' + error.message);
            });
        }
    }
</script>
<?= $this->endSection() ?>
