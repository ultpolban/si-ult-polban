<div class="card mb-3">

    <div class="card-header">
        <strong>Data Tenaga Kependidikan</strong>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>NIP <span class="text-danger">*</span></label>

                <input
                    type="text"
                    name="nip"
                    class="form-control">

            </div>

            <div class="col-md-6 mb-3">

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

    </div>

</div>