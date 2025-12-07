MEDIATAMA - Video Access Management System (VAMS)

Sistem manajemen akses video berbasis **Laravel 12** yang memungkinkan:
- Customer melakukan request akses video
- Admin dapat menyetujui / menolak permintaan akses
- Admin mengatur durasi akses video (1 jam, 6 jam, 24 jam, manual)
- Sistem countdown timer otomatis
- Video berhenti otomatis ketika waktu akses habis
- Riwayat request akses
- Dashboard Chart statistik permintaan
- Cron job auto-expired

---

## 🏗Teknologi yang digunakan
| Komponen | Versi |
|---------|-------|
| Laravel Framework | 12.x |
| PHP | 8.2 |
| SQLite / MySQL | Optional |
| Bootstrap 5 & Tailwind | UI |
| Flowbite | UI Components |
| Chart.js | Dashboard Chart |
| Cron Scheduler | Laravel Task |

---

##  Instalasi Project

```bash
git clone <repository-url>
cd mediatama-vams
composer install
npm install
cp .env.example .env
php artisan key:generate
🛢 Konfigurasi Database
Edit file .env :

env
Copy code
DB_CONNECTION=sqlite
# atau gunakan MySQL
Jika menggunakan SQLite:

bash
Copy code
touch database/database.sqlite
Lalu migrasi database:

bash
Copy code
php artisan migrate --seed
Seeder otomatis menambahkan:

Role	Username	Password
Admin	admin@mail.com	password
Customer	user@mail.com	password

▶ Menjalankan Aplikasi
bash
Copy code
php artisan serve
Akses:

cpp
Copy code
http://127.0.0.1:8000
 Role & Hak Akses
Role	Fitur
Admin	Approve & Reject akses video, CRUD video, lihat customer, hapus customer, dashboard
Customer	Request akses video, menonton video sampai expired, melihat history

 Cron Job Auto Expire
Untuk menjalankan pengecekan akses:

bash
Copy code
php artisan video:check-expiration
Scheduler (Laravel 12):

php
Copy code
// app/bootstrap/app.php
use Illuminate\Support\Facades\Schedule;

Schedule::command('video:check-expiration')->everyMinute();
Jika menggunakan server lokal:

bash
Copy code
php artisan schedule:work
 Struktur Direktori Penting
swift
Copy code
app/
 ├── Console/Commands/VideoExpirationCommand.php
 ├── Http/Controllers/Admin
 ├── Http/Controllers/Customer
 ├── Models/Video.php
 ├── Models/VideoAccess.php

resources/views/
 ├── admin/
 ├── customer/
 ├── layouts/
 Fitur UI
Popup alert approve/reject

Countdown real-time

Video auto stop saat expired

Dashboard Chart statistik

Table request + expired time

 Command Penting
bash
Copy code
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan schedule:work
