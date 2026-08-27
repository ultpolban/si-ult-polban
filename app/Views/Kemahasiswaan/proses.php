<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title><?= $title ?? 'Proses Tiket Kemahasiswaan' ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        body {
            background: #f8f9fa;
        }

        .card {
            border-radius: 12px;
        }

        .btn-primary {
            background: #293582;
            border: none;
        }

        .btn-primary:hover {
            background: #ff7f00;
        }

    </style>

</head>


<body>


<div class="container mt-4">


    <h3 class="mb-4">
        Proses Tiket Layanan Kemahasiswaan
    </h3>


    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= session()->getFlashdata('error') ?>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif; ?>


    <div class="card shadow">

        <div class="card-body">


            <form
                action="<?= base_url('kemahasiswaan/updateProses/' . $tiket['id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field(); ?>


                <!-- NOMOR TIKET -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['ticket_number']
                            ?? $tiket['no_tiket']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- PEMOHON -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nama Pemohon
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['pemohon']
                            ?? $tiket['student_name']
                            ?? $tiket['name']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- UNIT LAYANAN -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Unit Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['nama_unit']
                            ?? $tiket['unit_name']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- KATEGORI -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Kategori Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['nama_kategori']
                            ?? $tiket['category_name']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- JENIS LAYANAN -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Jenis Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['nama_layanan']
                            ?? $tiket['service_name']
                            ?? $tiket['layanan']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- JUDUL -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Judul Pengajuan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['title']
                            ?? $tiket['judul']
                            ?? '-'
                        ) ?>"
                        readonly>

                </div>


                <!-- DESKRIPSI -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Deskripsi Pengajuan
                    </label>

                    <textarea
                        class="form-control"
                        rows="4"
                        readonly><?= esc(
                            $tiket['description']
                            ?? $tiket['deskripsi']
                            ?? '-'
                        ) ?></textarea>

                </div>


                <hr>


                <!-- STATUS -->

                <div class="mb-3">

                    <label
                        for="status"
                        class="form-label fw-bold">

                        Status Tiket

                    </label>


                    <select
                        name="status"
                        id="status"
                        class="form-select"
                        required>


                        <option
                            value="Menunggu"
                            <?= strtolower(
                                trim(
                                    (string) ($tiket['status'] ?? '')
                                )
                            ) === 'menunggu'
                                ? 'selected'
                                : '' ?>>

                            Menunggu

                        </option>


                        <option
                            value="Diproses"
                            <?= strtolower(
                                trim(
                                    (string) ($tiket['status'] ?? '')
                                )
                            ) === 'diproses'
                                ? 'selected'
                                : '' ?>>

                            Diproses

                        </option>


                        <option
                            value="Selesai"
                            <?= strtolower(
                                trim(
                                    (string) ($tiket['status'] ?? '')
                                )
                            ) === 'selesai'
                                ? 'selected'
                                : '' ?>>

                            Selesai

                        </option>


                    </select>

                </div>


                <!-- CATATAN -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Catatan Unit Kemahasiswaan
                    </label>


                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"><?= esc(
                            $tiket['admin_note']
                            ?? $tiket['catatan']
                            ?? ''
                        ) ?></textarea>

                </div>


                <!-- UPLOAD DOKUMEN -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Upload Dokumen Hasil
                    </label>


                    <input
                        type="file"
                        id="file_hasil"
                        class="form-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                        multiple>


                    <input
                        type="file"
                        name="file_hasil[]"
                        id="file_storage"
                        multiple
                        hidden>


                    <div
                        id="list_file"
                        class="mt-3">
                    </div>


                    <small class="text-muted">

                        Bisa upload banyak file.<br>

                        Format PDF, JPG, JPEG, PNG.<br>

                        Maksimal 5 MB per file.

                    </small>

                </div>


                <!-- DOKUMEN SEBELUMNYA -->

                <?php if (
                    !empty($tiket['dokumen_hasil']) &&
                    is_array($tiket['dokumen_hasil'])
                ): ?>

                    <div class="alert alert-info">

                        <b>
                            Dokumen sebelumnya:
                        </b>


                        <ul class="mt-2">

                            <?php foreach (
                                $tiket['dokumen_hasil']
                                as $dokumen
                            ): ?>

                                <li class="mb-2">


                                    <a
                                        href="<?= base_url(
                                            'uploads/hasil/' .
                                            $dokumen['nama_file']
                                        ) ?>"
                                        target="_blank">

                                        <?= esc(
                                            $dokumen['nama_file']
                                        ) ?>

                                    </a>


                                    <a
                                        href="<?= base_url(
                                            'kemahasiswaan/hapus-dokumen/' .
                                            $dokumen['id']
                                        ) ?>"
                                        class="btn btn-danger btn-sm ms-2"
                                        onclick="return confirm('Hapus dokumen ini?')">

                                        ×

                                    </a>


                                </li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


                <!-- BUTTON SIMPAN -->

                <button
                    type="submit"
                    class="btn btn-primary">

                    Simpan Proses

                </button>


                <!-- BUTTON KEMBALI -->

                <a
                    href="<?= base_url(
                        'kemahasiswaan/detail/' .
                        $tiket['id']
                    ) ?>"
                    class="btn btn-secondary ms-2">

                    Kembali

                </a>


            </form>


        </div>

    </div>


</div>


<script>

let inputFile =
    document.getElementById('file_hasil');


let storageFile =
    document.getElementById('file_storage');


let listFile =
    document.getElementById('list_file');


let daftarFile = [];



inputFile.addEventListener(
    'change',
    function () {

        let fileBaru =
            Array.from(this.files);


        fileBaru.forEach(
            function (file) {

                /*
                |--------------------------------------------------------------------------
                | Maksimal 5 MB
                |--------------------------------------------------------------------------
                */

                if (file.size > 5242880) {

                    alert(
                        'Ukuran ' +
                        file.name +
                        ' maksimal 5 MB'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Validasi format
                |--------------------------------------------------------------------------
                */

                let ekstensi =
                    file.name
                        .split('.')
                        .pop()
                        .toLowerCase();


                let formatDiizinkan = [
                    'pdf',
                    'jpg',
                    'jpeg',
                    'png'
                ];


                if (
                    !formatDiizinkan.includes(
                        ekstensi
                    )
                ) {

                    alert(
                        'Format ' +
                        file.name +
                        ' tidak diperbolehkan.'
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | Tambahkan file
                |--------------------------------------------------------------------------
                */

                daftarFile.push(file);

            }
        );


        tampilkanFile();

        simpanFile();


        this.value = '';

    }
);



function tampilkanFile()
{

    listFile.innerHTML = '';


    daftarFile.forEach(
        function (file, index) {

            listFile.innerHTML += `

                <div
                    class="alert alert-secondary
                           d-flex
                           justify-content-between
                           align-items-center">


                    <span>
                        ${file.name}
                    </span>


                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="hapusFile(${index})">

                        ×

                    </button>

                </div>

            `;

        }
    );

}



function simpanFile()
{

    let dataTransfer =
        new DataTransfer();


    daftarFile.forEach(
        function (file) {

            dataTransfer.items.add(file);

        }
    );


    storageFile.files =
        dataTransfer.files;

}



function hapusFile(index)
{

    daftarFile.splice(
        index,
        1
    );


    tampilkanFile();

    simpanFile();

}


/*
|--------------------------------------------------------------------------
| CEK FORM SEBELUM DIKIRIM
|--------------------------------------------------------------------------
|
| Ini memastikan nilai status yang dikirim
| benar-benar berasal dari select.
|--------------------------------------------------------------------------
*/

document.querySelector('form').addEventListener(
    'submit',
    function (event) {

        let status =
            document.getElementById('status').value;


        if (!status) {

            event.preventDefault();

            alert('Silakan pilih status tiket.');

            return false;
        }

    }
);

</script>


</body>

</html>