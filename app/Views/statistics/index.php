<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="row">

<div class="col-md-3">
<div class="small-box bg-info">
<div class="inner">
<h3><?= $total ?></h3>
<p>Total Tiket</p>
</div>
<div class="icon">
<i class="fas fa-ticket-alt"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-primary">
<div class="inner">
<h3><?= $submitted ?></h3>
<p>Submitted</p>
</div>
<div class="icon">
<i class="fas fa-paper-plane"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-warning">
<div class="inner">
<h3><?= $assigned ?></h3>
<p>Assigned</p>
</div>
<div class="icon">
<i class="fas fa-share"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-success">
<div class="inner">
<h3><?= $progress ?></h3>
<p>In Progress</p>
</div>
<div class="icon">
<i class="fas fa-spinner"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-success">
<div class="inner">
<h3><?= $completed ?></h3>
<p>Completed</p>
</div>
<div class="icon">
<i class="fas fa-check-circle"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-orange">
<div class="inner">
<h3><?= $revision ?></h3>
<p>Need Revision</p>
</div>
<div class="icon">
<i class="fas fa-edit"></i>
</div>
</div>
</div>

<div class="col-md-3">
<div class="small-box bg-danger">
<div class="inner">
<h3><?= $rejected ?></h3>
<p>Rejected</p>
</div>
<div class="icon">
<i class="fas fa-times-circle"></i>
</div>
</div>
</div>

</div>

<?= $this->endSection() ?>