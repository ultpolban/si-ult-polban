<?= $this->include('layouts/header') ?>

<style>
    body {
        background: linear-gradient(135deg, #0d6efd, #4f8dfd);
        min-height: 100vh;
    }

    .login-card {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .15);
    }

    .left-side {
        background: #0d6efd;
        color: white;
        padding: 60px 45px;
    }

    .left-side h1 {
        font-weight: 700;
    }

    .left-side p {
        opacity: .9;
        font-size: 17px;
        line-height: 28px;
    }

    .right-side {
        background: white;
        padding: 55px;
    }

    .form-control {
        height: 50px;
        border-radius: 12px;
    }

    .btn-login {
        height: 50px;
        border-radius: 12px;
        font-weight: 600;
    }

    @media(max-width:768px) {

        .left-side {
            display: none;
        }

        .right-side {
            padding: 35px;
        }

    }
</style>

<div class="container">

    <div class="row justify-content-center align-items-center"
        style="min-height:100vh;">

        <div class="col-lg-10">

            <div class="card login-card">

                <div class="row g-0">

                    <div class="col-lg-5 left-side d-flex flex-column justify-content-center">

                        <h1>SI ULT POLBAN</h1>

                        <hr class="border-light">

                        <h4>Unit Layanan Terpadu</h4>

                        <p class="mt-4">

                            Selamat datang di Sistem Informasi
                            Unit Layanan Terpadu
                            Politeknik Negeri Bandung.

                        </p>

                        <p>

                            Silakan login menggunakan akun yang telah
                            terdaftar untuk mengakses layanan sistem.

                        </p>

                    </div>

                    <div class="col-lg-7 right-side">

                        <h2 class="fw-bold">

                            Login

                        </h2>

                        <p class="text-muted mb-4">

                            Masukkan email dan password Anda.

                        </p>

                        <?php if (session()->getFlashdata('error')) : ?>

                            <div class="alert alert-danger">

                                <?= session()->getFlashdata('error') ?>

                            </div>

                        <?php endif; ?>

                        <form action="<?= base_url('login') ?>" method="post">

                            <?= csrf_field() ?>

                            <div class="mb-3">

                                <label class="form-label">

                                    Email

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Masukkan email"
                                    required>

                            </div>

                            <div class="mb-4">

                                <label class="form-label">

                                    Password

                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required>

                            </div>

                            <button class="btn btn-primary btn-login w-100">

                                Login

                            </button>

                        </form>

                        <div class="text-center mt-4">

                            Belum memiliki akun?

                            <a href="<?= base_url('register') ?>">

                                Daftar Sekarang

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layouts/footer') ?>