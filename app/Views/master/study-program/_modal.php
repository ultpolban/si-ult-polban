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

                        Hapus Program Studi

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <p>

                        Apakah Anda yakin ingin menghapus program studi berikut?

                    </p>

                    <h5
                        id="studyProgramName"
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

        const deleteModal = document.getElementById('deleteModal');

        document.querySelectorAll('.btn-delete').forEach(function(btn) {

            btn.addEventListener('click', function() {

                document.getElementById('studyProgramName').textContent =
                    this.dataset.name;

                document.getElementById('deleteForm').action =
                    "<?= site_url('master/study-programs/delete') ?>/" + this.dataset.id;

                new bootstrap.Modal(deleteModal).show();

            });

        });

    });
</script>
