<form action="<?= base_url('api/v1/register') ?>" method="post">

    <input type="hidden" name="user_type_id" value="6">

    <div class="row">

        <div class="col-md-6 mb-3">

            <label>Nama Instansi</label>

            <input class="form-control">

        </div>

        <div class="col-md-6 mb-3">

            <label>Jabatan</label>

            <input class="form-control">

        </div>

    </div>

    <hr>

    <?= $this->include('register/partials/common') ?>

    <button class="btn btn-success">

        Daftar Sebagai Mitra

    </button>

</form>