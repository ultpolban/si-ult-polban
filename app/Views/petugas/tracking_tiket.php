<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <h2 class="font-weight-bold mb-4">
        Tracking Status Tiket
    </h2>

    <div class="card shadow-sm border-0">

        <div class="card-header text-white"
             style="background:#1a237e;">
            <h5 class="mb-0">
                <i class="fas fa-search mr-2"></i>
                Tracking Status Tiket
            </h5>
        </div>

        <div class="card-body">

            <form>

                <div class="form-group">
                    <label class="font-weight-bold">
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Contoh : ULT-202607270001">
                </div>

                <button
                    class="btn text-white"
                    style="background:#1a237e;">

                    <i class="fas fa-search mr-2"></i>
                    Cari Tiket

                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>