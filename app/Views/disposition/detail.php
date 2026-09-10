<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-share-square mr-2"></i>
                Disposisi Tiket
            </h3>

        </div>

        <div class="card-body">

            <!-- FLASH ERROR -->
            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle mr-2"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                </div>

            <?php endif; ?>


            <!-- DETAIL TIKET -->
            <div class="card card-outline card-primary">

                <div class="card-header">

                    <h3 class="card-title">
                        Informasi Tiket
                    </h3>

                </div>

                <div class="card-body">

                    <div class="row">

                        <!-- NO TIKET -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>No. Tiket</label>

                                <input type="text"
                                       class="form-control"
                                       value="<?= esc(
                                           $ticket['ticket_number'] ?? '-'
                                       ) ?>"
                                       readonly>

                            </div>

                        </div>


                        <!-- STATUS -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Status</label>

                                <div>

                                    <span class="badge badge-success"
                                          style="font-size: 14px;">

                                        VERIFIED

                                    </span>

                                </div>

                            </div>

                        </div>


                        <!-- JUDUL -->
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Judul Tiket</label>

                                <input type="text"
                                       class="form-control"
                                       value="<?= esc(
                                           $ticket['title'] ?? '-'
                                       ) ?>"
                                       readonly>

                            </div>

                        </div>


                        <!-- LAYANAN -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Layanan</label>

                                <input type="text"
                                       class="form-control"
                                       value="<?= esc(
                                           $ticket['service_display_name']
                                           ?? '-'
                                       ) ?>"
                                       readonly>

                            </div>

                        </div>


                        <!-- PRIORITY -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Prioritas</label>

                                <input type="text"
                                       class="form-control"
                                       value="<?= esc(
                                           strtoupper(
                                               $ticket['priority'] ?? 'normal'
                                           )
                                       ) ?>"
                                       readonly>

                            </div>

                        </div>


                        <!-- DESKRIPSI -->
                        <div class="col-md-12">

                            <div class="form-group">

                                <label>Deskripsi</label>

                                <textarea class="form-control"
                                          rows="5"
                                          readonly><?= esc(
                                              $ticket['description'] ?? '-'
                                          ) ?></textarea>

                            </div>

                        </div>


                        <!-- VERIFIED AT -->
                        <div class="col-md-6">

                            <div class="form-group">

                                <label>Waktu Verifikasi</label>

                                <input type="text"
                                       class="form-control"
                                       value="<?=
                                           !empty($ticket['verified_at'])
                                               ? date(
                                                   'd-m-Y H:i:s',
                                                   strtotime(
                                                       $ticket['verified_at']
                                                   )
                                               )
                                               : '-'
                                       ?>"
                                       readonly>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- FORM DISPOSISI -->
            <div class="card card-outline card-success">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-building mr-2"></i>

                        Tentukan Unit Tujuan

                    </h3>

                </div>


                <div class="card-body">

                    <form method="post"
                          action="<?= base_url(
                              'disposition/process/' .
                              $ticket['id']
                          ) ?>">

                        <?= csrf_field() ?>


                        <div class="form-group">

                            <label for="assigned_to">

                                Unit Tujuan

                                <span class="text-danger">*</span>

                            </label>


                            <select name="assigned_to"
                                    id="assigned_to"
                                    class="form-control"
                                    required>

                                <option value="">

                                    -- Pilih Unit Tujuan --

                                </option>


                                <?php if (!empty($units)): ?>

                                    <?php foreach ($units as $unit): ?>

                                        <option value="<?= esc(
                                            $unit['id']
                                        ) ?>">

                                            <?= esc(
                                                $unit['name']
                                            ) ?>

                                            <?php if (!empty($unit['code'])): ?>

                                                -
                                                <?= esc(
                                                    $unit['code']
                                                ) ?>

                                            <?php endif; ?>

                                        </option>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <option value=""
                                            disabled>

                                        Tidak ada unit layanan aktif.

                                    </option>

                                <?php endif; ?>

                            </select>


                            <small class="form-text text-muted">

                                Pilih unit yang akan menerima dan
                                memproses tiket ini.

                            </small>

                        </div>


                        <!-- BUTTON -->

                        <div class="d-flex justify-content-between">

                            <a href="<?= base_url(
                                'disposition'
                            ) ?>"
                               class="btn btn-secondary">

                                <i class="fas fa-arrow-left mr-1"></i>

                                Kembali

                            </a>


                            <button type="submit"
                                    class="btn btn-success"
                                    onclick="return confirm(
                                        'Apakah tiket ini akan didisposisikan ke unit yang dipilih?'
                                    );">

                                <i class="fas fa-paper-plane mr-1"></i>

                                Disposisikan

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>