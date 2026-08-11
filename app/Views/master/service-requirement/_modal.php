<div
    class="modal fade"
    id="deleteModal"
    tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                id="deleteForm"
                method="post">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5 class="modal-title">

                        Hapus Persyaratan

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <p>

                        Yakin ingin menghapus persyaratan berikut?

                    </p>

                    <h5
                        id="requirementName"
                        class="text-danger">

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

                        Hapus

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const modal = document.getElementById('deleteModal');

        document.querySelectorAll('.btn-delete').forEach(function(button) {

            button.addEventListener('click', function() {

                document.getElementById('requirementName').textContent =
                    this.dataset.name;

                document.getElementById('deleteForm').action =
                    "<?= site_url('master/service-requirements/delete') ?>/" +
                    this.dataset.id;

                new bootstrap.Modal(modal).show();

            });

        });

    });
</script>