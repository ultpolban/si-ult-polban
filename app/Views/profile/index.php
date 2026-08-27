<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
    // Lookup helpers
    $applicantTypeMap = array_column($applicantTypes, 'name', 'id');
    $studyProgramMap  = array_column($studyPrograms,  'name', 'id');
    $classMap         = array_column($classes,         'name', 'id');
?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 bg-success bg-opacity-10 text-success mb-4">
        <i class="bi bi-check-circle-fill me-2"></i><?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row g-4">
    <!-- Kartu Avatar + Info Singkat -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100 text-center overflow-hidden">
            <!-- Header bg gradient -->
            <div style="height: 90px; background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);"></div>
            <div class="card-body pt-0 pb-4 px-4">
                <!-- Avatar -->
                <div class="position-relative d-inline-block" style="margin-top: -48px;">
                    <div class="rounded-circle border border-4 border-white shadow bg-white d-flex align-items-center justify-content-center overflow-hidden" style="width: 96px; height: 96px; font-size: 2.2rem;">
                        <?php
                        $photo = $user['profile_photo'] ?? ($user['photo'] ?? null);
                    ?>
                    <?php if (!empty($photo)) : ?>
                        <img src="<?= base_url('uploads/profiles/' . $photo) ?>" alt="avatar" class="w-100 h-100 object-fit-cover">
                    <?php else : ?>
                        <span class="fw-bold text-primary">
                            <?= strtoupper(substr(esc($user['name'] ?? 'U'), 0, 1)) ?>
                        </span>
                    <?php endif; ?>
                    </div>
                </div>

                <h5 class="fw-bold mt-2 mb-0 text-dark"><?= esc($user['name'] ?? 'Pengguna') ?></h5>
                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1 mt-1 mb-3">
                    <?= esc($user['role_name'] ?? 'User') ?>
                </span>

                <hr class="border-light opacity-50">

                <div class="text-start small text-secondary">
                    <div class="d-flex align-items-start mb-2 gap-2">
                        <i class="bi bi-envelope-fill text-primary mt-1"></i>
                        <span><?= esc($user['email'] ?? '-') ?></span>
                    </div>
                    <div class="d-flex align-items-start mb-2 gap-2">
                        <i class="bi bi-telephone-fill text-primary mt-1"></i>
                        <span><?= esc($user['phone'] ?? '-') ?></span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-geo-alt-fill text-primary mt-1"></i>
                        <span><?= esc($user['address'] ?? '-') ?></span>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="<?= base_url('profil/edit') ?>" class="btn btn-primary w-100 rounded-pill shadow-sm">
                        <i class="bi bi-pencil-fill me-2"></i>Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Informasi -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-bottom border-light py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-person-lines-fill me-2 text-primary"></i>Informasi Lengkap</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">

                    <?php
                    $info = [
                        ['label' => 'Nama Lengkap',    'icon' => 'bi-person',          'value' => $user['name'] ?? '-'],
                        ['label' => 'Email',            'icon' => 'bi-envelope',        'value' => $user['email'] ?? '-'],
                        ['label' => 'No. Telepon',      'icon' => 'bi-telephone',       'value' => $user['phone'] ?? '-'],
                        ['label' => 'Jenis Pemohon',    'icon' => 'bi-tag',             'value' => $applicantTypeMap[$user['applicant_type_id'] ?? ''] ?? '-'],
                        ['label' => 'NIM',              'icon' => 'bi-123',             'value' => $user['nim'] ?? '-'],
                        ['label' => 'NIK',              'icon' => 'bi-card-text',       'value' => $user['nik'] ?? '-'],
                        ['label' => 'Program Studi',    'icon' => 'bi-mortarboard',     'value' => $studyProgramMap[$user['study_program_id'] ?? ''] ?? '-'],
                        ['label' => 'Kelas',            'icon' => 'bi-people',          'value' => $classMap[$user['class_id'] ?? ''] ?? '-'],
                    ];
                    ?>

                    <?php foreach ($info as $item) : ?>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light bg-opacity-50">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                    <i class="bi <?= $item['icon'] ?> fs-6"></i>
                                </div>
                                <div>
                                    <div class="text-muted small"><?= $item['label'] ?></div>
                                    <div class="fw-semibold text-dark"><?= esc($item['value']) ?></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Alamat full width -->
                    <div class="col-12">
                        <div class="d-flex align-items-start gap-3 p-3 rounded-3 bg-light bg-opacity-50">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 40px; height: 40px;">
                                <i class="bi bi-geo-alt fs-6"></i>
                            </div>
                            <div>
                                <div class="text-muted small">Alamat</div>
                                <div class="fw-semibold text-dark"><?= esc($user['address'] ?? '-') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
