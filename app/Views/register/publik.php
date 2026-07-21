<form action="<?= base_url('api/v1/register') ?>" method="post">

    <input type="hidden" name="user_type_id" value="7">

    <?= $this->include('register/partials/common') ?>

    <button class="btn btn-success">

        Daftar Sebagai Publik

    </button>

</form>