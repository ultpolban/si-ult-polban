<?php
$isEdit = !empty($ticket['id']);
$selectedServiceId = $ticket['service_id'] ?? '';
$selectedUnitId = '';
if ($selectedServiceId !== '' && !empty($services)) {
    foreach ($services as $_svc) {
        if ((string) $_svc['id'] === (string) $selectedServiceId) {
            $selectedUnitId = (string) ($_svc['service_unit_id'] ?? '');
            break;
        }
    }
}
?>
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
        <label class="form-label">Jenis Unit Layanan <span class="text-danger">*</span></label>
        <select id="service_unit_id" class="form-select" required>
            <option value="">Pilih Jenis Unit Layanan</option>
            <?php foreach ($serviceUnits as $unit): ?>
                <option value="<?= esc($unit['id']) ?>" <?= ((string) $unit['id'] === $selectedUnitId) ? 'selected' : '' ?>><?= esc($unit['name'] ?? '-') ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Layanan <span class="text-danger">*</span></label>
        <select name="service_id" id="service_id" class="form-select" required>
            <option value="">Pilih Layanan</option>
            <?php foreach ($services as $service): ?>
                <option value="<?= $service['id'] ?>" data-service-unit="<?= esc($service['service_unit_id']) ?>" <?= (!empty($ticket['service_id']) && $ticket['service_id'] == $service['id']) ? 'selected' : '' ?>><?= esc($service['name'] ?? '-') ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Prioritas <span class="text-danger">*</span></label>
        <select name="priority" class="form-select" required>
            <?php foreach (['low' => 'Rendah', 'normal' => 'Normal', 'high' => 'Tinggi', 'urgent' => 'Urgent'] as $value => $label): ?>
                <option value="<?= $value ?>" <?= ($ticket['priority'] ?? 'normal') === $value ? 'selected' : '' ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control" placeholder="Deskripsi masalah / kebutuhan"><?= esc($ticket['description'] ?? '') ?></textarea>
</div>
<div class="row">
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
<script>
(function () {
    var unitSelect = document.getElementById('service_unit_id');
    var serviceSelect = document.getElementById('service_id');
    if (!unitSelect || !serviceSelect) { return; }

    function filterServices() {
        var unit = unitSelect.value;
        var options = serviceSelect.options;
        var keepSelected = false;
        for (var i = 0; i < options.length; i++) {
            var opt = options[i];
            if (!opt.value) { continue; }
            var match = unit !== '' && opt.getAttribute('data-service-unit') === unit;
            opt.style.display = match ? '' : 'none';
            if (match && opt.selected) { keepSelected = true; }
        }
        if (!unit || !keepSelected) {
            serviceSelect.value = '';
        }
    }

    unitSelect.addEventListener('change', filterServices);

    var selected = serviceSelect.options[serviceSelect.selectedIndex];
    if (selected && selected.value) {
        var u = selected.getAttribute('data-service-unit');
        if (u) { unitSelect.value = u; }
    }
    filterServices();
})();
</script>