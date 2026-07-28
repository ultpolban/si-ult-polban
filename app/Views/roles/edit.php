<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2" style="max-width: 700px; margin: 0 auto;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Edit Role</h3>
            <p class="text-muted mb-0">Ubah data role pengguna</p>
        </div>
        <a href="<?= base_url('roles') ?>" class="btn btn-secondary px-3 d-flex align-items-center" style="border-radius: 8px; font-weight: 600; border: none; box-shadow: 0 4px 10px rgba(108,117,125,0.15);">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <!-- Alert Errors -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Perbaiki input berikut:</h6>
            <ul class="mb-0 pl-4">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card card-premium">
        <div class="card-header border-bottom-0 py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.05rem;">Edit Role</h5>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('roles/update/' . $role['id']) ?>" method="post">

                <div class="form-group mb-3">
                    <label for="role_name" class="font-weight-bold text-dark mb-1">Nama Role</label>
                    <input type="text" name="role_name" id="role_name" class="form-control"
                           style="border-radius: 8px; height: 42px;"
                           placeholder="Contoh: Petugas ULT"
                           value="<?= esc(old('role_name', $role['role_name'])) ?>" required>
                </div>

                <div class="form-group mb-4">
                    <label for="description" class="font-weight-bold text-dark mb-1">Deskripsi</label>
                    <textarea name="description" id="description" class="form-control" rows="3"
                              style="border-radius: 8px;"
                              placeholder="Deskripsi singkat tentang role ini"><?= esc(old('description', $role['description'])) ?></textarea>
                </div>

                <div class="d-flex justify-content-start pt-2 border-top" style="gap: 8px;">
                    <button type="submit" class="btn px-4 mr-2 font-weight-bold" style="height: 40px; border-radius: 8px; background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); color: #fff; border: none; box-shadow: 0 4px 10px rgba(11,34,64,0.15);">
                        Update
                    </button>
                    <a href="<?= base_url('roles') ?>" class="btn btn-secondary px-4 d-flex align-items-center justify-content-center font-weight-bold" style="height: 40px; border-radius: 8px; border: none;">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

