<form action="<?= base_url('api/v1/register') ?>" method="post">

    <input type="hidden" name="user_type_id" value="3">

    <div class="row">

        <div class="col-md-6 mb-3">

            <label>NIP</label>

            <input class="form-control" name="nip">

        </div>

        <div class="col-md-6 mb-3">

            <label>Unit Kerja</label>

            <select class="form-select" name="work_unit_id">

                <option>Pilih Unit Kerja</option>

                <?php foreach ($workUnits as $unit): ?>

                    <option value="<?= $unit['id'] ?>">

                        <?= $unit['unit_name'] ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>

    <hr>

    <?= $this->include('register/partials/common') ?>

    <button class="btn btn-success">

        Daftar Sebagai Tendik

    </button>

</form>