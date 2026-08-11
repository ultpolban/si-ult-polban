# TODO - Penyelesaian Proyek SI-ULT POLBAN

## Fase 1 - Perbaiki Fondasi (agar aplikasi bisa berjalan)

- [x] Buat `NotificationService` dan `ActivityLogService`
- [x] Perbaiki `Routes.php`: daftarkan route `master/*`, users, roles, permissions, role-permissions, service-requests, verifications, notifications, activity-logs, profile
- [x] Perbaiki path view di controller (`master/departments` → `master/department`)
- [x] Perbaiki `layouts/main.php` (buat partial `breadcrumb` & `scripts`)
- [x] Perbaiki `DashboardController` (gunakan `MasterServiceModel`)
- [x] Perbaiki database mismatch (tambah kolom `module, sort_order, is_active` di permissions, `sort_order` di roles)
- [x] Tambah `withProfile()` & `findByUsernameOrEmail()` di `UserModel`
- [x] Tambah `notificationCount` & `hasPermission` di `AdminController`/`PermissionService`
- [x] Sejajarkan `ActivityLogService::storeLog()` dengan param `description`

## Fase 2 - Modul Pengajuan Layanan (Service Request)

- [x] Buat `ServiceRequestController`, `ServiceRequestService`
- [x] Buat view `service-requests/*` (index, create, show, edit)
- [x] Daftarkan route `service-requests/*`

## Fase 3 - Modul Notifikasi & Activity Log

- [x] Buat `NotificationController` + view (index)
- [x] Buat `ActivityLogController` + view (index, show)

## Fase 4 - Perbaiki Sidebar & Profil

- [x] Perbaiki link sidebar agar sesuai route
- [x] Buat `ProfileController` + route `profile`

## Fase 5 - Verifikasi

- [x] Buat `VerificationController` + view (index, show)

## Fase 6 - Registrasi Berdasarkan Jenis Pemohon

- [x] Buat `Auth\RegisterController` + route `register` (GET/POST)
- [x] Buat view `auth/register` dengan pilihan jenis pemohon & form dinamis per jenis
- [x] Simpan ke `users` (role PEMOHON) + `user_profiles` (jenis pemohon + detail)
- [x] Form dinamis: Mahasiswa (NIM, prodi, kelas), Calon Mahasiswa (no.pendaftaran), Alumni (NIM), Dosen (NIP), Tendik (NIP), Mitra (perusahaan), Instansi (nama instansi), Umum (NIK)
- [x] Tambah link "Daftar sebagai Pemohon" di halaman login

## Fase 7 - User Management dengan Jenis Pemohon

- [x] Update `UserController` (create/edit/index/show) load jenis pemohon, prodi, kelas
- [x] Update `users/create.php` & `edit.php`: pilih role → jika Pemohon tampil pilihan jenis pemohon → form dinamis
- [x] Update `UserService::store/update` menyimpan ke `users` + `user_profiles`
- [x] Update `users/show.php` menampilkan jenis pemohon & detail

## Fase 8 - Sistem Tiket Lengkap (Tracking, Laporan, Statistik)

- [x] Buat `TrackingController` + view (cek status tiket publik + daftar tiket saya)
- [x] Buat `ReportController` + view (filter status, unit, jenis pemohon, tanggal + export CSV)
- [x] Buat `StatisticController` + view (grafik per status, unit, jenis pemohon, bulan)
- [x] Update `sidebar.php` tambah menu Tiket (Tracking, Laporan, Statistik)
- [x] Tambah route baru untuk modul tiket
- [x] Buat `TicketService` (tracking, report, statistic, summary, history)

## Fase 9 - Integrasi & Finalisasi

- [x] Tambah permission baru untuk modul tiket di `Permissions.php` + seeder
- [x] Perbaiki seeder agar idempotent (truncate semua tabel sebelum seeding)
- [x] Update `README.md` dengan kredensial & setup
- [x] Perbaiki register page (tambahkan `applicantCode` & `applicantType` di `RegisterController::index()`) → halaman `/register` HTTP 200
- [x] Verifikasi menu Tiket (Tracking, Laporan, Statistik) muncul di sidebar setelah login superadmin
- [x] Tes semua halaman tiket (tracking, reports, statistics, tracking/track) → semua HTTP 200
- [x] Tes semua halaman (login superadmin → semua route HTTP 200)
