<script>
    document.addEventListener('DOMContentLoaded', function() {

        /*
        |--------------------------------------------------------------------------
        | BASE URL
        |--------------------------------------------------------------------------
        */

        const BASE_URL = "<?= base_url() ?>";

        /*
        |--------------------------------------------------------------------------
        | USER TYPE
        |--------------------------------------------------------------------------
        */

        const userType = document.getElementById('user_type_id');

        /*
        |--------------------------------------------------------------------------
        | SECTION
        |--------------------------------------------------------------------------
        */

        const mahasiswaSection = document.getElementById('mahasiswa-section');
        const dosenSection = document.getElementById('dosen-section');
        const tendikSection = document.getElementById('tendik-section');
        const alumniSection = document.getElementById('alumni-section');
        const orangtuaSection = document.getElementById('orangtua-section');
        const mitraSection = document.getElementById('mitra-section');
        const publikSection = document.getElementById('publik-section');

        /*
        |--------------------------------------------------------------------------
        | HIDE ALL SECTION
        |--------------------------------------------------------------------------
        */

        function hideAllSection() {
            document.querySelectorAll('.user-type-section').forEach(function(section) {

                section.style.display = 'none';

            });
        }

        /*
        |--------------------------------------------------------------------------
        | SHOW USER TYPE SECTION
        |--------------------------------------------------------------------------
        */

        function showSection() {
            hideAllSection();

            if (!userType) return;

            const sectionMap = {

                '1': mahasiswaSection,
                '2': dosenSection,
                '3': tendikSection,
                '4': alumniSection,
                '5': orangtuaSection,
                '6': mitraSection,
                '7': publikSection

            };

            if (sectionMap[userType.value]) {

                sectionMap[userType.value].style.display = 'block';

            }
        }

        /*
        |--------------------------------------------------------------------------
        | INIT
        |--------------------------------------------------------------------------
        */

        showSection();

        if (userType) {

            userType.addEventListener('change', showSection);

        }

        /*
        |--------------------------------------------------------------------------
        | DEPARTMENT & STUDY PROGRAM
        |--------------------------------------------------------------------------
        */

        const department = document.getElementById('department_id');

        const studyProgram = document.getElementById('study_program_id');

        /*
        |--------------------------------------------------------------------------
        | LOAD STUDY PROGRAM
        |--------------------------------------------------------------------------
        */

        function loadStudyPrograms(departmentId, selected = '') {
            if (!department || !studyProgram) return;

            if (departmentId === '') {

                studyProgram.innerHTML = `
                <option value="">
                    -- Pilih Program Studi --
                </option>
            `;

                return;
            }

            studyProgram.innerHTML = `
            <option value="">
                Memuat data...
            </option>
        `;

            fetch(BASE_URL + '/users/study-programs/' + departmentId)

                .then(response => response.json())

                .then(data => {

                    let html = `
                <option value="">
                    -- Pilih Program Studi --
                </option>
            `;

                    data.forEach(function(item) {

                        const isSelected =
                            item.id == selected ? 'selected' : '';

                        html += `
                    <option value="${item.id}" ${isSelected}>
                        ${item.education_level} - ${item.program_name}
                    </option>
                `;

                    });

                    studyProgram.innerHTML = html;

                })

                .catch(function() {

                    studyProgram.innerHTML = `
                <option value="">
                    Gagal memuat data
                </option>
            `;

                });

        }

        /*
        |--------------------------------------------------------------------------
        | CHANGE DEPARTMENT
        |--------------------------------------------------------------------------
        */

        if (department) {

            department.addEventListener('change', function() {

                loadStudyPrograms(this.value);

            });

        }

        /*
        |--------------------------------------------------------------------------
        | AUTO LOAD (EDIT)
        |--------------------------------------------------------------------------
        */

        if (department && department.value !== '') {

            const selectedStudyProgram =
                studyProgram.dataset.selected ?? '';

            loadStudyPrograms(
                department.value,
                selectedStudyProgram
            );

        }

        /*
        |--------------------------------------------------------------------------
        | CHANGE USER TYPE
        |--------------------------------------------------------------------------
        */

        if (userType) {

            userType.addEventListener('change', function() {

                showSection();

            });

        }

        /*
        |--------------------------------------------------------------------------
        | PHOTO PREVIEW
        |--------------------------------------------------------------------------
        */

        const photoInput = document.querySelector('input[name="photo"]');

        const photoPreview = document.getElementById('photo-preview');

        if (photoInput && photoPreview) {

            photoInput.addEventListener('change', function() {

                const file = this.files[0];

                if (!file) {

                    return;

                }

                const reader = new FileReader();

                reader.onload = function(e) {

                    photoPreview.src = e.target.result;

                    photoPreview.style.display = 'block';

                };

                reader.readAsDataURL(file);

            });

        }

    });

    document.addEventListener('DOMContentLoaded', function() {

        const role = document.getElementById('role_id');
        const wrapper = document.getElementById('user-type-wrapper');
        const userType = document.getElementById('user_type_id');

        function toggleUserType() {

            if (!role || !wrapper) return;

            const roleText = role.options[role.selectedIndex]
                .text
                .trim()
                .toLowerCase();

            if (roleText === 'pemohon') {

                wrapper.style.display = '';

                userType.disabled = false;

            } else {

                wrapper.style.display = 'none';

                userType.value = '';

                userType.disabled = true;

            }

        }

        toggleUserType();

        role.addEventListener('change', toggleUserType);

    });
</script>