<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | SI ULT POLBAN</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>

        *{
            font-family:'Poppins',sans-serif;
        }

        body{
            background:#e9edf9;
            height:100vh;
        }

        .register-card{
            border:none;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 20px 45px rgba(0,0,0,.18);
        }

        .left-side{
            background:#293582;
            color:white;
            padding:60px 40px;
        }

        .left-side h2{
            font-weight:700;
        }

        .right-side{
            background:white;
            padding:50px;
        }

        .right-side h3{
            color:#293582;
            font-weight:700;
        }

        .btn-register{
            background:#ff7f00;
            color:white;
            border:none;
        }

        .btn-register:hover{
            background:#e56f00;
            color:white;
        }

        .form-control{
            border-radius:10px;
        }

        .form-control:focus{
            border-color:#293582;
            box-shadow:0 0 0 .2rem rgba(41,53,130,.15);
        }

        .input-group-text{
            border-radius:10px 0 0 10px;
        }

        .logo-polban{
            width:110px;
            height:auto;
            margin-bottom:20px;
        }

        .left-side img{
            filter:drop-shadow(0 5px 10px rgba(0,0,0,.25));
        }

    </style>

</head>
<body>

<div class="container h-100 d-flex justify-content-center align-items-center">

    <div class="card register-card col-lg-10">

        <div class="row g-0">

            <!-- KIRI -->

            <div class="col-md-5 left-side d-flex flex-column justify-content-center">

                <div class="text-center">

                    <img
                        src="<?= base_url('/img/logo.png') ?>"
                        class="logo-polban">

                    <h2 class="mt-3">
                        SI ULT POLBAN
                    </h2>

                    <p class="mt-3">

                        Sistem Informasi<br>
                        Unit Layanan Terpadu<br>
                        Politeknik Negeri Bandung

                    </p>

                    <hr>

                    <p>

                        Buat akun untuk mengakses seluruh layanan ULT POLBAN.

                    </p>

                </div>

            </div>

            <!-- KANAN -->

            <div class="col-md-7 right-side">

                <h3>

                    Registrasi Akun

                </h3>

                <p class="text-muted mb-4">

                    Lengkapi data berikut untuk membuat akun baru.

                </p>

                <?php if(session()->getFlashdata('errors')) : ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php foreach(session()->getFlashdata('errors') as $error): ?>

                                <li><?= $error ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>
                <form action="<?= base_url('register') ?>" method="post">

<?= csrf_field(); ?>

<label class="mb-2">
Nama Lengkap
</label>

<input
type="text"
name="name"
class="form-control mb-3"
placeholder="Masukkan nama lengkap"
value="<?= old('name') ?>">

<label class="mb-2">
Email
</label>

<input
type="email"
name="email"
class="form-control mb-3"
placeholder="Masukkan email"
value="<?= old('email') ?>">

<label class="mb-2">
Nomor HP
</label>

<input
type="text"
name="phone"
class="form-control mb-3"
placeholder="08xxxxxxxxxx"
value="<?= old('phone') ?>">

<label class="mb-2">
Password
</label>

<div class="input-group mb-3">

<span class="input-group-text">

<i class="bi bi-lock"></i>

</span>

<input
type="password"
id="password"
name="password"
class="form-control"
placeholder="Masukkan password">

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword()">

<i class="bi bi-eye" id="eyeIcon"></i>

</button>

</div>

<label class="mb-2">
Konfirmasi Password
</label>

<input
type="password"
name="confirm_password"
class="form-control mb-4"
placeholder="Ulangi password">

<button
type="submit"
class="btn btn-register w-100 py-2">

<i class="bi bi-person-plus"></i>

Daftar

</button>

</form>
<div class="text-center mt-4">

Sudah punya akun?

<a
href="<?= base_url('login') ?>"
class="text-decoration-none fw-semibold">

Login di sini

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
</html>