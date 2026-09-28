<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       DETAIL LAPORAN TAMU
       ========================================================= */

    .detail-page {
        padding-bottom: 30px;
    }

    .detail-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0, 0, 0, .08);
    }

    .detail-card .card-header {
        background: #124b93;
        color: #fff;
        padding: 16px 20px;
        border-bottom: 4px solid #ff9418;
    }

    .detail-card .card-title {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    .ticket-number {
        font-size: 14px;
        margin-top: 4px;
        opacity: .9;
    }

    .detail-table {
        margin-bottom: 0;
    }

    .detail-table th {
        width: 220px;
        background: #f5f7fa;
        color: #343a40;
        font-weight: 600;
        vertical-align: middle;
    }

    .detail-table td {
        vertical-align: middle;
        color: #343a40;
    }

    .section-title {
        background: #124b93;
        color: #fff;
        padding: 11px 15px;
        margin-top: 25px;
        margin-bottom: 0;
        border-bottom: 3px solid #ff9418;
        font-weight: 600;
        border-radius: 7px 7px 0 0;
    }

    .section-title i {
        margin-right: 8px;
    }

    /* =========================================================
       STATUS
       ========================================================= */

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    .status-submitted {
        background: #fff3cd;
        color: #856404;
    }

    .status-verified {
        background: #d4edda;
        color: #155724;
    }

    .status-assigned {
        background: #cce5ff;
        color: #004085;
    }

    .status-processing,
    .status-in-progress {
        background: #d1ecf1;
        color: #0c5460;
    }

    .status-completed {
        background: #d4edda;
        color: #155724;
    }

    .status-revision {
        background: #ffe5d0;
        color: #8a3c00;
    }

    .status-rejected,
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .status-default {
        background: #e2e3e5;
        color: #383d41;
    }

    /* =========================================================
       DOKUMEN
       ========================================================= */

    .document-container {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0 0 8px 8px;
        padding: 15px;
    }

    .document-item {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .document-item:last-child {
        margin-bottom: 0;
    }

    .document-info {
        display: flex;
        align-items: center;
        min-width: 0;
        flex: 1;
    }

    .document-icon {
        width: 45px;
        height: 45px;
        min-width: 45px;
        border-radius: 8px;
        background: #eaf2fb;
        color: #124b93;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 12px;
    }

    .document-name {
        font-weight: 600;
        color: #343a40;
        word-break: break-word;
    }

    .document-requirement {
        color: #6c757d;
        font-size: 13px;
        margin-top: 3px;
    }

    .document-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .document-actions .btn {
        border-radius: 5px;
    }

    .empty-document {
        text-align: center;
        padding: 25px 15px;
        color: #6c757d;
    }

    .empty-document i {
        font-size: 35px;
        margin-bottom: 10px;
        color: #adb5bd;
    }

    /* =========================================================
       DESCRIPTION
       ========================================================= */

    .description-box {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 7px;
        padding: 15px;
        line-height: 1.7;
        white-space: normal;
        word-break: break-word;
    }

    /* =========================================================
       FOOTER
       ========================================================= */

    .detail-footer {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 768px) {

        .detail-table th {
            width: 150px;
        }

        .document-item {
            display: block;
        }

        .document-actions {
            margin-top: 12px;
        }

        .detail-footer {
            display: block;
        }

        .detail-footer .btn {
            width: 100%;
            margin-bottom: 8px;
        }
    }

    /* =========================================================
       PRINT
       ========================================================= */

    @media print {

        .content-header,
        .detail-footer {
            display: none !important;
        }

        .detail-card {
            box-shadow: none;
        }

        .document-actions {
            display: none !important;
        }

        .detail-card .card-header {
            background: #124b93 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .section-title {
            background: #124b93 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>


<?php
/*
|--------------------------------------------------------------------------
| NORMALISASI DATA TIKET
|--------------------------------------------------------------------------
*/

$ticket = is_array($ticket ?? null)
    ? $ticket
    : [];

$attachments = is_array($attachments ?? null)
    ? $attachments
    : [];


/*
|--------------------------------------------------------------------------
| DATA DASAR
|--------------------------------------------------------------------------
*/

$ticketNumber = $ticket['ticket_number']
    ?? $ticket['nomor_tiket']
    ?? '-';

$applicantName = $ticket['applicant_name']
    ?? $ticket['nama_pemohon']
    ?? $ticket['student_name']
    ?? $ticket['name']
    ?? '-';

$applicantType = trim((string) (
    $ticket['applicant_type']
    ?? $ticket['jenis_pemohon']
    ?? ''
));

$serviceName = $ticket['service_name']
    ?? $ticket['layanan']
    ?? '-';

$status = trim((string) (
    $ticket['status']
    ?? '-'
));

$priority = $ticket['priority']
    ?? '-';

$title = $ticket['title']
    ?? $ticket['ticket_title']
    ?? '-';

$description = $ticket['description']
    ?? $ticket['ticket_description']
    ?? '';

$submittedAt = $ticket['submitted_at']
    ?? $ticket['created_at']
    ?? null;


/*
|--------------------------------------------------------------------------
| STATUS CLASS
|--------------------------------------------------------------------------
*/

$statusClass = 'status-default';

switch (strtolower($status)) {

    case 'submitted':
        $statusClass = 'status-submitted';
        break;

    case 'verified':
        $statusClass = 'status-verified';
        break;

    case 'assigned':
        $statusClass = 'status-assigned';
        break;

    case 'processing':
        $statusClass = 'status-processing';
        break;

    case 'in progress':
    case 'in-progress':
        $statusClass = 'status-in-progress';
        break;

    case 'completed':
        $statusClass = 'status-completed';
        break;

    case 'revision':
    case 'need revision':
    case 'needs revision':
        $statusClass = 'status-revision';
        break;

    case 'rejected':
        $statusClass = 'status-rejected';
        break;

    case 'cancelled':
    case 'canceled':
        $statusClass = 'status-cancelled';
        break;
}


/*
|--------------------------------------------------------------------------
| HELPER TIPE PEMOHON
|--------------------------------------------------------------------------
*/

$applicantTypeLower = strtolower($applicantType);


/*
|--------------------------------------------------------------------------
| BACKWARD COMPATIBILITY LAMPIRAN LAMA
|--------------------------------------------------------------------------
*/

if (
    empty($attachments) &&
    !empty($ticket['attachment'])
) {

    $oldAttachment = (string) $ticket['attachment'];

    $attachments[] = [
        'id'               => null,
        'ticket_id'        => $ticket['id'] ?? null,
        'requirement_id'   => null,
        'requirement_name' => 'Lampiran',
        'file_name'        => basename($oldAttachment),
        'file_path'        => $oldAttachment,
        'file_extension'   => pathinfo(
            $oldAttachment,
            PATHINFO_EXTENSION
        ),
        'file_size'        => 0,
    ];
}

?>


<div class="detail-page">

    <!-- =====================================================
         HEADER
         ===================================================== -->

    <div class="content-header">

        <div class="container-fluid">

            <h1>
                Detail Laporan Tamu
            </h1>

        </div>

    </div>


    <div class="container-fluid">

        <div class="card detail-card">

            <!-- =================================================
                 CARD HEADER
                 ================================================= -->

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-file-alt mr-2"></i>

                    Detail Informasi Tiket

                </h3>

                <div class="ticket-number">

                    Nomor Tiket:

                    <strong>
                        <?= esc($ticketNumber) ?>
                    </strong>

                </div>

            </div>


            <div class="card-body">

                <!-- =================================================
                     INFORMASI TIKET
                     ================================================= -->

                <div class="section-title">

                    <i class="fas fa-ticket-alt"></i>

                    Informasi Tiket

                </div>


                <table class="table table-bordered detail-table">

                    <tbody>

                        <tr>

                            <th>
                                Nomor Tiket
                            </th>

                            <td>

                                <strong class="text-primary">
                                    <?= esc($ticketNumber) ?>
                                </strong>

                            </td>

                        </tr>


                        <tr>

                            <th>
                                Status
                            </th>

                            <td>

                                <span class="status-badge <?= esc($statusClass) ?>">
                                    <?= esc($status ?: '-') ?>
                                </span>

                            </td>

                        </tr>


                        <tr>

                            <th>
                                Prioritas
                            </th>

                            <td>
                                <?= esc($priority) ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Layanan
                            </th>

                            <td>
                                <?= esc($serviceName) ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Judul Tiket
                            </th>

                            <td>
                                <?= esc($title) ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Tanggal Pengajuan
                            </th>

                            <td>

                                <?php if (!empty($submittedAt)): ?>

                                    <?php
                                    $timestamp = strtotime((string) $submittedAt);
                                    ?>

                                    <?php if ($timestamp !== false): ?>

                                        <?= date(
                                            'd-m-Y H:i:s',
                                            $timestamp
                                        ) ?>

                                    <?php else: ?>

                                        <?= esc($submittedAt) ?>

                                    <?php endif; ?>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>

                        </tr>

                    </tbody>

                </table>


                <!-- =================================================
                     DATA PEMOHON
                     ================================================= -->

                <div class="section-title">

                    <i class="fas fa-user"></i>

                    Data Pemohon

                </div>


                <table class="table table-bordered detail-table">

                    <tbody>

                        <tr>

                            <th>
                                Nama Pemohon
                            </th>

                            <td>
                                <?= esc($applicantName) ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Jenis Pemohon
                            </th>

                            <td>
                                <?= esc($applicantType ?: '-') ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Email
                            </th>

                            <td>
                                <?= esc($ticket['email'] ?? '-') ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                No HP
                            </th>

                            <td>
                                <?= esc($ticket['phone'] ?? '-') ?>
                            </td>

                        </tr>


                        <?php if (
                            in_array(
                                $applicantTypeLower,
                                ['mahasiswa', 'student'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    NIM
                                </th>

                                <td>
                                    <?= esc($ticket['nim'] ?? '-') ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Program Studi
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['program_studi']
                                        ?? $ticket['prodi']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Jurusan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['jurusan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Angkatan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['angkatan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            in_array(
                                $applicantTypeLower,
                                ['dosen', 'lecturer'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    NIP
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['nip']
                                        ?? $ticket['nim']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Fakultas
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['fakultas']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Jabatan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['jabatan_dosen']
                                        ?? $ticket['jabatan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            in_array(
                                $applicantTypeLower,
                                ['tendik', 'tenaga kependidikan'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    NIP
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['nip']
                                        ?? $ticket['nim']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Unit Kerja
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['unit_kerja']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Jabatan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['jabatan_tendik']
                                        ?? $ticket['jabatan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            in_array(
                                $applicantTypeLower,
                                ['orang tua', 'orangtua'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    Nama Mahasiswa
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['nama_mahasiswa']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    NIM Mahasiswa
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['nim_mahasiswa']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Hubungan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['hubungan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            $applicantTypeLower === 'alumni'
                        ): ?>

                            <tr>

                                <th>
                                    NIM
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['nim']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Program Studi
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['prodi_alumni']
                                        ?? $ticket['program_studi']
                                        ?? $ticket['prodi']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Tahun Lulus
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['tahun_lulus']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            $applicantTypeLower === 'mitra'
                        ): ?>

                            <tr>

                                <th>
                                    Instansi
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['instansi']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    PIC
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['pic']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Jabatan PIC
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['jabatan_mitra']
                                        ?? $ticket['jabatan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            in_array(
                                $applicantTypeLower,
                                ['public', 'umum'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    Instansi
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['instansi_public']
                                        ?? $ticket['instansi']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Alamat
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['alamat_public']
                                        ?? $ticket['alamat']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                        <?php elseif (
                            in_array(
                                $applicantTypeLower,
                                ['masyarakat', 'masyarakat umum'],
                                true
                            )
                        ): ?>

                            <tr>

                                <th>
                                    Alamat
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['alamat']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>


                            <tr>

                                <th>
                                    Pekerjaan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['pekerjaan']
                                        ?? '-'
                                    ) ?>
                                </td>

                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>


                <!-- =================================================
                     KETERANGAN
                     ================================================= -->

                <div class="section-title">

                    <i class="fas fa-comment-alt"></i>

                    Keterangan Pengajuan

                </div>


                <div class="description-box">

                    <?php if (trim((string) $description) !== ''): ?>

                        <?= nl2br(esc($description)) ?>

                    <?php else: ?>

                        <span class="text-muted">
                            Tidak ada keterangan.
                        </span>

                    <?php endif; ?>

                </div>


                <!-- =================================================
                     DOKUMEN / LAMPIRAN
                     ================================================= -->

                <div class="section-title">

                    <i class="fas fa-paperclip"></i>

                    Dokumen / Lampiran

                </div>


                <div class="document-container">

                    <?php if (!empty($attachments)): ?>

                        <?php foreach ($attachments as $document): ?>

                            <?php

                            if (!is_array($document)) {
                                continue;
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | NAMA FILE
                            |--------------------------------------------------------------------------
                            */

                            $fileName = trim((string) (
                                $document['file_name']
                                ?? $document['filename']
                                ?? $document['attachment']
                                ?? 'Dokumen'
                            ));


                            if ($fileName === '') {
                                $fileName = 'Dokumen';
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | PATH FILE
                            |--------------------------------------------------------------------------
                            */

                            $filePath = trim((string) (
                                $document['file_path']
                                ?? $document['path']
                                ?? ''
                            ));


                            /*
                            |--------------------------------------------------------------------------
                            | NAMA REQUIREMENT
                            |--------------------------------------------------------------------------
                            */

                            $requirementName = trim((string) (
                                $document['requirement_name']
                                ?? $document['requirement']
                                ?? ''
                            ));


                            if ($requirementName === '') {
                                $requirementName = 'Lampiran Tambahan';
                            }


                            /*
                            |--------------------------------------------------------------------------
                            | EXTENSION
                            |--------------------------------------------------------------------------
                            */

                            $extension = strtolower(trim((string) (
                                $document['file_extension']
                                ?? pathinfo(
                                    $fileName,
                                    PATHINFO_EXTENSION
                                )
                            )));


                            /*
                            |--------------------------------------------------------------------------
                            | UKURAN FILE
                            |--------------------------------------------------------------------------
                            */

                            $fileSize = (int) (
                                $document['file_size']
                                ?? 0
                            );


                            if ($fileSize >= 1048576) {

                                $fileSizeLabel = number_format(
                                    $fileSize / 1048576,
                                    2
                                ) . ' MB';

                            } elseif ($fileSize >= 1024) {

                                $fileSizeLabel = number_format(
                                    $fileSize / 1024,
                                    1
                                ) . ' KB';

                            } elseif ($fileSize > 0) {

                                $fileSizeLabel =
                                    $fileSize . ' B';

                            } else {

                                $fileSizeLabel = '-';

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | URL FILE
                            |--------------------------------------------------------------------------
                            */

                            $fileUrl = '#';

                            if ($filePath !== '') {

                                if (
                                    filter_var(
                                        $filePath,
                                        FILTER_VALIDATE_URL
                                    )
                                ) {

                                    $fileUrl = $filePath;

                                } else {

                                    $normalizedPath = ltrim(
                                        $filePath,
                                        '/'
                                    );


                                    /*
                                    |--------------------------------------------------------------------------
                                    | Kalau database:
                                    | uploads/file.pdf
                                    |--------------------------------------------------------------------------
                                    */

                                    if (
                                        strpos(
                                            $normalizedPath,
                                            'uploads/'
                                        ) === 0
                                    ) {

                                        $fileUrl = base_url(
                                            $normalizedPath
                                        );

                                    } else {

                                        /*
                                        |--------------------------------------------------------------------------
                                        | Kalau database hanya:
                                        | file.pdf
                                        |--------------------------------------------------------------------------
                                        */

                                        $fileUrl = base_url(
                                            'uploads/' .
                                            $normalizedPath
                                        );

                                    }

                                }

                            }


                            /*
                            |--------------------------------------------------------------------------
                            | ICON FILE
                            |--------------------------------------------------------------------------
                            */

                            $fileIcon = 'fa-file';

                            if ($extension === 'pdf') {

                                $fileIcon = 'fa-file-pdf';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'jpg',
                                        'jpeg',
                                        'png',
                                        'gif',
                                        'webp'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-image';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'doc',
                                        'docx'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-word';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'xls',
                                        'xlsx'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-excel';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'ppt',
                                        'pptx'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-powerpoint';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'zip',
                                        'rar',
                                        '7z'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-archive';

                            } elseif (
                                in_array(
                                    $extension,
                                    [
                                        'txt',
                                        'csv'
                                    ],
                                    true
                                )
                            ) {

                                $fileIcon = 'fa-file-alt';

                            }

                            ?>


                            <div class="document-item">

                                <div class="document-info">

                                    <div class="document-icon">

                                        <i class="fas <?= esc($fileIcon) ?>"></i>

                                    </div>


                                    <div>

                                        <div class="document-name">

                                            <?= esc($fileName) ?>

                                        </div>


                                        <div class="document-requirement">

                                            <i class="fas fa-clipboard-check"></i>

                                            <?= esc($requirementName) ?>


                                            <?php if ($extension !== ''): ?>

                                                ·
                                                <?= esc(
                                                    strtoupper($extension)
                                                ) ?>

                                            <?php endif; ?>


                                            <?php if ($fileSize > 0): ?>

                                                ·
                                                <?= esc(
                                                    $fileSizeLabel
                                                ) ?>

                                            <?php endif; ?>

                                        </div>

                                    </div>

                                </div>


                                <div class="document-actions">

                                    <?php if ($fileUrl !== '#'): ?>

                                        <!-- LIHAT -->

                                        <a
                                            href="<?= esc($fileUrl) ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-info btn-sm"
                                            title="Lihat file"
                                        >

                                            <i class="fas fa-eye"></i>

                                            Lihat

                                        </a>


                                        <!-- DOWNLOAD -->

                                        <a
                                            href="<?= esc($fileUrl) ?>"
                                            download="<?= esc($fileName) ?>"
                                            class="btn btn-success btn-sm"
                                            title="Download file"
                                        >

                                            <i class="fas fa-download"></i>

                                            Download

                                        </a>

                                    <?php else: ?>

                                        <span class="text-muted small">

                                            File tidak tersedia

                                        </span>

                                    <?php endif; ?>

                                </div>

                            </div>


                        <?php endforeach; ?>


                    <?php else: ?>

                        <div class="empty-document">

                            <div>

                                <i class="fas fa-file-circle-xmark"></i>

                            </div>


                            <strong>

                                Tidak ada dokumen/lampiran

                            </strong>


                            <div class="small mt-1">

                                Pemohon tidak mengunggah dokumen
                                pada pengajuan ini.

                            </div>

                        </div>

                    <?php endif; ?>

                </div>


                <!-- =================================================
                     FOOTER
                     ================================================= -->

                <div class="detail-footer">

                    <a
                        href="<?= base_url('guest-report') ?>"
                        class="btn btn-secondary"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>


                    <button
                        type="button"
                        class="btn btn-primary"
                        onclick="window.print()"
                    >

                        <i class="fas fa-print"></i>

                        Cetak Detail

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>


<?= $this->endSection() ?>