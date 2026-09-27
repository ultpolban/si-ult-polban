<div class="modal fade" id="deleteTicketModal" tabindex="-1" aria-labelledby="deleteTicketModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="deleteTicketForm" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTicketModalLabel">Hapus Tiket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Apakah Anda yakin ingin menghapus tiket berikut?</p>
                    <h5 id="deleteTicketName" class="text-danger fw-bold mb-0"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Batal</button>
                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('deleteTicketModal');
        const form = document.getElementById('deleteTicketForm');
        const nameElement = document.getElementById('deleteTicketName');
        document.querySelectorAll('.btn-delete-ticket').forEach(function(button) {
            button.addEventListener('click', function() {
                form.action = "<?= site_url('tickets/delete') ?>/" + this.dataset.id;
                nameElement.textContent = this.dataset.name;
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            });
        });
    });
</script>