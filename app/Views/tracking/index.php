<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

.stepper{
    display:flex;
    justify-content:space-between;
    margin:30px 0;
    position:relative;
}

.stepper::before{
    content:'';
    position:absolute;
    top:20px;
    left:10%;
    width:80%;
    height:5px;
    background:#dee2e6;
    z-index:0;
}

.step{
    width:20%;
    text-align:center;
    position:relative;
    z-index:2;
}

.circle{
    width:45px;
    height:45px;
    border-radius:50%;
    background:#adb5bd;
    color:#fff;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:auto;
    font-weight:bold;
    font-size:18px;
}

.circle.active{
    background:#28a745;
}

.timeline{
    position:relative;
    margin-left:20px;
}

.timeline::before{
    content:'';
    position:absolute;
    left:15px;
    top:0;
    bottom:0;
    width:3px;
    background:#007bff;
}

.time-item{
    position:relative;
    margin-bottom:25px;
    padding-left:45px;
}

.time-icon{
    position:absolute;
    left:0;
    width:30px;
    height:30px;
    border-radius:50%;
    background:#28a745;
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
}

.time-content{
    background:#f8f9fa;
    border-left:4px solid #007bff;
    padding:15px;
    border-radius:8px;
}

</style>

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Tracking Status Tiket

</h3>

</div>

<div class="card-body">

<form action="<?= base_url('tracking/search') ?>" method="post">

<?= csrf_field() ?>

<div class="form-group">

<label>Nomor Tiket</label>

<input
type="text"
name="ticket_number"
class="form-control"
placeholder="Contoh : ULT-202607270001"
required>

</div>

<button class="btn btn-primary">

<i class="fas fa-search"></i>

Cari Tiket

</button>

</form>

<?php if(isset($error)): ?>

<div class="alert alert-danger mt-3">

<?= $error ?>

</div>

<?php endif; ?>

<?php if(isset($ticket) && $ticket): ?>

<?php

$dibuat = strtotime($ticket['submitted_at']);
$sekarang = time();

if($ticket['status'] == 'Completed' && !empty($ticket['completed_at'])){
    $akhir = strtotime($ticket['completed_at']);
}else{
    $akhir = $sekarang;
}

$lama = floor(($akhir - $dibuat) / 86400);

$estimasi = 3;

$sisa = max($estimasi - $lama, 0);

?>

<hr>

<?php

$steps = [
    'Submitted',
    'Verified',
    'Assigned',
    'In Progress',
    'Completed'
];

$current = array_search($ticket['status'], $steps);

if($current === false){
    $current = 0;
}

?>

<div class="stepper">

<?php foreach($steps as $i=>$step): ?>

<div class="step">

<div class="circle <?= $i <= $current ? 'active' : '' ?>">

<?= $i < $current ? '✓' : $i+1 ?>

</div>

<p class="mt-2">

<?= $step ?>

</p>

</div>

<?php endforeach; ?>

</div>

<?php

$progress=20;
$progressColor="bg-warning";
$info="";

switch($ticket['status']){

case 'Submitted':
$progress=20;
$progressColor='bg-warning';
$info='Menunggu verifikasi oleh Petugas ULT.';
break;

case 'Verified':
$progress=40;
$progressColor='bg-success';
$info='Permohonan telah diverifikasi.';
break;

case 'Assigned':
$progress=60;
$progressColor='bg-info';
$info='Permohonan diteruskan ke unit tujuan.';
break;

case 'In Progress':
$progress=80;
$progressColor='bg-primary';
$info='Permohonan sedang diproses.';
break;

case 'Completed':
$progress=100;
$progressColor='bg-success';
$info='Permohonan selesai.';
break;

case 'Need Revision':
$progress=30;
$progressColor='bg-dark';
$info='Menunggu revisi dari pemohon.';
break;

case 'Rejected':
$progress=0;
$progressColor='bg-danger';
$info='Permohonan ditolak.';
break;

}

$dibuat=strtotime($ticket['submitted_at']);
$sekarang=time();

if($ticket['status']=='Completed' && !empty($ticket['completed_at'])){
    $akhir=strtotime($ticket['completed_at']);
}else{
    $akhir=$sekarang;
}

$lama = floor(($akhir - $dibuat) / 86400);

$estimasi = 3;

$sisa = max($estimasi - $lama, 0);

?>
<div class="row mb-4">

    <div class="col-md-4">

        <div class="small-box bg-info">

            <div class="inner">

                <h4><?= date('l, d F Y', $dibuat) ?></h4>

                <p>Tanggal Pengajuan</p>

            </div>

            <div class="icon">

                <i class="fas fa-calendar-plus"></i>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="small-box bg-warning">

            <div class="inner">

                <h2><?= $lama ?></h2>

                <p>Hari Diproses</p>

            </div>

            <div class="icon">

                <i class="fas fa-hourglass-half"></i>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="small-box bg-success">

            <div class="inner">

                <h2><?= $estimasi ?></h2>

                <p>Estimasi Hari</p>

            </div>

            <div class="icon">

                <i class="fas fa-clock"></i>

            </div>

        </div>

    </div>

</div>

<div class="card mb-4">

    <div class="card-header bg-light">

        <strong>Progress Penyelesaian Tiket</strong>

    </div>

    <div class="card-body">

        <div class="progress" style="height:30px;">

            <div
                class="progress-bar <?= $progressColor ?>"
                role="progressbar"
                style="width:<?= $progress ?>%">

                <?= $progress ?>%

            </div>

        </div>

        <div class="alert alert-info mt-3 mb-0">

            <i class="fas fa-info-circle"></i>

            <?= $info ?>

            <hr>

            <?php if($ticket['status']=="Completed"): ?>

                <strong>

                    Tiket selesai dalam

                    <?= $lama ?> hari.

                </strong>

            <?php else: ?>

                <strong>

                    Sudah diproses selama

                    <?= $lama ?> hari.

                </strong>

                <br>

                Estimasi selesai sekitar

                <strong><?= $sisa ?> hari lagi.</strong>

            <?php endif; ?>

        </div>

    </div>

</div>

<?php

$badge="secondary";

switch($ticket['status']){

    case 'Submitted':
        $badge='warning';
        break;

    case 'Verified':
        $badge='success';
        break;

    case 'Assigned':
        $badge='info';
        break;

    case 'In Progress':
        $badge='primary';
        break;

    case 'Completed':
        $badge='success';
        break;

    case 'Need Revision':
        $badge='dark';
        break;

    case 'Rejected':
        $badge='danger';
        break;

}

?>

<table class="table table-bordered">

<tr>

<th width="240">Nomor Tiket</th>

<td><?= esc($ticket['ticket_number']) ?></td>

</tr>

<tr>

<th>Nama Pemohon</th>

<td><?= esc($ticket['applicant_name']) ?></td>

</tr>

<tr>

<th>Jenis Layanan</th>

<td><?= esc($ticket['service_name']) ?></td>

</tr>

<tr>

<th>Judul Tiket</th>

<td><?= esc($ticket['ticket_title']) ?></td>

</tr>

<tr>

<th>Prioritas</th>

<td><?= esc($ticket['priority']) ?></td>

</tr>

<tr>

<th>Tanggal Pengajuan</th>

<td><?= date('l, d F Y H:i',strtotime($ticket['submitted_at'])) ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<button
class="btn btn-<?= $badge ?>"
data-toggle="modal"
data-target="#statusModal">

<?= esc($ticket['status']) ?>

</button>

</td>

</tr>

<tr>

<th>Petugas Verifikasi</th>

<td><?= $ticket['verified_by'] ?: '-' ?></td>

</tr>

<tr>

<th>Unit Tujuan</th>

<td><?= $ticket['assigned_unit'] ?: '-' ?></td>

</tr>

<tr>

<th>Catatan Petugas</th>

<td><?= $ticket['verification_note'] ?: '-' ?></td>

</tr>

<tr>

<th>Terakhir Diperbarui</th>

<td>

<?= !empty($ticket['updated_at'])
? date('l, d F Y H:i:s',strtotime($ticket['updated_at']))
: '-' ?>

</td>

</tr>

</table>

<div class="card mt-4">

    <div class="card-header bg-info">

        <h5 class="mb-0">

            <i class="fas fa-history"></i>

            Timeline Proses Tiket

        </h5>

    </div>

    <div class="card-body">

        <?php if(empty($logs)): ?>

            <div class="text-center text-muted">

                <i class="fas fa-info-circle"></i>

                Belum ada riwayat proses tiket.

            </div>

        <?php else: ?>

            <div class="timeline">

                <?php foreach($logs as $log): ?>

                    <div class="time-item">

                        <div class="time-icon">

                            <i class="fas fa-check"></i>

                        </div>

                        <div class="time-content">

                            <strong>

                                <?= esc($log['activity']) ?>

                            </strong>

                            <br>

                            <small class="text-muted">

                                <?= date('l, d F Y H:i:s',strtotime($log['created_at'])) ?>

                            </small>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<!-- Modal Detail Status -->

<div class="modal fade" id="statusModal">

    ...

</div>

<?php endif; ?>

</div>
</div>

<?php if(isset($ticket) && $ticket): ?>

<div class="modal fade" id="statusModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header bg-primary">

<h5 class="modal-title">

Detail Status Tiket

</h5>

<button class="close" data-dismiss="modal">

<span>&times;</span>

</button>

</div>

<div class="modal-body">

<?php

$badge = "secondary";

switch($ticket['status'] ?? ''){

    case 'Submitted':
        $badge = "warning";
        break;

    case 'Verified':
        $badge = "success";
        break;

    case 'Assigned':
        $badge = "info";
        break;

    case 'In Progress':
        $badge = "primary";
        break;

    case 'Completed':
        $badge = "success";
        break;

    case 'Need Revision':
        $badge = "dark";
        break;

    case 'Rejected':
        $badge = "danger";
        break;

}
?>



<?php

$pesan='';

switch($ticket['status'] ?? ''){

case 'Submitted':
    $pesan='Permohonan berhasil dibuat dan sedang menunggu verifikasi oleh Petugas ULT. Estimasi proses 1 hari kerja.';
    break;

case 'Verified':
    $pesan='Permohonan telah diverifikasi. Selanjutnya tiket akan diteruskan ke unit terkait untuk diproses.';
    break;

case 'Assigned':
    $pesan='Tiket telah didisposisikan ke unit tujuan. Unit terkait akan mulai menangani permohonan.';
    break;

case 'In Progress':
    $pesan='Permohonan sedang dikerjakan oleh unit. Mohon menunggu hingga proses selesai.';
    break;

case 'Completed':
    $pesan='Permohonan telah selesai diproses.';
    break;

case 'Need Revision':
    $pesan='Data atau dokumen belum lengkap. Silakan lakukan revisi sesuai catatan petugas.';
    break;

case 'Rejected':
    $pesan='Permohonan ditolak karena tidak memenuhi persyaratan.';
    break;
}

?>

<?php

$pesan='';

switch($ticket['status'] ?? ''){

case 'Submitted':

$pesan='Permohonan berhasil dibuat dan sedang menunggu verifikasi oleh Petugas ULT. Estimasi proses 1 hari kerja.';

break;

case 'Verified':

$pesan='Permohonan telah diverifikasi. Selanjutnya tiket akan diteruskan ke unit terkait untuk diproses.';

break;

case 'Assigned':

$pesan='Tiket telah didisposisikan ke unit tujuan. Unit terkait akan mulai menangani permohonan.';

break;

case 'In Progress':

$pesan='Permohonan sedang dikerjakan oleh unit. Mohon menunggu hingga proses selesai.';

break;

case 'Completed':

$pesan='Permohonan telah selesai diproses. Silakan melihat hasil atau menghubungi Petugas ULT apabila masih ada kendala.';

break;

case 'Need Revision':

$pesan='Data atau dokumen belum lengkap. Silakan lakukan revisi sesuai catatan petugas.';

break;

case 'Rejected':

$pesan='Permohonan ditolak karena tidak memenuhi persyaratan yang ditentukan.';

break;

}

?>

<div class="text-center">

<h3>

<span class="badge badge-<?= $badge ?>">

<?= esc($ticket['status']) ?>

</span>

</h3>

</div>

<hr>

<p>

<?= $pesan ?>

</p>

<table class="table table-bordered">

<tr>

<th width="170">

Nomor Tiket

</th>

<td>

<?= esc($ticket['ticket_number']) ?>

</td>

</tr>

<tr>

<th>

Tanggal Dibuat

</th>

<td>

<?= date('l, d F Y H:i',strtotime($ticket['submitted_at'])) ?>

</td>

</tr>

<tr>

<th>

Lama Diproses

</th>

<td>

<?= $lama ?> Hari

</td>

</tr>

<tr>

<th>

Estimasi

</th>

<td>

<?php if($ticket['status']=="Completed"): ?>

Selesai

<?php else: ?>

<?= $sisa ?> Hari Lagi

<?php endif; ?>

</td>

</tr>

<tr>

<th>

Progress

</th>

<td>

<?= $progress ?>%

</td>

</tr>

</table>

</div>

<div class="modal-footer">

<button
class="btn btn-secondary"
data-dismiss="modal">

Tutup

</button>

</div>

</div>

</div>

</div>
<?php endif; ?>

<?= $this->endSection() ?>