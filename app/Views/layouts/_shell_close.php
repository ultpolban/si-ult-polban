<?php
/**
 * =====================================================================
 *  SHELL CLOSE — SI ULT POLBAN
 * =====================================================================
 *
 *  Menutup area konten, wrapper, dan dokumen HTML, lalu memuat
 *  seluruh dependensi JavaScript (satu-satunya daftar script).
 */
?>
            </div>
        </section>

        <footer class="ult-footer">
            <div class="container-fluid">
                <span>&copy; <?= date('Y') ?> Unit Layanan Terpadu &mdash; Politeknik Negeri Bandung.</span>
                <span class="ult-footer-role">
                    <?= esc(ult_current_role_name()) ?>
                </span>
            </div>
        </footer>

    </div>

</div>

<?= $this->include('layouts/_scripts') ?>

</body>

</html>
