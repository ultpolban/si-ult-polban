# SI-ULT POLBAN

Sistem Informasi Unit Layanan Terpadu (SI-ULT) Politeknik Negeri Bandung merupakan aplikasi berbasis web yang dikembangkan menggunakan CodeIgniter 4 untuk membantu proses pelayanan administrasi secara terintegrasi.

---

## Kelompok

| No  | Nama     | Tugas                                                                                                                  |
| --- | -------- | ---------------------------------------------------------------------------------------------------------------------- |
| 1   | Iqbal    | Backend 1 (Login, Logout, Role & Permission, Manajemen User)                                                            |
| 2   | Anggi    | Backend 2 (Manajemen Layanan, Kategori Layanan, Unit Layanan, Pengajuan Tiket, Upload Dokumen)                         |
| 3   | Febriyan | Backend 3 (Verifikasi Tiket, Disposisi Tiket, Dashboard Backend, Laporan, Statistik, Notifikasi)                       |
| 4   | Aditia   | Frontend 1 (Landing Page, Beranda, Daftar Layanan, Detail Layanan, FAQ, Kontak)                                        |
| 5   | Raffi    | Frontend 2 (Dashboard Pemohon, Form Pengajuan Layanan, Tracking Status Tiket, Profil Pengguna)                         |
| 6   | Alvin    | Frontend 3 (Dashboard Petugas ULT, Dashboard Unit Tujuan, Halaman Verifikasi, Disposisi, Update Status Tiket)          |
| 7   | Rizky    | Frontend 4 (Dashboard Admin, Dashboard Pimpinan, Manajemen User, Manajemen Layanan, Grafik Statistik, Halaman Laporan) |

---

# Teknologi

- PHP 8.2+
- CodeIgniter 4
- MySQL / MariaDB
- Bootstrap 5
- AdminLTE 3
- Composer

---

# Fitur Backend 1

- Login + **Multi-Factor Authentication (MFA / TOTP)**
  - Setup MFA saat registrasi
  - Verifikasi kode TOTP (Google Authenticator, dll) saat login
  - Dukungan kode pemulihan (recovery code) sekali pakai
- Logout (mencatat aksi login & logout ke Activity Log)
- Dashboard berdasarkan Role
- Role Management
- Permission Dasar
- CRUD User (tambah user hanya melalui Manajemen User oleh admin)
- Session Login
- Validasi Form
- Flash Message

---

# Role Pengguna

| Role         | Hak Akses                             |
| ------------ | ------------------------------------- |
| Admin        | Mengelola seluruh pengguna dan sistem |
| Petugas ULT  | Mengelola layanan                     |
| Unit Layanan | Menindaklanjuti layanan               |
| Pemohon      | Mengajukan layanan                    |
| Pimpinan     | Melihat laporan                       |

---

# Struktur Project

```
si-ult-polban/
│
├── app
│   ├── Config
│   │   ├── Routes.php            # Definisi seluruh route aplikasi
│   │   ├── Services.php          # Registrasi service (dependency)
│   │   ├── Filters.php           # Konfigurasi filter (auth, role, dll)
│   │   └── ...
│   │
│   ├── Controllers
│   │   ├── Auth                 # AuthController, RegisterController (login & MFA)
│   │   ├── Dashboard            # DashboardController
│   │   ├── Management           # User, Role, Permission
│   │   ├── Master               # Department, StudyProgram, Class, ApplicantType,
│   │   │                        # ServiceUnit, ServiceCategory, Service, dsb.
│   │   ├── ServiceRequestController.php
│   │   ├── TicketController.php
│   │   ├── ActivityLogController.php
│   │   ├── NotificationController.php
│   │   └── ...
│   │
│   ├── Services                 # Lapisan bisnis logic
│   │   ├── AuthService.php
│   │   ├── MfaService.php       # TOTP MFA (setup, verifikasi, recovery code)
│   │   ├── ActivityLogService.php
│   │   └── ...
│   │
│   ├── Models
│   │   ├── UserModel.php
│   │   ├── ActivityLogModel.php
│   │   ├── Master*Model.php
│   │   └── ...
│   │
│   ├── Libraries
│   │   └── TOTP.php             # Implementasi RFC 6238 (pure PHP)
│   │
│   ├── Filters
│   │   ├── AuthFilter.php
│   │   └── RoleFilter.php
│   │
│   ├── Constants
│   │   └── Permissions.php
│   │
│   ├── Views
│   │   ├── auth                 # login, login_mfa (MFA), register, register_mfa
│   │   ├── layouts              # main, sidebar, navbar, footer, dll
│   │   ├── activity-logs        # daftar & detail activity log
│   │   ├── management
│   │   ├── master
│   │   └── ...
│   │
│   └── Database
│       ├── Migrations           # Skema database (termasuk kolom MFA di users)
│       └── Seeds                # Data awal (roles, permissions, academic, dll)
│
├── public                       # Entry point & aset (css/js/img)
│
├── tests                        # Unit / feature test
├── writable                     # Cache, log, session, upload
├── composer.json
├── spark                        # CLI CodeIgniter
└── README.md
```

> Catatan: `app/Libraries` hanya berisi kelas utilitas murni (contoh `TOTP.php`). Seluruh logika bisnis diletakkan di `app/Services`, controller di `app/Controllers`, dan query data di `app/Models`.

---

# Cara Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/nama-organisasi/si-ult-polban.git
```

Masuk ke folder project

```bash
cd si-ult-polban
```

---

## 2. Install Dependency

```bash
composer install
```

---

## 3. Copy File Environment

Windows

```bash
copy env .env
```

Linux / MacOS

```bash
cp env .env
```

---

## 4. Konfigurasi Database

Edit file `.env`

```ini
database.default.hostname = localhost
database.default.database = si_ult_polban
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

## 5. Jalankan Migration

```bash
php spark migrate
```

---

## 6. Jalankan Seeder

Jalankan seluruh seeder sekaligus (role, permission, data akademik, layanan, dan admin default):

```bash
php spark db:seed DatabaseSeeder
```

Atau jalankan seeder per modul:

```bash
php spark db:seed RoleSeeder
php spark db:seed PermissionSeeder
php spark db:seed RolePermissionSeeder
php spark db:seed ApplicantTypeSeeder
php spark db:seed DepartmentSeeder
php spark db:seed StudyProgramSeeder
php spark db:seed ClassSeeder
php spark db:seed ServiceUnitSeeder
php spark db:seed ServiceCategorySeeder
php spark db:seed ServiceSeeder
php spark db:seed ServiceRequirementSeeder
php spark db:seed AdminSeeder
```

---

## 7. Jalankan Server

```bash
php spark serve
```

Buka browser

```
http://localhost:8080
```

---

# Login Default

## Super Administrator

Email

```
superadmin@polban.ac.id
```

Password

```
admin123
```

> Jika Anda menggunakan data seed yang berbeda, sesuaikan email dan password di atas.

---

# Database

Tabel utama

- users
- roles

Relasi

```
roles.id
      │
      ▼
users.role_id
```

---

# Modul Backend 1

- Login
- Logout
- Dashboard
- CRUD User
- Role
- Permission
- Session
- Validasi

---

# Kontributor

Backend 1

- (Nama Anda)

Backend 2

- ...

Backend 3

- ...

Frontend

- ...

---

# Lisensi

Project ini dibuat untuk memenuhi tugas mata kuliah **Pemrograman Web / Proyek SI-ULT POLBAN** di Politeknik Negeri Bandung.
