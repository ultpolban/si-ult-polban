<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-paper-plane"></i>

            Buat Pengajuan Layanan

        </h3>

    </div>

    <div class="card-body">

        <form action="<?= site_url('service-requests/store') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Jenis Unit Layanan <span class="text-danger">*</span></label>

                    <select id="service_unit_id" class="form-control" required>

                        <option value="">-- Pilih Jenis Unit Layanan --</option>

                        <?php foreach ($serviceUnits as $unit): ?>

                            <option value="<?= $unit['id'] ?>"><?= esc($unit['name']) ?></option>

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

                            <option value="<?= $s['id'] ?>" data-service-unit="<?= esc($s['service_unit_id']) ?>"><?= esc($s['name']) ?></option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label>Prioritas</label>

                    <select name="priority" class="form-control">

                        <option value="normal">Normal</option>

                        <option value="low">Rendah</option>

                        <option value="high">Tinggi</option>

                        <option value="urgent">Segera</option>

                    </select>

                </div>

            </div>

            <div class="mb-3">

                <label>Deskripsi</label>

                <textarea name="description" rows="4"
                    class="form-control"></textarea>

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
                    filterServices();
                })();
            </script>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save"></i>

                Ajukan

            </button>

            <a href="<?= site_url('service-requests') ?>"
                class="btn btn-secondary">

                Kembali

            </a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>