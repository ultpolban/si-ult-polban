<div class="card mb-3">

    <div class="card-header">
        <strong>Data Unit Tujuan</strong>
    </div>

    <div class="card-body">

        <label>Unit Kerja <span class="text-danger">*</span></label>

        <select
            name="work_unit_id"
            class="form-select">

            <option value="">Pilih Unit Kerja</option>

            <?php foreach ($workUnits as $unit): ?>

                <option value="<?= $unit['id']; ?>">

                    <?= esc($unit['unit_name']); ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>

</div>