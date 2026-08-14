<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       PROFILE PETUGAS - SI ULT POLBAN
       ========================================================= */

    .petugas-profile {
        padding: 24px 28px 40px;
        background: #f4f7fb;
        min-height: calc(100vh - 70px);
    }

    /* HEADER */
    .profile-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .profile-title-wrap {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .profile-title-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0b5cab, #193a91);
        color: #fff;
        font-size: 22px;
        box-shadow: 0 8px 20px rgba(11, 92, 171, .18);
    }

    .profile-title-wrap h1 {
        margin: 0;
        color: #193a91;
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -.4px;
    }

    .profile-title-wrap p {
        margin: 4px 0 0;
        color: #70809a;
        font-size: 14px;
    }

    .profile-edit-main-btn {
        border: 0;
        padding: 12px 20px;
        border-radius: 10px;
        background: #ff8c00;
        color: #fff;
        font-weight: 700;
        transition: .25s ease;
        box-shadow: 0 6px 16px rgba(255, 140, 0, .22);
    }

    .profile-edit-main-btn:hover {
        background: #e97c00;
        transform: translateY(-2px);
        color: #fff;
    }

    /* MAIN CARD */
    .profile-main-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid #e6ebf2;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(24, 52, 93, .07);
    }

    .profile-card-header {
        background: linear-gradient(135deg, #193a91 0%, #2449a4 100%);
        padding: 22px 28px;
        color: #fff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-card-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .profile-card-header small {
        opacity: .8;
    }

    .profile-card-body {
        padding: 30px;
    }

    /* PROFILE TOP */
    .profile-top {
        display: grid;
        grid-template-columns: 290px 1fr;
        gap: 40px;
        align-items: stretch;
    }

    /* PHOTO */
    .profile-photo-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 10px 20px 20px;
        border-right: 1px solid #e8edf4;
    }

    .profile-photo-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin-bottom: 18px;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow:
            0 0 0 2px #0b5cab,
            0 12px 30px rgba(11, 92, 171, .2);
        background: #eef3fa;
    }

    .profile-photo-empty {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e9f0fa, #f5f8fc);
        color: #193a91;
        font-size: 58px;
        border: 5px solid #fff;
        box-shadow:
            0 0 0 2px #0b5cab,
            0 12px 30px rgba(11, 92, 171, .15);
    }

    .photo-upload-button {
        position: absolute;
        right: 2px;
        bottom: 5px;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 4px solid #fff;
        background: #ff8c00;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: .25s ease;
        box-shadow: 0 5px 14px rgba(0,0,0,.16);
    }

    .photo-upload-button:hover {
        transform: scale(1.08);
        background: #e97c00;
    }

    .photo-upload-input {
        display: none;
    }

    .profile-name {
        margin: 0;
        color: #193a91;
        font-size: 21px;
        font-weight: 800;
        text-align: center;
    }

    .profile-role {
        margin-top: 5px;
        color: #74839a;
        font-size: 14px;
        text-align: center;
    }

    .profile-status {
        margin-top: 14px;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #e8f7ef;
        color: #14834b;
        border-radius: 30px;
        padding: 7px 15px;
        font-size: 13px;
        font-weight: 700;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #18a957;
        box-shadow: 0 0 0 4px rgba(24,169,87,.12);
    }

    .photo-help {
        margin-top: 12px;
        color: #8996a9;
        font-size: 11px;
        text-align: center;
    }

    /* DATA */
    .profile-data-section {
        padding: 5px 0;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 22px;
    }

    .section-heading i {
        color: #ff8c00;
        font-size: 20px;
    }

    .section-heading h4 {
        margin: 0;
        color: #193a91;
        font-size: 20px;
        font-weight: 800;
    }

    .data-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .data-item {
        padding: 16px 18px;
        border: 1px solid #e4eaf2;
        border-radius: 12px;
        background: #f9fbfd;
        transition: .25s ease;
    }

    .data-item:hover {
        border-color: #cbd8eb;
        transform: translateY(-2px);
        box-shadow: 0 5px 16px rgba(24,52,93,.05);
    }

    .data-label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #7b899c;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .data-label i {
        color: #0b78d0;
        width: 16px;
        text-align: center;
    }

    .data-value {
        color: #1d2a3a;
        font-size: 15px;
        font-weight: 700;
        word-break: break-word;
    }

    /* DIVIDER */
    .profile-divider {
        height: 1px;
        background: #e8edf3;
        margin: 32px 0;
    }

    /* INFO CARDS */
    .profile-info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
    }

    .info-card {
        position: relative;
        overflow: hidden;
        border: 1px solid #e5eaf1;
        border-radius: 14px;
        padding: 21px;
        background: #fff;
        transition: .25s ease;
    }

    .info-card::after {
        content: "";
        position: absolute;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(11,92,171,.05);
        right: -25px;
        bottom: -30px;
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 9px 22px rgba(24,52,93,.08);
    }

    .info-icon {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #edf5ff;
        color: #0b5cab;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 13px;
        font-size: 17px;
    }

    .info-card.orange .info-icon {
        background: #fff3e3;
        color: #ff8c00;
    }

    .info-card.green .info-icon {
        background: #eaf8f1;
        color: #15945a;
    }

    .info-title {
        color: #7c8a9d;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #193a91;
        font-size: 15px;
        font-weight: 800;
    }

    /* MODAL */
    .profile-modal .modal-content {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,.2);
    }

    .profile-modal .modal-header {
        border: 0;
        padding: 20px 24px;
        background: linear-gradient(135deg, #193a91, #2449a4);
        color: #fff;
    }

    .profile-modal .modal-title {
        font-weight: 800;
    }

    .profile-modal .btn-close {
        filter: brightness(0) invert(1);
    }

    .profile-modal .modal-body {
        padding: 25px;
    }

    .profile-modal .form-label {
        color: #39495d;
        font-weight: 700;
        font-size: 13px;
    }

    .profile-modal .form-control,
    .profile-modal .form-select {
        border: 1px solid #dbe2eb;
        border-radius: 10px;
        padding: 11px 13px;
        min-height: 45px;
    }

    .profile-modal .form-control:focus,
    .profile-modal .form-select:focus {
        border-color: #0b78d0;
        box-shadow: 0 0 0 3px rgba(11,120,208,.1);
    }

    .btn-profile-save {
        border: 0;
        border-radius: 9px;
        background: #0b5cab;
        color: #fff;
        padding: 10px 18px;
        font-weight: 700;
    }

    .btn-profile-save:hover {
        background: #084b8e;
        color: #fff;
    }

    /* TOAST */
    .profile-toast {
        position: fixed;
        right: 25px;
        bottom: 25px;
        z-index: 9999;
        background: #193a91;
        color: #fff;
        padding: 13px 18px;
        border-radius: 11px;
        box-shadow: 0 12px 30px rgba(0,0,0,.2);
        display: flex;
        align-items: center;
        gap: 10px;
        transform: translateY(120px);
        opacity: 0;
        pointer-events: none;
        transition: .35s ease;
    }

    .profile-toast.show {
        transform: translateY(0);
        opacity: 1;
    }

    .profile-toast i {
        color: #55dc93;
    }

    /* RESPONSIVE */
    @media (max-width: 1000px) {
        .profile-top {
            grid-template-columns: 1fr;
        }

        .profile-photo-section {
            border-right: 0;
            border-bottom: 1px solid #e8edf4;
            padding-bottom: 28px;
        }

        .profile-info-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 700px) {
        .petugas-profile {
            padding: 18px 14px 30px;
        }

        .profile-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .profile-title-wrap h1 {
            font-size: 24px;
        }

        .profile-card-body {
            padding: 20px;
        }

        .data-grid,
        .profile-info-grid {
            grid-template-columns: 1fr;
        }

        .profile-card-header {
            padding: 18px 20px;
        }
    }
</style>

<div class="petugas-profile">

    <!-- HEADER -->
    <div class="profile-page-header">

        <div class="profile-title-wrap">
            <div class="profile-title-icon">
                <i class="fas fa-user-cog"></i>
            </div>

            <div>
                <h1>Profil Petugas</h1>
                <p>Kelola informasi profil dan identitas petugas ULT Polban.</p>
            </div>
        </div>

        <button
            type="button"
            class="profile-edit-main-btn"
            data-bs-toggle="modal"
            data-bs-target="#modalEditProfile"
        >
            <i class="fas fa-pen me-2"></i>
            Edit Profil
        </button>

    </div>


    <!-- CARD UTAMA -->
    <div class="profile-main-card">

        <div class="profile-card-header">
            <div>
                <h3>
                    <i class="fas fa-id-card me-2"></i>
                    Informasi Petugas
                </h3>
                <small>Data akun petugas Unit Layanan Terpadu</small>
            </div>

            <i class="fas fa-shield-alt fs-4 opacity-75"></i>
        </div>


        <div class="profile-card-body">

            <div class="profile-top">

                <!-- FOTO -->
                <div class="profile-photo-section">

                    <div class="profile-photo-wrapper">

                        <div id="photoContainer">
                            <div class="profile-photo-empty">
                                <i class="fas fa-user-tie"></i>
                            </div>
                        </div>

                        <label
                            for="photoInput"
                            class="photo-upload-button"
                            title="Ganti foto profil"
                        >
                            <i class="fas fa-camera"></i>
                        </label>

                        <input
                            type="file"
                            id="photoInput"
                            class="photo-upload-input"
                            accept="image/png,image/jpeg,image/jpg,image/webp"
                        >

                    </div>

                    <h2
                        class="profile-name"
                        id="displayName"
                    >
                        <?= esc(session()->get('name') ?? 'Petugas ULT') ?>
                    </h2>

                    <div class="profile-role">
                        <i class="fas fa-user-shield me-1"></i>
                        Petugas ULT Polban
                    </div>

                    <div class="profile-status">
                        <span class="status-dot"></span>
                        Akun Aktif
                    </div>

                    <div class="photo-help">
                        JPG, PNG, atau WEBP · Maks. 2 MB
                    </div>

                </div>


                <!-- DATA UTAMA -->
                <div class="profile-data-section">

                    <div class="section-heading">
                        <i class="fas fa-user-circle"></i>
                        <h4>Data Pribadi</h4>
                    </div>

                    <div class="data-grid">

                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-user"></i>
                                Nama Lengkap
                            </div>

                            <div
                                class="data-value"
                                id="displayNameData"
                            >
                                <?= esc(session()->get('name') ?? 'Petugas ULT') ?>
                            </div>
                        </div>


                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-id-badge"></i>
                                ID Petugas
                            </div>

                            <div
                                class="data-value"
                                id="displayId"
                            >
                                <?= esc(session()->get('user_id') ?? '-') ?>
                            </div>
                        </div>


                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-envelope"></i>
                                Email
                            </div>

                            <div
                                class="data-value"
                                id="displayEmail"
                            >
                                <?= esc(session()->get('email') ?? '-') ?>
                            </div>
                        </div>


                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-phone"></i>
                                Nomor HP
                            </div>

                            <div
                                class="data-value"
                                id="displayPhone"
                            >
                                -
                            </div>
                        </div>


                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-briefcase"></i>
                                Jabatan
                            </div>

                            <div
                                class="data-value"
                                id="displayPosition"
                            >
                                Petugas ULT
                            </div>
                        </div>


                        <div class="data-item">
                            <div class="data-label">
                                <i class="fas fa-building"></i>
                                Unit
                            </div>

                            <div
                                class="data-value"
                                id="displayUnit"
                            >
                                Unit Layanan Terpadu
                            </div>
                        </div>

                    </div>

                </div>

            </div>


            <div class="profile-divider"></div>


            <!-- INFORMASI TAMBAHAN -->
            <div class="section-heading">
                <i class="fas fa-layer-group"></i>
                <h4>Informasi Kepegawaian</h4>
            </div>


            <div class="profile-info-grid">

                <div class="info-card">
                    <div class="info-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>

                    <div class="info-title">
                        Role Sistem
                    </div>

                    <div class="info-value">
                        Petugas ULT
                    </div>
                </div>


                <div class="info-card orange">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>

                    <div class="info-title">
                        Tugas Utama
                    </div>

                    <div class="info-value">
                        Pengelolaan Tiket
                    </div>
                </div>


                <div class="info-card green">
                    <div class="info-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>

                    <div class="info-title">
                        Status Akun
                    </div>

                    <div class="info-value">
                        Aktif
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     MODAL EDIT PROFILE
     ========================================================= -->

<div
    class="modal fade profile-modal"
    id="modalEditProfile"
    tabindex="-1"
    aria-hidden="true"
>
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <div>
                    <h5 class="modal-title">
                        <i class="fas fa-user-edit me-2"></i>
                        Edit Profil Petugas
                    </h5>

                    <small class="opacity-75">
                        Perbarui informasi profil kamu
                    </small>
                </div>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                ></button>

            </div>


            <div class="modal-body">

                <form id="profileEditForm">

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Lengkap
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editName"
                                value="<?= esc(session()->get('name') ?? 'Petugas ULT') ?>"
                                required
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                class="form-control"
                                id="editEmail"
                                value="<?= esc(session()->get('email') ?? '') ?>"
                                required
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                ID Petugas
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= esc(session()->get('user_id') ?? '-') ?>"
                                disabled
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Nomor HP
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editPhone"
                                placeholder="Contoh: 081234567890"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Jabatan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editPosition"
                                value="Petugas ULT"
                            >

                        </div>


                        <div class="col-md-6">

                            <label class="form-label">
                                Unit
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="editUnit"
                                value="Unit Layanan Terpadu"
                            >

                        </div>


                        <div class="col-12">

                            <label class="form-label">
                                Foto Profil
                            </label>

                            <input
                                type="file"
                                class="form-control"
                                id="modalPhotoInput"
                                accept="image/png,image/jpeg,image/jpg,image/webp"
                            >

                        </div>

                    </div>


                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <button
                            type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>

                        <button
                            type="submit"
                            class="btn-profile-save"
                        >
                            <i class="fas fa-save me-2"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>
</div>


<!-- TOAST -->
<div
    class="profile-toast"
    id="profileToast"
>
    <i class="fas fa-check-circle"></i>

    <span id="profileToastText">
        Profil berhasil diperbarui.
    </span>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const STORAGE_KEY = 'si_ult_petugas_profile';

    const editForm = document.getElementById('profileEditForm');

    const photoInput = document.getElementById('photoInput');
    const modalPhotoInput = document.getElementById('modalPhotoInput');

    const photoContainer = document.getElementById('photoContainer');

    const displayName = document.getElementById('displayName');
    const displayNameData = document.getElementById('displayNameData');
    const displayEmail = document.getElementById('displayEmail');
    const displayPhone = document.getElementById('displayPhone');
    const displayPosition = document.getElementById('displayPosition');
    const displayUnit = document.getElementById('displayUnit');

    const editName = document.getElementById('editName');
    const editEmail = document.getElementById('editEmail');
    const editPhone = document.getElementById('editPhone');
    const editPosition = document.getElementById('editPosition');
    const editUnit = document.getElementById('editUnit');

    const toast = document.getElementById('profileToast');
    const toastText = document.getElementById('profileToastText');


    /* =========================================================
       TOAST
       ========================================================= */

    function showToast(message) {

        toastText.textContent = message;

        toast.classList.add('show');

        setTimeout(function () {
            toast.classList.remove('show');
        }, 2800);
    }


    /* =========================================================
       LOAD DATA
       ========================================================= */

    let savedData = {};

    try {
        savedData = JSON.parse(
            localStorage.getItem(STORAGE_KEY) || '{}'
        );
    } catch (error) {
        savedData = {};
    }


    function applySavedData() {

        if (savedData.name) {

            displayName.textContent = savedData.name;
            displayNameData.textContent = savedData.name;
            editName.value = savedData.name;

        }


        if (savedData.email) {

            displayEmail.textContent = savedData.email;
            editEmail.value = savedData.email;

        }


        if (savedData.phone) {

            displayPhone.textContent = savedData.phone;
            editPhone.value = savedData.phone;

        }


        if (savedData.position) {

            displayPosition.textContent = savedData.position;
            editPosition.value = savedData.position;

        }


        if (savedData.unit) {

            displayUnit.textContent = savedData.unit;
            editUnit.value = savedData.unit;

        }


        if (savedData.photo) {
            showPhoto(savedData.photo);
        }

    }


    applySavedData();


    /* =========================================================
       SHOW PHOTO
       ========================================================= */

    function showPhoto(imageSource) {

        photoContainer.innerHTML = '';

        const image = document.createElement('img');

        image.src = imageSource;
        image.className = 'profile-photo';
        image.alt = 'Foto Profil Petugas';

        photoContainer.appendChild(image);

    }


    /* =========================================================
       VALIDATE + READ IMAGE
       ========================================================= */

    function processPhoto(file) {

        if (!file) {
            return;
        }


        const allowedTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/webp'
        ];


        if (!allowedTypes.includes(file.type)) {

            showToast('Format foto harus JPG, PNG, atau WEBP.');

            return;

        }


        if (file.size > 2 * 1024 * 1024) {

            showToast('Ukuran foto maksimal 2 MB.');

            return;

        }


        const reader = new FileReader();


        reader.onload = function (event) {

            const imageSource = event.target.result;

            savedData.photo = imageSource;

            localStorage.setItem(
                STORAGE_KEY,
                JSON.stringify(savedData)
            );

            showPhoto(imageSource);

            showToast('Foto profil berhasil diperbarui.');

        };


        reader.readAsDataURL(file);

    }


    /* =========================================================
       PHOTO INPUT
       ========================================================= */

    photoInput.addEventListener('change', function () {

        processPhoto(this.files[0]);

    });


    modalPhotoInput.addEventListener('change', function () {

        processPhoto(this.files[0]);

    });


    /* =========================================================
       EDIT FORM
       ========================================================= */

    editForm.addEventListener('submit', function (event) {

        event.preventDefault();


        const name = editName.value.trim();
        const email = editEmail.value.trim();
        const phone = editPhone.value.trim();
        const position = editPosition.value.trim();
        const unit = editUnit.value.trim();


        if (!name) {

            showToast('Nama lengkap wajib diisi.');

            editName.focus();

            return;

        }


        if (!email) {

            showToast('Email wajib diisi.');

            editEmail.focus();

            return;

        }


        savedData.name = name;
        savedData.email = email;
        savedData.phone = phone || '-';
        savedData.position = position || 'Petugas ULT';
        savedData.unit = unit || 'Unit Layanan Terpadu';


        localStorage.setItem(
            STORAGE_KEY,
            JSON.stringify(savedData)
        );


        displayName.textContent = name;
        displayNameData.textContent = name;

        displayEmail.textContent = email;
        displayPhone.textContent = phone || '-';
        displayPosition.textContent = position || 'Petugas ULT';
        displayUnit.textContent = unit || 'Unit Layanan Terpadu';


        const modalElement =
            document.getElementById('modalEditProfile');

        const modal =
            bootstrap.Modal.getInstance(modalElement);

        if (modal) {
            modal.hide();
        }


        showToast('Profil berhasil diperbarui.');

    });


    /* =========================================================
       RESET PROFILE
       ========================================================= */

    window.resetPetugasProfile = function () {

        localStorage.removeItem(STORAGE_KEY);

        location.reload();

    };


});
</script>

<?= $this->endSection() ?>