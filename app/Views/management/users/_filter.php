<div class="card mb-3">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama, email, nomor identitas, atau nomor HP..."
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