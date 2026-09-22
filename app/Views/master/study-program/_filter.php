<div class="card mb-3">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari program studi..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-primary btn-block">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>