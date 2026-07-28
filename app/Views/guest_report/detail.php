<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">

        <h1>Detail Laporan Tamu</h1>

    </div>
</div>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            <?= esc($ticket['ticket_number']) ?>
        </h3>

    </div>

    <div class="card-body">
<table class="table table-bordered">

    <tr>
        <th width="220">Nomor Tiket</th>
        <td><?= esc($ticket['ticket_number']) ?></td>
    </tr>

    <tr>
        <th>Nama Pemohon</th>
        <td><?= esc($ticket['applicant_name']) ?></td>
    </tr>

    <tr>
        <th>Jenis Pemohon</th>
        <td><?= esc($ticket['applicant_type']) ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?= esc($ticket['email']) ?></td>
    </tr>

    <tr>
        <th>No HP</th>
        <td><?= esc($ticket['phone']) ?></td>
    </tr>

    <!-- ===================== -->
    <!-- DATA KHUSUS PEMOHON -->
    <!-- ===================== -->

    <?php if($ticket['applicant_type']=='Mahasiswa'): ?>

        <tr>
            <th>NIM</th>
            <td><?= esc($ticket['nim']) ?></td>
        </tr>

        <tr>
            <th>Program Studi</th>
            <td><?= esc($ticket['program_studi']) ?></td>
        </tr>

        <tr>
            <th>Jurusan</th>
            <td><?= esc($ticket['jurusan']) ?></td>
        </tr>

        <tr>
            <th>Angkatan</th>
            <td><?= esc($ticket['angkatan']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Dosen'): ?>

        <tr>
            <th>NIP</th>
            <td><?= esc($ticket['nim']) ?></td>
        </tr>

        <tr>
            <th>Fakultas</th>
            <td><?= esc($ticket['fakultas']) ?></td>
        </tr>

        <tr>
            <th>Jabatan</th>
            <td><?= esc($ticket['jabatan_dosen']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Tendik'): ?>

        <tr>
            <th>NIP</th>
            <td><?= esc($ticket['nim']) ?></td>
        </tr>

        <tr>
            <th>Unit Kerja</th>
            <td><?= esc($ticket['unit_kerja']) ?></td>
        </tr>

        <tr>
            <th>Jabatan</th>
            <td><?= esc($ticket['jabatan_tendik']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Orang Tua'): ?>

        <tr>
            <th>Nama Mahasiswa</th>
            <td><?= esc($ticket['nama_mahasiswa']) ?></td>
        </tr>

        <tr>
            <th>NIM Mahasiswa</th>
            <td><?= esc($ticket['nim_mahasiswa']) ?></td>
        </tr>

        <tr>
            <th>Hubungan</th>
            <td><?= esc($ticket['hubungan']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Alumni'): ?>

        <tr>
            <th>NIM</th>
            <td><?= esc($ticket['nim']) ?></td>
        </tr>

        <tr>
            <th>Program Studi</th>
            <td><?= esc($ticket['prodi_alumni']) ?></td>
        </tr>

        <tr>
            <th>Tahun Lulus</th>
            <td><?= esc($ticket['tahun_lulus']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Mitra'): ?>

        <tr>
            <th>Instansi</th>
            <td><?= esc($ticket['instansi']) ?></td>
        </tr>

        <tr>
            <th>PIC</th>
            <td><?= esc($ticket['pic']) ?></td>
        </tr>

        <tr>
            <th>Jabatan PIC</th>
            <td><?= esc($ticket['jabatan_mitra']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Public'): ?>

        <tr>
            <th>Instansi</th>
            <td><?= esc($ticket['instansi_public']) ?></td>
        </tr>

        <tr>
            <th>Alamat</th>
            <td><?= esc($ticket['alamat_public']) ?></td>
        </tr>

    <?php elseif($ticket['applicant_type']=='Masyarakat'): ?>

        <tr>
            <th>Alamat</th>
            <td><?= esc($ticket['alamat']) ?></td>
        </tr>

        <tr>
            <th>Pekerjaan</th>
            <td><?= esc($ticket['pekerjaan']) ?></td>
        </tr>

    <?php endif; ?>

    <!-- ===================== -->

    <tr>
        <th>Layanan</th>
        <td><?= esc($ticket['service_name']) ?></td>
    </tr>

    <tr>
        <th>Judul Tiket</th>
        <td><?= esc($ticket['ticket_title']) ?></td>
    </tr>

    <tr>
        <th>Deskripsi</th>
        <td><?= nl2br(esc($ticket['ticket_description'])) ?></td>
    </tr>

    <tr>
        <th>Status</th>
        <td>
            <span class="badge badge-primary">
                <?= esc($ticket['status']) ?>
            </span>
        </td>
    </tr>

    <tr>
        <th>Prioritas</th>
        <td><?= esc($ticket['priority']) ?></td>
    </tr>

    <tr>
        <th>Tanggal Pengajuan</th>
        <td><?= date('d-m-Y H:i:s', strtotime($ticket['submitted_at'])) ?></td>
    </tr>

    <tr>
        <th>Lampiran</th>
        <td>

            <?php if(!empty($ticket['attachment'])): ?>

                <a href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                   target="_blank"
                   class="btn btn-success btn-sm">

                    <i class="fas fa-download"></i>
                    Lihat Lampiran

                </a>

            <?php else: ?>

                -

            <?php endif; ?>

        </td>
    </tr>

</table>

</div>

<?= $this->endSection() ?>