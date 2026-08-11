<?php $isEdit = !empty($ticket['id']); ?>
<div class="row">
    <div class="col-md-6 mb-3">

        <label class="form-label">
            Pemohon <span class="text-danger">*</span>
        </label>

        <select
            name="user_profile_id"
            class="form-select"
            required>

            <option value="">Pilih Pemohon</option>

            <?php if (!empty($applicants)): ?>

                <?php foreach ($applicants as $applicant): ?>

                    <option
                        value="<?= esc($applicant['id']) ?>"
                        <?= (
                            !empty($ticket['user_profile_id']) &&
                            $ticket['user_profile_id'] == $applicant['id']
                        ) ? 'selected' : '' ?>>

                        <?= esc($applicant['name'] ?? '-') ?>

                        <?php if (!empty($applicant['applicant_type'])): ?>
                            (<?= esc($applicant['applicant_type']) ?>)
                        <?php endif; ?>

                    </option>

                <?php endforeach; ?>

            <?php else: ?>

                <option value="" disabled>
                    Belum ada data pemohon
                </option>

            <?php endif; ?>

        </select>

    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Layanan <span class="text-danger">*</span></label>
        <select name="service_id" class="form-select" required>
            <option value="">Pilih Layanan</option>
            <?php foreach ($services as $service): ?>
                <option value="<?= $service['id'] ?>" <?= (!empty($ticket['service_id']) && $ticket['service_id'] == $service['id']) ? 'selected' : '' ?>><?= esc($service['name'] ?? '-') ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Judul <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control" value="<?= esc($ticket['title'] ?? '') ?>" placeholder="Judul tiket" required>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control" placeholder="Deskripsi masalah / kebutuhan"><?= esc($ticket['description'] ?? '') ?></textarea>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Prioritas <span class="text-danger">*</span></label>
        <select name="priority" class="form-select" required>
            <?php foreach (['low' => 'Rendah', 'normal' => 'Normal', 'high' => 'Tinggi', 'urgent' => 'Urgent'] as $value => $label): ?>
                <option value="<?= $value ?>" <?= ($ticket['priority'] ?? 'normal') === $value ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Ditugaskan ke</label>
        <select name="assigned_to" class="form-select">
            <option value="">Pilih Petugas</option>
            <?php foreach ($assignees as $assignee): ?>
                <option value="<?= $assignee['id'] ?>" <?= (!empty($ticket['assigned_to']) && $ticket['assigned_to'] == $assignee['id']) ? 'selected' : '' ?>><?= esc($assignee['full_name'] ?? '-') ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>