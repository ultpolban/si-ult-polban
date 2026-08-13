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

            <?php
            $selectedServiceId = $request['service_id'] ?? '';
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

                    <label>Jenis Unit Layanan <span class="text-danger">*</span></label>

                    <select id="service_unit_id" class="form-control" required>

                        <option value="">-- Pilih Jenis Unit Layanan --</option>

                        <?php foreach ($serviceUnits as $unit): ?>

                            <option value="<?= $unit['id'] ?>" <?= ((string) $unit['id'] === $selectedUnitId) ? 'selected' : '' ?>><?= esc($unit['name']) ?></option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Layanan <span class="text-danger">*</span></label>

                    <select name="service_id" id="service_id" class="form-control" required>

                        <option value="">-- Pilih Layanan --</option>

                        <?php foreach ($services as $s): ?>

                            <option value="<?= $s['id'] ?>" data-service-unit="<?= esc($s['service_unit_id']) ?>"
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

                <label>Deskripsi</label>

                <textarea name="description" rows="4"
                    class="form-control"><?= esc($request['description'] ?? '') ?></textarea>

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