<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 class="font-weight-bold" style="color:#0b3d91;">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Draft Pengajuan
                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dosen/dashboard') ?>">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dosen/ticket/draft') ?>">Draft Pengajuan</a>
                        </li>

                        <li class="breadcrumb-item active">Edit Draft</li>

                    </ol>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card shadow-sm border-0">

                <div class="card-header text-white" style="background-color:#0b3d91;border-bottom:4px solid #f28c28;">
                    <h5 class="mb-0">
                        <i class="fas fa-file-alt mr-2"></i>
                        Lanjutkan Draft Pengajuan
                    </h5>
                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <?= esc(session()->getFlashdata('error')) ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('dosen/ticket/draft/update/' . $draft_index) ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-building mr-1"></i>
                                Unit Layanan
                            </label>
                            <select name="unit_tujuan" id="unit_layanan" class="form-control" required>
                                <option value="">-- Pilih Unit Layanan --</option>
                                <option value="Akademik" <?= (($draft['unit_tujuan'] ?? $draft['unit'] ?? '') === 'Akademik') ? 'selected' : '' ?>>Akademik</option>
                                <option value="Kemahasiswaan" <?= (($draft['unit_tujuan'] ?? $draft['unit'] ?? '') === 'Kemahasiswaan') ? 'selected' : '' ?>>Kemahasiswaan</option>
                                <option value="Keuangan" <?= (($draft['unit_tujuan'] ?? $draft['unit'] ?? '') === 'Keuangan') ? 'selected' : '' ?>>Keuangan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-list mr-1"></i>
                                Jenis Layanan
                            </label>
                            <select name="jenis_layanan" id="layanan" class="form-control" required>
                                <option value="">-- Pilih Jenis Layanan --</option>
                                <option value="<?= esc($draft['jenis_layanan'] ?? $draft['layanan'] ?? '') ?>" selected>
                                    <?= esc($draft['jenis_layanan'] ?? $draft['layanan'] ?? 'Pilih Jenis Layanan') ?>
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-align-left mr-1"></i>
                                Keterangan
                            </label>
                            <textarea name="keterangan" class="form-control" rows="5" placeholder="Masukkan keterangan pengajuan..." required><?= esc($draft['keterangan'] ?? $draft['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">
                                <i class="fas fa-paperclip mr-1"></i>
                                Dokumen Pendukung
                            </label>
                            <input type="file" name="dokumen" class="form-control" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                            <small class="text-muted">Format PDF, JPG, JPEG, PNG, DOC, DOCX. Maksimal 2 MB.</small>
                        </div>

                        <div class="d-flex justify-content-end flex-wrap">
                            <a href="<?= base_url('dosen/ticket/draft') ?>" class="btn btn-secondary mr-2 mb-2">
                                <i class="fas fa-arrow-left mr-1"></i>
                                Kembali
                            </a>
                            <button type="submit" class="btn text-white mb-2" style="background-color:#0b3d91;border-color:#0b3d91;">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Ajukan Layanan
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>