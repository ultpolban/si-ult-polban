<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">
                        Detail Layanan
                    </h3>

                </div>

                <div class="card-body">

                    <h4 class="fw-bold mb-4">

                        <?= esc($service['service_name']) ?>

                    </h4>

                    <table class="table">

                        <tr>

                            <th width="220">
                                Kategori
                            </th>

                            <td>

                                <?= ($service['category_id'] == 1) ? 'Keuangan' : 'Akademik'; ?>

                            </td>

                        </tr>

                        <tr>

                            <th>Kode Layanan</th>

                            <td>

                                <?= esc($service['service_code']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>Deskripsi</th>

                            <td>

                                <?= esc($service['description']) ?>

                            </td>

                        </tr>

                        <tr>

                            <th>Estimasi Layanan</th>

                            <td>

                                <?= esc($service['sla_hours']) ?> Jam

                            </td>

                        </tr>

                        <tr>

                            <th>Status Login</th>

                            <td>

                                <?= ($service['is_login_required']) ? 'Wajib Login' : 'Tidak Wajib'; ?>

                            </td>

                        </tr>

                    </table>

                    <div class="mt-4">

                        <a href="javascript:history.back()" class="btn btn-secondary">

                            ← Kembali

                        </a>

                       <a href="<?= base_url('layanan/'.$service['id']) ?>" class="btn btn-primary w-100">
    Lihat Detail
</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>