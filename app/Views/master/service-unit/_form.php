<?= csrf_field() ?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Kode</label>
                <input type="text" name="code" class="form-control"
                    value="<?= old('code', $serviceUnit['code'] ?? '') ?>">
            </div>

            <div class="col-md-8 mb-3">
                <label>Nama Unit Layanan</label>
                <input type="text" name="name" class="form-control"
                    value="<?= old('name', $serviceUnit['name'] ?? '') ?>">
            </div>

        </div>

        <div class="mb-3">

            <label>Deskripsi</label>

            <textarea
                name="description"
                rows="3"
                class="form-control"><?= old('description', $serviceUnit['description'] ?? '') ?></textarea>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= old('email', $serviceUnit['email'] ?? '') ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label>Telepon</label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="<?= old('phone', $serviceUnit['phone'] ?? '') ?>">

            </div>

        </div>

        <div class="mb-3">

            <label>Lokasi</label>

            <input
                type="text"
                name="location"
                class="form-control"
                value="<?= old('location', $serviceUnit['location'] ?? '') ?>">

        </div>

        <div class="row">

            <div class="col-md-6">

                <label>Website</label>

                <input
                    type="text"
                    name="website"
                    class="form-control"
                    value="<?= old('website', $serviceUnit['website'] ?? '') ?>">

            </div>

            <div class="col-md-6">

                <label>Logo</label>

                <input
                    type="text"
                    name="logo"
                    class="form-control"
                    value="<?= old('logo', $serviceUnit['logo'] ?? '') ?>">

            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-3">

                <label>Urutan</label>

                <input
                    type="number"
                    name="sort_order"
                    class="form-control"
                    value="<?= old('sort_order', $serviceUnit['sort_order'] ?? 0) ?>">

            </div>

            <div class="col-md-3">

                <label>Status</label>

                <select name="is_active" class="form-control">

                    <option value="1">Aktif</option>

                    <option value="0">Nonaktif</option>

                </select>

            </div>

        </div>

    </div>

    <div class="card-footer">

        <button class="btn btn-primary">

            <i class="fas fa-save"></i>

            Simpan

        </button>

        <a href="<?= site_url('master/service-units') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>