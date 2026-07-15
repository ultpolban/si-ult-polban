# SI-ULT POLBAN

Sistem Informasi Unit Layanan Terpadu (SI-ULT) Politeknik Negeri Bandung merupakan aplikasi berbasis web yang dikembangkan menggunakan CodeIgniter 4 untuk membantu proses pelayanan administrasi secara terintegrasi.

---

## Kelompok

| No | Nama | Tugas |
|----|------|-------|
| 1 | Iqbal | Backend 1 (Login, Logout, Registrasi, Role & Permission, Manajemen User) |
| 2 | Anggi | Backend 2 (Manajemen Layanan, Kategori Layanan, Unit Kerja, Pengajuan Tiket, Upload Dokumen) |
| 3 | Febriyan | Backend 3 (Verifikasi Tiket, Disposisi Tiket, Dashboard Backend, Laporan, Statistik, Notifikasi) |
| 4 | Aditia | Frontend 1 (Landing Page, Beranda, Daftar Layanan, Detail Layanan, FAQ, Kontak) |
| 5 | Raffi | Frontend 2 (Dashboard Pemohon, Form Pengajuan Layanan, Tracking Status Tiket, Profil Pengguna) |
| 6 | Alvin | Frontend 3 (Dashboard Petugas ULT, Dashboard Unit Tujuan, Halaman Verifikasi, Disposisi, Update Status Tiket) |
| 7 | Rizky | Frontend 4 (Dashboard Admin, Dashboard Pimpinan, Manajemen User, Manajemen Layanan, Grafik Statistik, Halaman Laporan) |

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

- Login
- Logout
- Registrasi
- Dashboard berdasarkan Role
- Role Management
- Permission Dasar
- CRUD User
- Session Login
- Validasi Form
- Flash Message

---

# Role Pengguna

| Role | Hak Akses |
|------|-----------|
| Admin | Mengelola seluruh pengguna dan sistem |
| Petugas ULT | Mengelola layanan |
| Unit Kerja | Menindaklanjuti layanan |
| Pemohon | Mengajukan layanan |
| Pimpinan | Melihat laporan |

---

# Struktur Project

```
app
│
├── Controllers
│   ├── AuthController.php
│   ├── DashboardController.php
│   └── UserController.php
│
├── Models
│   ├── UserModel.php
│   └── RoleModel.php
│
├── Filters
│   ├── AuthFilter.php
│   └── RoleFilter.php
│
├── Views
│   ├── auth
│   ├── dashboard
│   ├── users
│   └── layouts
│
└── Database
    ├── Migrations
    └── Seeds
```

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

```bash
php spark db:seed RoleSeeder
php spark db:seed UserSeeder
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

## Admin

Email

```
admin@ultpolban.ac.id
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
- Registrasi
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
