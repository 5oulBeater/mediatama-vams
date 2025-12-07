# MEDIATAMA - Video Access Management System (VAMS)

VAMS adalah sistem manajemen akses video berbasis **Laravel 12** yang dirancang untuk mengatur permintaan akses video dari customer.  
Admin dapat mengelola video, menyetujui permintaan akses, menentukan durasi akses, dan memonitor aktivitas pengguna.

---

##  Fitur Utama

###  Customer
- Melihat daftar video
- Mengajukan request akses video
- Menonton video jika sudah disetujui admin
- Akses otomatis ditutup jika waktu habis (countdown)
- Melihat status permintaan

###  Admin
- Approve / Reject permintaan akses
- Menentukan durasi akses (1 jam, 6 jam, 24 jam, custom)
- CRUD Video
- CRUD Customer
- Melihat riwayat permintaan akses
- Dashboard statistik (Chart.js)
- Auto-expired via cron job

---

##  Teknologi yang Digunakan

| Komponen | Versi / Keterangan |
|---------|---------------------|
| **Laravel** | 12.x |
| **PHP** | 8.2 |
| **MySQL / SQLite** | Database |
| **Bootstrap 5** | UI |
| **Tailwind + Flowbite** | UI Components |
| **Chart.js** | Dashboard chart |
| **Cron Scheduler** | Auto-expired |

---

##  Instalasi Project

```bash
git clone <repository-url>
cd mediatama-vams
composer install
npm install
cp .env.example .env
php artisan key:generate
```

###  Konfigurasi Database (.env)

Menggunakan SQLite:

```env
DB_CONNECTION=sqlite
```

Buat file database:

```bash
mkdir database
touch database/database.sqlite
```

Atau MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mediatama
DB_USERNAME=root
DB_PASSWORD=
```

###  Migrasi dan Seeder

```bash
php artisan migrate --seed
```

Seeder otomatis menambahkan akun:

| Role | Email | Password |
|------|--------|-----------|
| Admin | admin@mail.com | password |
| Customer | user@mail.com | password |

---

##  Menjalankan Aplikasi

```bash
php artisan serve
npm run dev
```

Akses aplikasi:

```
http://127.0.0.1:8000
```

---

##  Role & Hak Akses

### Admin
- Approve / Reject request video  
- CRUD video  
- CRUD customer  
- Dashboard statistik  
- Kelola durasi akses  

### Customer
- Request akses video  
- Menonton video (selama belum expired)  
- Melihat status permintaan  

---

## ⏱ Cron Job Auto Expired

Command manual:

```bash
php artisan video:check-expiration
```

Scheduler Laravel 12:

```php
use Illuminate\Support\Facades\Schedule;

Schedule::command('video:check-expiration')->everyMinute();
```

Jalankan scheduler lokal:

```bash
php artisan schedule:work
```

---

##  Struktur Direktori Penting

```
app/
 ├── Console/Commands/VideoExpirationCommand.php
 ├── Http/Controllers/Admin/
 ├── Http/Controllers/Customer/
 ├── Models/Video.php
 ├── Models/VideoRequest.php

resources/views/
 ├── admin/
 ├── customer/
 ├── layouts/
```

---

##  Fitur UI
- Popup alert untuk approve/reject  
- Countdown real-time pada halaman video  
- Video otomatis berhenti jika expired  
- Dashboard chart statistik request  
- Tabel status permintaan lengkap  

---

##  Command Penting

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan schedule:work
```

---

##  Catatan
Project ini dikembangkan sebagai bahan technical test untuk posisi Web Developer.

