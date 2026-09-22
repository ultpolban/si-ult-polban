<div class="card">

    <div class="card-body table-responsive p-0">

        <table class="table table-bordered table-hover">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th width="180">Kategori</th>

                    <th>Pertanyaan</th>

                    <th width="100">Urutan</th>

                    <th width="120">Status</th>

                    <th width="180" class="text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (!empty($faqs)) : ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($faqs as $row) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>

                                <?= !empty($row['category'])
                                    ? esc($row['category'])
                                    : '<span class="text-muted">-</span>' ?>

                            </td>

                            <td>

                                <?= esc($row['question']) ?>

                            </td>

                            <td>

                                <?= esc($row['sort_order']) ?>

                            </td>

                            <td>

                                <?php if ($row['is_active']) : ?>

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-danger">

                                        Nonaktif

                                    </span>

                                <?php endif ?>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= site_url('faqs/show/' . $row['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a
                                    href="<?= site_url('faqs/edit/' . $row['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm btn-delete"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= esc($row['question']) ?>">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </td>

                        </tr>

                    <?php endforeach ?>

                <?php else : ?>

                    <tr>

                        <td
                            colspan="6"
                            class="text-center text-muted">

                            Belum ada data FAQ.

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