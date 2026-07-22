<script>
    document.addEventListener("DOMContentLoaded", function() {

        const userType = document.getElementById("user_type_id");

        /*
        ======================================================
        SEMUA FORM
        ======================================================
        */

        const forms = {

            mahasiswa: document.getElementById("form-mahasiswa"),
            dosen: document.getElementById("form-dosen"),
            tendik: document.getElementById("form-pegawai"),
            alumni: document.getElementById("form-alumni"),
            orangtua: document.getElementById("form-orangtua"),
            mitra: document.getElementById("form-mitra"),
            publik: document.getElementById("form-publik")

        };

        function hideAll() {

            Object.values(forms).forEach(function(form) {

                if (form) {

                    form.style.display = "none";

                }

            });

        }

        function showForm() {

            hideAll();

            if (!userType) return;

            let type = userType.options[userType.selectedIndex].text.trim().toLowerCase();

            switch (type) {

                case "mahasiswa":

                    forms.mahasiswa.style.display = "block";

                    break;

                case "dosen":

                    forms.dosen.style.display = "block";

                    break;

                case "tendik":

                    forms.tendik.style.display = "block";

                    break;

                case "alumni":

                    forms.alumni.style.display = "block";

                    break;

                case "orang tua":

                case "orang tua/wali":

                case "wali":

                    forms.orangtua.style.display = "block";

                    break;

                case "mitra":

                    forms.mitra.style.display = "block";

                    break;

                case "publik":

                    forms.publik.style.display = "block";

                    break;

            }

        }

        if (userType) {

            userType.addEventListener("change", showForm);

            showForm();

        }

    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function loadProgramStudi(departmentId, studyProgramId) {

            const department = document.getElementById(departmentId);

            const study = document.getElementById(studyProgramId);

            if (!department || !study) {

                return;

            }

            department.addEventListener("change", function() {

                let id = this.value;

                study.innerHTML = "<option>Memuat...</option>";

                if (id == "") {

                    study.innerHTML = '<option value="">Pilih Program Studi</option>';

                    return;

                }

                fetch("<?= base_url('study-programs/by-department') ?>/" + id)

                    .then(res => res.json())

                    .then(function(data) {

                        study.innerHTML = '<option value="">Pilih Program Studi</option>';

                        data.forEach(function(item) {

                            study.innerHTML += `
                    <option value="${item.id}">
                        ${item.education_level} - ${item.program_name}
                    </option>`;

                        });

                    });

            });

        }

        /*
        ==============================================
        SEMUA FORM YANG MEMAKAI PRODI
        ==============================================
        */

        loadProgramStudi("department_id", "study_program_id");

        loadProgramStudi("department_dosen", "study_program_dosen");

        loadProgramStudi("department_tendik", "study_program_tendik");

        loadProgramStudi("department_alumni", "study_program_alumni");

        loadProgramStudi("department_orangtua", "study_program_orangtua");

    });
</script>