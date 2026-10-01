# Integrasi Branch ke `main`

Dokumen ini merangkum hasil integrasi kode dari branch
`backend1`, `backend2`, `backend3`, `frontend1`, `frontend2`,
`frontend3`, `frontend4`, dan `integrasi-frontend3` ke dalam
`main`.

## Ringkasan

| Item | Nilai |
| --- | --- |
| Rute bawaan `main` (diprioritaskan) | 80 |
| Rute tambahan hasil integrasi | 449 |
| Total rute terdaftar (`php spark routes`) | 529 |
| Handler rute yang tidak tersedia | 0 |
| Class controller gagal dimuat | 0 |
| Rute yang dibuang (tidak bisa dilayani) | 23 |

## Perubahan pada `app/Config/Routes.php`

Blok rute baru disisipkan **setelah** seluruh rute milik `main`
sehingga ruta `main` tetap menang bila ada path yang sama. Blok
tersebut juga equipping filter `auth`/`role`/`permission` yang
sudah dinormalisasi, sedangkan filter global (`ratelimit`,
`securityheaders`) tidak diulang karena ditangani
`Config\Filters::$globals`.

## Penyelesaian konflik

* `BaseController::success()/error()` diubah menjadi
  `jsonSuccess()/jsonError()` supaya tidak bentrok dengan action
  controller frontend.
* File miring PSR-4 dihapus: `app/Controllers/PetugasUnit.php`,
  `app/Controllers/UserProfileModel.php`, dan
  `app/Models/kademikTicketModel.php` (duikat case-variant).
* `Auth\AuthController` (versi `main`) ditambahkan
  `mfaSetup()` dan `verifyMfaSetup()` dari `frontend3` agar rute
  `petugas/mfa` tetap hidup.
* `NotificationController::index()` ditambahkan pada versi
  `main` (JSON API `read`/`readAll` tetap dipertahankan) agar
  rute daftar notifikasi tetap hidup.
* `Perpustakaan::riwayat()` diarahkan ke view
  `perpustakaan/data_tiket` karena `perpustakaan/riwayat`
  tidak ada di branch mana pun.
* View `app/Views/services/index.php` dibuat karena rute publik
  `services` (`ServiceController::index`) tidak punya view di
  branch mana pun.

## Rute yang dibuang

Rute berikut tidak diinjeksi karena handler-nya tidak ada di
ref mana pun, atau hanya ada sebagai stub/versi yang sudah
digantikan oleh implementasi `main` yang lebih lengkap.

| Method | Path | Handler | Alasan |
| --- | --- | --- | --- |
| GET | `admin` | `AdminController::index` | hanya stub 10 baris di `frontend3` |
| GET | `orangtua/help` | `OrangTuaHelpController::index` | class tidak ada di semua ref |
| GET | `pimpinan` | `PimpinanController::index` | class tidak ada di semua ref |
| GET/POST | `petugas/detail-tamu/(:num)` | `PetugasController::detail_tamu` | method tidak ada di semua ref |
| GET/POST | `petugas/edit-tamu/(:num)` | `PetugasController::edit_tamu` | method tidak ada di semua ref |
| GET/POST | `petugas/delete-tamu/(:num)` | `PetugasController::delete_tamu` | method tidak ada di semua ref |
| GET | `petugas/verifikasi-tamu/(:num)` | `PetugasController::verifikasi_tamu` | method tidak ada di semua ref |
| GET | `petugas/disposisi-tamu/(:num)` | `PetugasController::disposisi_tamu` | method tidak ada di semua ref |
| GET | `petugas/laporan/export/{csv,excel,pdf}` | `PetugasController::export*` | method tidak ada di semua ref |
| GET | `reports/export` | `ReportController::export` | digantikan `csv/excel/pdf` versi `main` |
| GET | `tracking/track` | `TrackingController::track` | digantikan `search` versi `main` |
| GET | `tracking/show/(:num)` | `TrackingController::show` | digantikan `detail` versi `main` |
| GET | `verifications/show/(:num)` | `VerificationController::show` | digantikan `detail` versi `main` |
| GET/POST | `unit/dashboard`, `unit/detail/(:num)`, `unit/update-status/(:num)` | `UnitController::*` | hanya stub 20 baris di `frontend3`; `main` punya `index/process/complete` |
| POST | `register/gate` | `Auth\RegisterController::gate` | alur registrasi `main` berbeda |
| POST | `master/service-requirements/change-status/(:num)` | `Master\ServiceRequirementController::changeStatus` | method tidak ada di semua ref |
| POST | `users/delete/(:num)` | `Management\UserController::delete` | method tidak ada di semua ref |

## Catatan

* `php spark routes` → 529 rute, tanpa error.
* `php spark migrate:status` gagal hanya karena MySQL tidak
  berjalan di mesin ini (*connection refused*), bukan karena
  kode.
* Dua view yang masih hilang berasal dari `main` sendiri
  (`DashboardController::petugas/statistik` dan
  `OnlineController::online/*`); keduanya di luar cakupan
  integrasi branch.
