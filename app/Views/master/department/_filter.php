<div class="card card-premium mb-4">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control bg-light border-0 py-2"
                        placeholder="Cari kode, nama atau singkatan..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary px-4 shadow-sm">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>
