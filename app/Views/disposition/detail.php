<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
.info-box{
    min-height:130px;
}

.info-box-content{
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.info-box-text{
    font-size:18px;
    font-weight:bold;
}

.info-box-number{
    font-size:18px;
    word-break:break-word;
}
</style>

<!-- isi halaman -->
<div class="content-header">
    <div class="container-fluid">

        <h1 class="mb-2">
            Disposisi Tiket
        </h1>

        <p class="text-muted">
            Teruskan tiket permohonan ke Unit Tujuan yang sesuai untuk diproses lebih lanjut.
        </p>

    </div>
</div>

<div class="container-fluid">

<div class="row">

<div class="col-md-3">

<div class="small-box bg-primary">

<div class="inner">

<h5>Nomor Tiket</h5>

<h4><?= esc($ticket['ticket_number']) ?></h4>

</div>

<div class="icon">
<i class="fas fa-ticket-alt"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-success">

<div class="inner">

<h5>Status Tiket</h5>

<h4><?= esc($ticket['status']) ?></h4>

</div>

<div class="icon">
<i class="fas fa-check-circle"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-warning">

<div class="inner">

<h5>Prioritas</h5>

<h4><?= esc($ticket['priority']) ?></h4>

</div>

<div class="icon">
<i class="fas fa-exclamation-triangle"></i>
</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box bg-info">

<div class="inner">

<h5>Kategori</h5>

<h4><?= esc($ticket['service_name']) ?></h4>

</div>

<div class="icon">
<i class="fas fa-university"></i>
</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-info-circle"></i>

Informasi Tiket

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-4">

<strong>Tanggal Pengajuan</strong>

<p><?= date('d F Y', strtotime($ticket['submitted_at'])) ?></p>

</div>

<div class="col-md-4">

<strong>Tanggal Verifikasi</strong>

<p><?= date('d F Y', strtotime($ticket['verified_at'])) ?></p>

</div>

<div class="col-md-4">

<strong>Prioritas</strong>

<p><?= esc($ticket['priority']) ?></p>

</div>

</div>

<hr>

<label>Progress Tiket</label>

<div class="progress">

<div class="progress-bar bg-success"

style="width:60%">

Verified (60%)

</div>

</div>

<br>

<table class="table table-bordered">

<tr>

<th width="250">Nomor Tiket</th>

<td><?= esc($ticket['ticket_number']) ?></td>

</tr>

<tr>

<th>Nama Pemohon</th>

<td><?= esc($ticket['applicant_name']) ?></td>

</tr>

<tr>

<th>NIM</th>

<td><?= esc($ticket['nim']) ?></td>

</tr>

<tr>

<th>Layanan</th>

<td><?= esc($ticket['service_name']) ?></td>

</tr>

<tr>

<th>Judul Tiket</th>

<td><?= esc($ticket['ticket_title']) ?></td>

</tr>

<tr>

<th>Deskripsi</th>

<td><?= esc($ticket['ticket_description']) ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<span class="badge badge-success">

<?= esc($ticket['status']) ?>

</span>

</td>

</tr>

</table>

</div>

</div>

<form action="<?= base_url('disposition/process/'.$ticket['id']) ?>" method="post">

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

         <div class="form-group">

    <input type="text"
           class="form-control"
           value="<?= esc($ticket['assigned_unit'] ?? '-') ?>"
           readonly>

    <input type="hidden"
           name="assigned_unit"
           value="<?= esc($ticket['assigned_unit'] ?? '') ?>">

    <small class="text-muted">
        Unit tujuan ditentukan otomatis berdasarkan tiket.
    </small>
</div>

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
                placeholder="Masukkan instruksi kepada unit tujuan..."></textarea>

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

            Kirim Disposisi ke unit

        </button>

    </div>

</div>

</form>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-history text-primary"></i>

            Riwayat Disposisi

        </h3>

    </div>

    <div class="card-body p-0">

        <table class="table table-bordered">

            <thead class="bg-primary">

                <tr>

                    <th width="220">

                        Waktu

                    </th>

                    <th>

                        Aktivitas

                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <?= date('d M Y H:i',
                            strtotime($ticket['submitted_at'])) ?>

                    </td>

                    <td>

                        Pengajuan dibuat oleh Pemohon

                    </td>

                </tr>

                <tr>

                    <td>

                        <?= !empty($ticket['verified_at'])
                            ? date('d M Y H:i',strtotime($ticket['verified_at']))
                            : '-' ?>

                    </td>

                    <td>

                        Diverifikasi oleh Petugas ULT

                    </td>

                </tr>

                <?php if(!empty($ticket['assigned_unit'])): ?>

                <tr>

                    <td>

                        <?= date('d M Y H:i') ?>

                    </td>

                    <td>

                        Didisposisikan ke

                        <b><?= esc($ticket['assigned_unit']) ?></b>

                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>
</div>


<?= $this->endSection() ?>