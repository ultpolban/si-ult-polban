<div class="card card-warning">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-share-square"></i>
            Form Disposisi
        </h3>
    </div>

    <div class="card-body">

        <div class="form-group">
            <label>Unit Tujuan <span class="text-danger">*</span></label>

            <select name="assigned_unit" class="form-control" required>
                <option value="">-- Pilih Unit Tujuan --</option>
                <option value="Akademik">Akademik</option>
                <option value="Kemahasiswaan">Kemahasiswaan</option>
                <option value="Keuangan">Keuangan</option>
                <option value="SDM">SDM</option>
                <option value="UPT Perpustakaan">UPT Perpustakaan</option>
                <option value="UPT TIK">UPT TIK</option>
            </select>
        </div>

        <div class="form-group">
            <label>Prioritas</label>

            <select name="priority" class="form-control">
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Target Penyelesaian (SLA)</label>

            <input
                type="date"
                name="sla_date"
                class="form-control"
                required>
        </div>

        <div class="form-group">
            <label>Catatan Disposisi</label>

            <textarea
                name="disposition_note"
                rows="5"
                class="form-control"
                placeholder="Masukkan instruksi atau catatan kepada unit tujuan..."></textarea>
        </div>

    </div>

    <div class="card-footer text-right">

        <a href="<?= base_url('verification/detail/'.$ticket['id']) ?>"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Kembali
        </a>

        <button type="submit" class="btn btn-warning">
            <i class="fas fa-paper-plane"></i>
            Kirim Disposisi
        </button>

    </div>

</div>
<div class="card card-info mt-3">

    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-history"></i>
            Riwayat Proses Tiket
        </h3>
    </div>

    <div class="card-body p-0">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th width="180">Tanggal</th>
                    <th>Aktivitas</th>
                    <th width="180">Petugas</th>
                </tr>
            </thead>

            <tbody>

            <?php if(!empty($logs)): ?>

                <?php foreach($logs as $log): ?>

                <tr>

                    <td>
                        <?= date('d-m-Y H:i', strtotime($log['created_at'])) ?>
                    </td>

                    <td>
                        <?= esc($log['activity']) ?>
                    </td>

                    <td>
                        <?= esc($log['user_name'] ?? '-') ?>
                    </td>

                </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <tr>
                    <td colspan="3" class="text-center">
                        Belum ada riwayat proses.
                    </td>
                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>