<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1"
    aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                id="deleteForm"
                method="post">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5 class="modal-title">

                        Hapus Unit Layanan

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <p>

                        Apakah Anda yakin ingin menghapus data berikut?

                    </p>

                    <h5
                        id="serviceUnitName"
                        class="text-danger mb-0">

                    </h5>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

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

        document.querySelectorAll('.btn-delete').forEach(button => {

            button.addEventListener('click', function() {

                const id = this.dataset.id;

                const name = this.dataset.name;

                document.getElementById('serviceUnitName').textContent = name;

                document.getElementById('deleteForm').action =
                    "<?= site_url('master/service-units/delete') ?>/" + id;

                new bootstrap.Modal(deleteModal).show();

            });

        });

    });
</script>