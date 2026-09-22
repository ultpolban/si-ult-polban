<div class="card mb-3">

    <div class="card-body">

        <form method="get">

            <div class="row g-2">

                <div class="col-md-5">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama, email, atau keperluan..."
                        value="<?= esc($keyword ?? '') ?>">

                </div>

                <div class="col-md-3">

                    <select name="status" class="form-select">

                        <option value="">-- Semua Status --</option>

                        <option value="pending" <?= ($status ?? '') === 'pending' ? 'selected' : '' ?>>
                            Pending
                        </option>

                        <option value="approved" <?= ($status ?? '') === 'approved' ? 'selected' : '' ?>>
                            Approved
                        </option>

                        <option value="rejected" <?= ($status ?? '') === 'rejected' ? 'selected' : '' ?>>
                            Rejected
                        </option>

                    </select>

                </div>

                <div class="col-md-4">

                    <button class="btn btn-primary">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                    <a
                        href="<?= site_url('registration-requests') ?>"
                        class="btn btn-secondary">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

</div>
