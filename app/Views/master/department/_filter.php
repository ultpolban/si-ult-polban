<div class="card mb-3">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari kode, nama atau singkatan..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>