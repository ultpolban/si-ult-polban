<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SI ULT POLBAN</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #005BAC, #0d6efd);
            height: 100vh;
        }

        .login-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .25);
        }

        .left-side {
            background: #005BAC;
            color: white;
            padding: 60px 40px;
        }

        .left-side h2 {
            font-weight: 700;
        }

        .right-side {
            padding: 50px;
            background: white;
        }

        .btn-login {
            background: #005BAC;
            color: white;
        }

        .btn-login:hover {
            background: #004a90;
            color: white;
        }

        .form-control {
            border-radius: 10px;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
        }

       .logo-polban{
    width:110px;
    height:auto;
    margin-bottom:20px;
}

.left-side img{
    filter: drop-shadow(0 5px 10px rgba(0,0,0,.25));
}
    </style>

</head>

<body>

<div class="container h-100 d-flex justify-content-center align-items-center">

    <div class="card login-card col-lg-9">

        <div class="row g-0">

            <!-- KIRI -->

            <div class="col-md-5 left-side d-flex flex-column justify-content-center">

                <div class="text-center">

                    <img src="<?= base_url('/img/logo.png') ?>"
     alt="Logo POLBAN"
     class="logo-polban">

                    <h2 class="mt-3">

                        Unit Layanan Terpadu

                    </h2>

                    <p class="mt-3">

                        Sistem Informasi
                        <br>
                        Politeknik Negeri Bandung

                    </p>

                    <hr>

                    <p>


                    </p>

                </div>

            </div>

            <!-- KANAN -->

            <div class="col-md-7 right-side">

                <h3 class="fw-bold text-primary">

                    Selamat Datang

                </h3>

                <p class="text-muted mb-4">

                    Silakan login untuk melanjutkan.

                </p>

                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert alert-danger">

                        <?= session()->getFlashdata('error') ?>

                    </div>

                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">

                    <?= csrf_field(); ?>

                    <label class="mb-2">Email</label>

                    <div class="input-group mb-3">

                        <span class="input-group-text">

                            <i class="bi bi-envelope"></i>

                        </span>

                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            placeholder="Masukkan email"
                            required>

                    </div>

                    <label class="mb-2">Password</label>

                    <div class="input-group mb-4">

                        <span class="input-group-text">

                            <i class="bi bi-lock"></i>

                        </span>

                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            required>

                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            onclick="togglePassword()">

                            <i class="bi bi-eye" id="eyeIcon"></i>

                        </button>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-login w-100 py-2">

                        <i class="bi bi-box-arrow-in-right"></i>

                        Login

                    </button>

                </form>

                <div class="text-center mt-4">

                    Belum punya akun?

                    <a href="<?= base_url('register') ?>" class="text-decoration-none">

                        Daftar di sini

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    const password=document.getElementById("password");

    const eye=document.getElementById("eyeIcon");

    if(password.type==="password"){

        password.type="text";

        eye.classList.remove("bi-eye");

        eye.classList.add("bi-eye-slash");

    }else{

        password.type="password";

        eye.classList.remove("bi-eye-slash");

        eye.classList.add("bi-eye");

    }

}

</script>

</body>

</html>