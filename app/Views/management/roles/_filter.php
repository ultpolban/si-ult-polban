<div class="card mb-3">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        class="form-control"
                        name="keyword"
                        placeholder="Cari Role..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>