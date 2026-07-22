<script>
    document.addEventListener('DOMContentLoaded', function() {

        const role = document.getElementById('role_id');
        const userType = document.getElementById('user_type_id');
        const userTypeContainer = document.getElementById('userTypeContainer');

        const department = document.getElementById('department_id');
        const studyProgram = document.getElementById('study_program_id');

        const forms = {

            petugas: document.getElementById('petugasForm'),
            unit: document.getElementById('unitTujuanForm'),
            pimpinan: document.getElementById('pimpinanForm'),

            mahasiswa: document.getElementById('mahasiswaForm'),
            dosen: document.getElementById('dosenForm'),
            alumni: document.getElementById('alumniForm'),
            orangtua: document.getElementById('orangtuaForm'),
            mitra: document.getElementById('mitraForm'),
            publik: document.getElementById('publikForm')

        };

        function hideAllForms() {

            Object.values(forms).forEach(function(form) {

                if (form) {

                    form.style.display = 'none';

                }

            });

        }

        function showRoleForm() {

            hideAllForms();

            userTypeContainer.style.display = 'none';

            if (!role) return;

            let roleName = role.options[role.selectedIndex].text.trim();

            switch (roleName) {

                case 'Petugas ULT':

                    forms.petugas.style.display = 'block';

                    break;

                case 'Unit Tujuan':

                    forms.unit.style.display = 'block';

                    break;

                case 'Pimpinan':

                    forms.pimpinan.style.display = 'block';

                    break;

                case 'Pemohon':

                    userTypeContainer.style.display = 'block';

                    showPemohonForm();

                    break;

            }

        }

        function showPemohonForm() {

            hideAllForms();

            if (!userType) return;

            let jenis = userType.options[userType.selectedIndex].text.trim();

            switch (jenis) {

                case 'Mahasiswa':

                    forms.mahasiswa.style.display = 'block';

                    break;

                case 'Dosen':

                    forms.dosen.style.display = 'block';

                    break;

                case 'Alumni':

                    forms.alumni.style.display = 'block';

                    break;

                case 'Orang Tua/Wali':

                    forms.orangtua.style.display = 'block';

                    break;

                case 'Mitra':

                    forms.mitra.style.display = 'block';

                    break;

                case 'Publik':

                    forms.publik.style.display = 'block';

                    break;

            }

        }

        /*
===================================================
LOAD PROGRAM STUDI
===================================================
*/

        if (department && studyProgram) {

            department.addEventListener('change', function() {

                let departmentId = this.value;

                studyProgram.innerHTML =
                    '<option value="">Memuat...</option>';

                if (!departmentId) {

                    studyProgram.innerHTML =
                        '<option value="">Pilih Program Studi</option>';

                    return;
                }

                fetch("<?= site_url('study-programs/by-department') ?>/" + departmentId)

                    .then(response => response.json())

                    .then(data => {

                        studyProgram.innerHTML =
                            '<option value="">Pilih Program Studi</option>';

                        if (data.length === 0) {

                            studyProgram.innerHTML =
                                '<option value="">Tidak ada Program Studi</option>';

                            return;
                        }

                        data.forEach(function(program) {

                            const option = document.createElement('option');

                            option.value = program.id;

                            // Menampilkan Jenjang + Nama Program Studi
                            option.text =
                                program.education_level + " - " + program.program_name;

                            studyProgram.appendChild(option);

                        });

                    })

                    .catch(error => {

                        console.log(error);

                        studyProgram.innerHTML =
                            '<option value="">Gagal memuat data</option>';

                    });

            });

        }

        if (role) {

            role.addEventListener('change', showRoleForm);

        }

        if (userType) {

            userType.addEventListener('change', showPemohonForm);

        }

        showRoleForm();

    });
</script>