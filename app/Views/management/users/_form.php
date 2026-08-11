<?= csrf_field() ?>

<?php
$isEdit = isset($item) && !empty($item['id']);

if (!isset($data) || !is_array($data)) {
    $data = [];
}

$selectedApplicantTypeId = old(
    'applicant_type_id',
    $profile['applicant_type_id'] ?? ($data['applicant_type_id'] ?? '')
);

$applicantCodeForForm = $applicantCode ?? 'UMUM';

if (old('applicant_type_id')) {
    foreach ($applicantTypes as $type) {
        if ((string) $type['id'] === (string) old('applicant_type_id')) {
            $applicantCodeForForm = strtoupper($type['code']);
            break;
        }
    }
}

$formData = $isEdit ? ($profile ?? []) : $data;

$formData['full_name'] = old('full_name', $formData['full_name'] ?? '');
$formData['email'] = old('email', $formData['email'] ?? '');
$formData['phone_number'] = old('phone_number', $formData['phone_number'] ?? '');
$formData['identity_number'] = old('identity_number', $formData['identity_number'] ?? ($item['identity_number'] ?? ''));
$formData['nim'] = old('nim', $formData['nim'] ?? '');
$formData['nik'] = old('nik', $formData['nik'] ?? '');
$formData['study_program_id'] = old('study_program_id', $formData['study_program_id'] ?? '');
$formData['class_id'] = old('class_id', $formData['class_id'] ?? '');
$formData['student_name'] = old('student_name', $formData['student_name'] ?? '');
$formData['institution_name'] = old('institution_name', $formData['institution_name'] ?? '');
$formData['position'] = old('position', $formData['position'] ?? '');
$formData['address'] = old('address', $formData['address'] ?? '');
?>

<div class="card">

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label for="role_id" class="form-label">
                    Role <span class="text-danger">*</span>
                </label>

                <select
                    name="role_id"
                    id="role_id"
                    class="form-select"
                    required>

                    <option value="">Pilih Role</option>

                    <?php foreach ($roles as $role) : ?>

                        <option
                            value="<?= $role['id'] ?>"
                            <?= old('role_id', $item['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>>

                            <?= esc($role['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-6 mb-3" id="applicantTypeWrapper">

                <label for="applicantType" class="form-label">
                    Jenis Pemohon
                </label>

                <select
                    name="applicant_type_id"
                    id="applicantType"
                    class="form-select">

                    <option value="">Pilih Jenis Pemohon</option>

                    <?php foreach ($applicantTypes as $type) : ?>

                        <option
                            value="<?= $type['id'] ?>"
                            data-code="<?= esc($type['code']) ?>"
                            <?= (string) $selectedApplicantTypeId === (string) $type['id'] ? 'selected' : '' ?>>

                            <?= esc($type['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <div id="dynamicFields">

            <?= view('components/applicant_fields', [
                'applicantCode' => $applicantCodeForForm,
                'applicantType' => $applicantType ?? null,
                'studyPrograms' => $studyPrograms,
                'classes'       => $classes,
                'data'          => $formData,
            ]) ?>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label for="password" class="form-label">
                    Password <?= $isEdit ? '' : '<span class="text-danger">*</span>' ?>
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    minlength="8"
                    <?= $isEdit ? '' : 'required' ?>>

                <?php if ($isEdit) : ?>

                    <small class="text-muted">
                        Kosongkan jika password tidak diubah.
                    </small>

                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label for="password_confirmation" class="form-label">
                    Konfirmasi Password <?= $isEdit ? '' : '<span class="text-danger">*</span>' ?>
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="form-control"
                    minlength="8"
                    <?= $isEdit ? '' : 'required' ?>>

            </div>

        </div>

        <div class="form-check mb-3">

            <input
                type="checkbox"
                name="is_active"
                value="1"
                id="is_active"
                class="form-check-input"
                <?= old('is_active', $item['is_active'] ?? 1) ? 'checked' : '' ?>>

            <label
                for="is_active"
                class="form-check-label">

                Aktif

            </label>

        </div>

    </div>

    <div class="card-footer">

        <button
            type="submit"
            class="btn btn-primary">

            <i class="fas fa-save"></i>

            <?= $isEdit ? 'Update' : 'Simpan' ?>

        </button>

        <a
            href="<?= site_url('users') ?>"
            class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

<?= $this->section('scripts') ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const fieldsUrl = "<?= base_url('users/fields') ?>";
        const roleSelect = document.getElementById('role_id');
        const applicantSelect = document.getElementById('applicantType');
        const applicantWrapper = document.getElementById('applicantTypeWrapper');
        const dynamicFields = document.getElementById('dynamicFields');

        if (!roleSelect || !applicantSelect || !applicantWrapper || !dynamicFields) {
            return;
        }

        function loadFields(id) {

            fetch(fieldsUrl + '/' + id)
                .then(response => response.text())
                .then(html => {

                    if (html) {
                        dynamicFields.innerHTML = html;
                    }

                });

        }

        function toggleApplicantType(loadDefault = true) {

            const selectedOption = roleSelect.options[roleSelect.selectedIndex];
            const roleName = selectedOption ? selectedOption.text : '';
            const isPemohon = /Pemohon/i.test(roleName);

            if (isPemohon) {

                applicantWrapper.style.display = '';
                applicantSelect.disabled = false;

                return;

            }

            applicantWrapper.style.display = 'none';
            applicantSelect.value = '';
            applicantSelect.disabled = true;

            if (loadDefault) {
                loadFields(0);
            }

        }

        roleSelect.addEventListener('change', function() {
            toggleApplicantType(true);
        });

        applicantSelect.addEventListener('change', function() {

            const id = this.value;

            if (!id) {

                dynamicFields.innerHTML =
                    '<p class="text-muted text-center py-3">Pilih jenis pemohon terlebih dahulu.</p>';

                return;

            }

            loadFields(id);

        });

        toggleApplicantType(false);

    });
</script>

<?= $this->endSection() ?>