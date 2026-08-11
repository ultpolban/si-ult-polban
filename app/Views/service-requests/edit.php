<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-edit"></i>

            Edit Pengajuan

        </h3>

    </div>

    <div class="card-body">

        <form action="<?= site_url('service-requests/update/' . $request['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Layanan <span class="text-danger">*</span></label>

                    <select name="service_id" class="form-control" required>

                        <option value="">-- Pilih Layanan --</option>

                        <?php foreach ($services as $s): ?>

                            <option value="<?= $s['id'] ?>"
                                <?= ($s['id'] == ($request['service_id'] ?? '')) ? 'selected' : '' ?>>

                                <?= esc($s['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Prioritas</label>

                    <select name="priority" class="form-control">

                        <?php
                        $priorities = [
                            'low'    => 'Rendah',
                            'normal' => 'Normal',
                            'high'   => 'Tinggi',
                            'urgent' => 'Segera',
                        ];
                        foreach ($priorities as $val => $label):
                        ?>

                            <option value="<?= $val ?>"
                                <?= ($val === ($request['priority'] ?? 'normal')) ? 'selected' : '' ?>>

                                <?= $label ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="mb-3">

                <label>Judul <span class="text-danger">*</span></label>

                <input type="text" name="title"
                    class="form-control"
                    maxlength="255"
                    value="<?= esc($request['title'] ?? '') ?>"
                    required>

            </div>

            <div class="mb-3">

                <label>Deskripsi</label>

                <textarea name="description" rows="4"
                    class="form-control"><?= esc($request['description'] ?? '') ?></textarea>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>

                Simpan

            </button>

            <a href="<?= site_url('service-requests/show/' . $request['id']) ?>"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>