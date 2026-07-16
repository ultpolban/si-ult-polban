<form action="<?= base_url('petugas/disposisi/1') ?>" method="post">

    <div class="form-group">
        <label>Pilih Unit</label>

        <select class="form-control" name="unit">
            <option value="">-- Pilih Unit --</option>
            <option value="Akademik">Akademik</option>
            <option value="Kemahasiswaan">Kemahasiswaan</option>
            <option value="Keuangan">Keuangan</option>
            <option value="Umum">Umum</option>
        </select>
    </div>

    <br>

    <div class="card-body">

<div class="form-group">

<label>Unit Tujuan</label>

<select class="form-control">

<option>Bagian Akademik</option>

<option>Bagian Kemahasiswaan</option>

<option>Bagian Keuangan</option>

<option>Bagian Umum</option>

</select>

</div>

<div class="form-group mt-3">

<label>Prioritas</label>

<select class="form-control">

<option>Low</option>

<option>Medium</option>

<option>High</option>

</select>

</div>

<div class="form-group mt-3">

<label>Catatan Petugas</label>

<textarea class="form-control"
rows="5"></textarea>

</div>

</div>

<div class="card-footer">

<a href="<?= base_url('petugas/tiket') ?>"
class="btn btn-secondary">

Kembali

</a>

<button
class="btn btn-primary">

<i class="fas fa-paper-plane"></i>

Kirim Disposisi

</button>

</div>

    <br>

    <button type="submit" class="btn btn-primary">
        <i class="fas fa-paper-plane"></i>
        Kirim Disposisi
    </button>

</form>