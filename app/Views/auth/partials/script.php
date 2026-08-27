<script>
    document.addEventListener('DOMContentLoaded', function() {

        /* ==========================================================
         * ELEMENT
         * ========================================================== */

        const userType = document.getElementById('user_type_id');

        const forms = {
            mahasiswa: document.getElementById('form-mahasiswa'),
            dosen: document.getElementById('form-dosen'),
            tendik: document.getElementById('form-tendik'),
            alumni: document.getElementById('form-alumni'),
            orangtua: document.getElementById('form-orangtua'),
            mitra: document.getElementById('form-mitra'),
            publik: document.getElementById('form-publik')
        };

        /* ==========================================================
         * HIDE / SHOW FORM
         * ========================================================== */

        function disableForm(form) {

            if (!form) return;

            form.querySelectorAll('input,select,textarea').forEach(function(el) {

                el.disabled = true;

            });

            form.style.display = 'none';

        }

        function enableForm(form) {

            if (!form) return;

            form.querySelectorAll('input,select,textarea').forEach(function(el) {

                el.disabled = false;

            });

            form.style.display = 'block';

        }

        function hideAll() {

            Object.values(forms).forEach(disableForm);

        }

        function showSelectedForm() {

            hideAll();

            if (!userType) return;

            switch (userType.value) {

                case "1":
                    enableForm(forms.mahasiswa);
                    break;

                case "2":
                    enableForm(forms.dosen);
                    break;

                case "3":
                    enableForm(forms.tendik);
                    break;

                case "4":
                    enableForm(forms.alumni);
                    break;

                case "5":
                    enableForm(forms.orangtua);
                    break;

                case "6":
                    enableForm(forms.mitra);
                    break;

                case "7":
                    enableForm(forms.publik);
                    break;
            }
        }

        if (userType) {

            userType.addEventListener('change', showSelectedForm);

            showSelectedForm();

        }

        /* ==========================================================
         * PREVIEW FOTO
         * ========================================================== */

        const photo = document.getElementById('photo');

        const preview = document.getElementById('photoPreview');

        if (photo && preview) {

            photo.addEventListener('change', function() {

                if (!this.files.length) return;

                const reader = new FileReader();

                reader.onload = function(e) {

                    preview.src = e.target.result;

                    preview.classList.remove('d-none');

                }

                reader.readAsDataURL(this.files[0]);

            });

        }

        /* ==========================================================
         * SHOW PASSWORD
         * ========================================================== */

        document.querySelectorAll('.toggle-password').forEach(function(btn) {

            btn.addEventListener('click', function() {

                const target = document.querySelector(this.dataset.target);

                if (!target) return;

                if (target.type === "password") {

                    target.type = "text";

                    this.innerHTML = '<i class="bi bi-eye-slash"></i>';

                } else {

                    target.type = "password";

                    this.innerHTML = '<i class="bi bi-eye"></i>';

                }

            });

        });

    });
</script>

<script>
    /* ==========================================================
     * AJAX PROGRAM STUDI
     * ========================================================== */

    document.addEventListener('DOMContentLoaded', function() {

        function loadProgram(departmentID, studyID) {

            const department = document.querySelector(departmentID);

            const study = document.querySelector(studyID);

            if (!department || !study) return;

            function populatePrograms(data) {

                const selectedProgramId = study.dataset.selected || '';

                study.innerHTML = '<option value="">Pilih Program Studi</option>';

                data.forEach(function(item) {

                    let option = document.createElement('option');

                    option.value = item.id;

                    const educationLevel = item.education_level ?? item.degree ?? '';
                    const programName = item.program_name ?? item.name ?? '';

                    option.text = [educationLevel, programName]
                        .filter(Boolean)
                        .join(' - ');

                    option.selected = String(item.id) === String(selectedProgramId);

                    study.appendChild(option);

                });

            }

            function fetchPrograms() {

                study.innerHTML = '<option>Memuat...</option>';

                if (department.value === '') {

                    study.innerHTML = '<option value="">Pilih Program Studi</option>';

                    return;

                }

                fetch("<?= base_url('study-programs/by-department') ?>/" + department.value)

                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal memuat program studi.');
                        }

                        return response.json();
                    })

                    .then(data => {
                        if (!Array.isArray(data)) {
                            throw new Error('Format data program studi tidak valid.');
                        }

                        populatePrograms(data);
                    })

                    .catch(() => {
                        study.innerHTML = '<option value="">Program studi tidak dapat dimuat</option>';
                    });

            }

            department.addEventListener('change', function() {

                study.dataset.selected = '';

                fetchPrograms();

            });

            if (department.value !== '') {
                fetchPrograms();
            }

        }

        loadProgram('#department_id', '#study_program_id');

        loadProgram('#department_dosen', '#study_program_dosen');

        loadProgram('#department_alumni', '#study_program_alumni');

        loadProgram('#department_orangtua', '#study_program_orangtua');

    });
</script>
