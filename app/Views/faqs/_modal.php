<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-labelledby="deleteModalLabel"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                id="deleteForm"
                method="post">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="deleteModalLabel">

                        Hapus FAQ

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

                        Apakah Anda yakin ingin menghapus FAQ berikut?

                    </p>

                    <h5
                        id="faqName"
                        class="text-danger fw-bold">

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

        const deleteModal = document.getElementById('deleteModal');

        document.querySelectorAll('.btn-delete').forEach(function(button) {

            button.addEventListener('click', function() {

                const id = this.dataset.id;

                const name = this.dataset.name;

                document.getElementById('faqName').textContent = name;

                document.getElementById('deleteForm').action =
                    "<?= site_url('faqs/delete') ?>/" + id;

                const modal = new bootstrap.Modal(deleteModal);

                modal.show();

            });

        });

    });
</script>