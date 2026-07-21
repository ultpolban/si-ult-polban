<form action="<?= base_url('api/v1/register') ?>" method="post">

    <input type="hidden" name="user_type_id" value="5">

    <div class="row">

        <div class="col-md-6 mb-3">

            <label>Nama Mahasiswa</label>

            <input class="form-control">

        </div>

        <div class="col-md-6 mb-3">

            <label>NIM Mahasiswa</label>

            <input class="form-control">

        </div>

    </div>

    <hr>

    <?= $this->include('register/partials/common') ?>

    <button class="btn btn-success">

        Daftar Sebagai Orang Tua

    </button>

</form>