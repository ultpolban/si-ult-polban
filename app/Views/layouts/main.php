<!DOCTYPE html>
<html lang="id">

<head>

    <?= $this->include('layouts/header') ?>

</head>

<body>

    <div class="wrapper">

        <!-- Sidebar -->
        <?= $this->include('layouts/sidebar') ?>

        <!-- Content -->
        <div class="content">

            <!-- Navbar -->
            <?= $this->include('layouts/navbar') ?>

            <!-- Main Content -->
            <main class="page fade-up">

                <?php if (session()->getFlashdata('success')) : ?>

                    <div class="alert alert-success alert-dismissible fade show mb-4">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        <?= session()->getFlashdata('success') ?>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>

                    </div>

                <?php endif; ?>

                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert alert-danger alert-dismissible fade show mb-4">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        <?= session()->getFlashdata('error') ?>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>

                    </div>

                <?php endif; ?>

                <?php if (session()->getFlashdata('warning')) : ?>

                    <div class="alert alert-warning alert-dismissible fade show mb-4">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        <?= session()->getFlashdata('warning') ?>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="alert"></button>

                    </div>

                <?php endif; ?>

                <?= $this->renderSection('content') ?>

            </main>

            <!-- Footer -->
            <footer class="footer">

                <div class="footer-left">

                    © <?= date('Y') ?> SI ULT POLBAN

                </div>

                <div class="footer-right">

                    Backend 1 • Administrator Module v1.0

                </div>

            </footer>

        </div>

    </div>

    <?= $this->include('layouts/footer') ?>

    <?= $this->renderSection('script') ?>

</body>

</html>