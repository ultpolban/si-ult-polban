<?php
/*
 |--------------------------------------------------------------
 | Tabel daftar permintaan izin registrasi
 | Variabel: $items, $pager
 |--------------------------------------------------------------
 */
?>

<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th>Nama</th>

                    <th>Email</th>

                    <th width="180">Jenis Pemohon</th>

                    <th>Keperluan</th>

                    <th width="120">Status</th>

                    <th width="150">Tanggal</th>

                    <th width="120" class="text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if (! empty($items)) : ?>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($items as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($row['full_name'] ?? '') ?></td>

                            <td><?= esc($row['email'] ?? '') ?></td>

                            <td>

                                <?php if (! empty($row['applicant_type_name'])) : ?>

                                    <?= esc($row['applicant_type_name']) ?>

                                    <small class="text-muted d-block">
                                        <?= esc($row['applicant_type_code'] ?? '') ?>
                                    </small>

                                <?php else : ?>

                                    <span class="text-muted">-</span>

                                <?php endif; ?>

                            </td>

                            <td>
                                <?= esc(mb_strimwidth((string) ($row['purpose'] ?? ''), 0, 60, '...')) ?>
                            </td>

                            <td>

                                <?php if (($row['status'] ?? '') === 'pending') : ?>

                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>

                                <?php elseif (($row['status'] ?? '') === 'approved') : ?>

                                    <span class="badge bg-success">
                                        Approved
                                    </span>

                                <?php elseif (($row['status'] ?? '') === 'rejected') : ?>

                                    <span class="badge bg-danger">
                                        Rejected
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td><?= esc($row['created_at'] ?? '') ?></td>

                            <td class="text-center">

                                <a
                                    href="<?= site_url('registration-requests/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                    Detail

                                </a>

                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else : ?>

                    <tr>

                        <td
                            colspan="8"
                            class="text-center text-muted">

                            Belum ada permintaan registrasi.

                        </td>

                    </tr>

                <?php endif ?>

            </tbody>

        </table>

    </div>

    <div class="card-footer">

        <?= $pager->links() ?>

    </div>

</div>