<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- JQuery (opsional, jika masih dipakai) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- App JS -->
<script src="<?= base_url('assets/js/app.js') ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Tooltip Bootstrap
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');

        [...tooltipTriggerList].map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto Close Alert
        const alerts = document.querySelectorAll('.alert');

        alerts.forEach(function(alert) {

            setTimeout(function() {

                if (alert) {

                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);

                    bsAlert.close();

                }

            }, 4000);

        });

    });
</script>

</body>

</html>