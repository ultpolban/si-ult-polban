<script>
    $(function() {

        $('.btn-delete').click(function() {

            let id = $(this).data('id');

            let name = $(this).data('name');

            $('#departmentName').text(name);

            $('#deleteForm').attr(
                'action',
                "<?= site_url('master/departments/delete') ?>/" + id
            );

            $('#deleteModal').modal('show');

        });

    });
</script>