<?php
/**
 * Footer halaman auth.
 *
 * Memuat Select2 (drop-down searchable) + tema ULT supaya pilihan
 * panjang (mis. Program Studi / Kelas) mudah dicari.
 *
 * Catatan: jQuery dimuat di sini (bukan di header) supaya tidak
 * menambah berat halaman yang tidak punya drop-down.
 */
?>
            </div><!-- /.auth-right -->

        </div><!-- /.auth-card -->

    </div><!-- /.auth-container -->

</div><!-- /.auth-page -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Drop-down searchable (Select2) + tema ULT -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/select2/js/i18n/id.js') ?>"></script>
<script src="<?= base_url('assets/js/ult-select.js') ?>"></script>

<?= $this->renderSection('scripts') ?>

</body>

</html>
