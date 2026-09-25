<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
        <form id="deleteForm" method="post"><?= csrf_field() ?>
            <div class="modal-header"><h5 class="modal-title">Hapus Deskripsi Unit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body"><p>Yakin ingin menghapus deskripsi unit berikut?</p>
                <h5 id="profileName" class="text-danger fw-bold"></h5></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
            </div>
        </form>
    </div></div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const m = document.getElementById('deleteModal');
    document.querySelectorAll('.btn-delete').forEach(function(b) {
        b.addEventListener('click', function() {
            document.getElementById('profileName').textContent = this.dataset.name;
            document.getElementById('deleteForm').action = "<?= site_url('units-profiles/delete') ?>/" + this.dataset.id;
            new bootstrap.Modal(m).show();
        });
    });
});
</script>
