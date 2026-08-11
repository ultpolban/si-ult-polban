<div
    class="modal fade"
    id="deleteUserModal"
    tabindex="-1"
    aria-labelledby="deleteUserModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                id="deleteUserForm"
                method="post">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="deleteUserModalLabel">

                        Hapus User

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>

                </div>

                <div class="modal-body">

                    <p class="mb-2">

                        Apakah Anda yakin ingin menghapus user berikut?

                    </p>

                    <h5
                        id="deleteUserName"
                        class="text-danger fw-bold mb-0">

                    </h5>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        <i class="fas fa-times"></i>

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        <i class="fas fa-trash"></i>

                        Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const deleteModal = document.getElementById('deleteUserModal');
        const deleteForm = document.getElementById('deleteUserForm');
        const deleteUserName = document.getElementById('deleteUserName');

        if (!deleteModal || !deleteForm || !deleteUserName) {
            return;
        }

        document.querySelectorAll('.btn-delete-user').forEach(function(button) {

            button.addEventListener('click', function() {

                const id = this.dataset.id;
                const name = this.dataset.name;

                deleteUserName.textContent = name;

                deleteForm.action =
                    "<?= site_url('users/delete') ?>/" + id;

                const modal = bootstrap.Modal.getOrCreateInstance(deleteModal);

                modal.show();

            });

        });

    });
</script>