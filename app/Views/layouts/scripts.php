<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Bootstrap 5 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Custom JS -->
<script src="<?= base_url('assets/js/app.js') ?>"></script>

<!-- Flash Message -->
<?php if (session()->getFlashdata('success')) : ?>
    <script>
        toastr.success('<?= addslashes(session()->getFlashdata('success')) ?>');
    </script>
<?php endif ?>

<?php if (session()->getFlashdata('error')) : ?>
    <script>
        toastr.error('<?= addslashes(session()->getFlashdata('error')) ?>');
    </script>
<?php endif ?>

<?= $this->renderSection('scripts') ?>