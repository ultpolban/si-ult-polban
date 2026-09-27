<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-3">

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Informasi Role

                </h3>

            </div>

            <div class="card-body">

                <table class="table table-sm">

                    <tr>

                        <th width="100">

                            Kode

                        </th>

                        <td>

                            <?= esc($role['code']) ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Nama

                        </th>

                        <td>

                            <?= esc($role['name']) ?>

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

                        <td>

                            <?php if ($role['is_active']) : ?>

                                <span class="badge badge-success">

                                    Aktif

                                </span>

                            <?php else : ?>

                                <span class="badge badge-danger">

                                    Nonaktif

                                </span>

                            <?php endif ?>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-9">

        <form
            method="post"
            action="<?= site_url('roles/permissions/' . $role['id']) ?>">

            <?= csrf_field() ?>

            <div class="card">

                <div class="card-header">

                    <div class="d-flex justify-content-between align-items-center">

                        <h3 class="card-title">

                            Hak Akses

                        </h3>

                        <div>

                            <div class="custom-control custom-checkbox">

                                <input
                                    type="checkbox"
                                    id="checkAll"
                                    class="custom-control-input">

                                <label
                                    for="checkAll"
                                    class="custom-control-label">

                                    Pilih Semua

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <?= $this->include('management/role-permissions/_permission_group') ?>

                </div>

                <div class="card-footer text-right">

                    <a
                        href="<?= site_url('roles') ?>"
                        class="btn btn-secondary">

                        Kembali

                    </a>

                    <button
                        class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Simpan Permission

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<?= $this->include('management/role-permissions/_script') ?>

<?= $this->endSection() ?>