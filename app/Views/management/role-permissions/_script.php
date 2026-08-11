<script>
    $(function() {

        /*
        |--------------------------------------------------------------------------
        | Pilih Semua Permission
        |--------------------------------------------------------------------------
        */

        $('#checkAll').change(function() {

            $('.permission-item').prop(
                'checked',
                $(this).prop('checked')
            );

            $('.module-check').prop(
                'checked',
                $(this).prop('checked')
            );

        });

        /*
        |--------------------------------------------------------------------------
        | Pilih Semua per Modul
        |--------------------------------------------------------------------------
        */

        $('.module-check').change(function() {

            let id = $(this).attr('id');

            let hash = id.replace('module-', '');

            $('.permission-module-' + hash).prop(
                'checked',
                $(this).prop('checked')
            );

        });

        /*
        |--------------------------------------------------------------------------
        | Sinkronisasi Checkbox Modul
        |--------------------------------------------------------------------------
        */

        $('.module-check').each(function() {

            let hash = $(this).attr('id').replace('module-', '');

            let total = $('.permission-module-' + hash).length;

            let checked = $('.permission-module-' + hash + ':checked').length;

            if (total === checked) {

                $(this).prop('checked', true);

            }

        });

        /*
        |--------------------------------------------------------------------------
        | Sinkronisasi Checkbox Global
        |--------------------------------------------------------------------------
        */

        if (

            $('.permission-item').length ===
            $('.permission-item:checked').length

        ) {

            $('#checkAll').prop('checked', true);

        }

        /*
        |--------------------------------------------------------------------------
        | Refresh Modul ketika Permission berubah
        |--------------------------------------------------------------------------
        */

        $('.permission-item').change(function() {

            $('.module-check').each(function() {

                let hash = $(this).attr('id').replace('module-', '');

                let total = $('.permission-module-' + hash).length;

                let checked = $('.permission-module-' + hash + ':checked').length;

                $(this).prop('checked', total === checked);

            });

            $('#checkAll').prop(

                'checked',

                $('.permission-item').length ===

                $('.permission-item:checked').length

            );

        });

    });
</script>