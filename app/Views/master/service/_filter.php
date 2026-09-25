<div class="card card-premium mb-4">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control bg-light border-0 py-2"
                        placeholder="Cari layanan..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
