## SIGEMA – Platform Analitik & Pengelompokan Data (Clustering)

Aplikasi web berbasis Laravel untuk mengelompokkan data (unsupervised clustering) dari dataset variabel/respon. Mendukung impor data, prapemrosesan (inisialisasi dan penskalaan), eksekusi proses clustering, visualisasi ringkas hasil, serta ekspor laporan PDF. Disertai autentikasi pengguna, kontrol akses admin, audit log, dan panduan penggunaan dalam Bahasa Indonesia.

### Fitur Utama
- **Manajemen Dataset**: Impor data dari Excel/CSV, kelola variabel dan nilai.
- **Proses Clustering**: Inisialisasi, penskalaan/normalisasi, eksekusi proses, dan ringkasan hasil.
- **Laporan**: Tampilkan hasil di UI dan ekspor ke PDF.
- **Manajemen Pengguna**: Registrasi/login, profil, dan middleware `IsAdmin` untuk kontrol akses.
- **Audit Log**: Pencatatan aktivitas penting.
- **UI/UX**: Blade templates, DataTables, Toastr untuk feedback notifikasi.

### Teknologi
- **Backend**: Laravel (PHP), MVC, Middleware
- **Frontend**: Blade Templates, DataTables, Toastr
- **Autentikasi**: Laravel Auth
- **Dokumen/Laporan**: Blade PDF view (`resources/views/clustering/pdf.blade.php`)
- **Lingkungan**: Kompatibel dengan Laragon (Windows), MySQL/MariaDB

---

## Prasyarat
- PHP 7.4+ atau 8.x
- Composer 2.x
- MySQL/MariaDB
- Git
- Laragon (opsional, direkomendasikan untuk Windows)

---

## Cara Menjalankan (Local)

### 1) Clone repo
```bash
git clone <repo-url> SIGEMA
cd SIGEMA
```

### 2) Instal dependensi
```bash
composer install
```

### 3) Konfigurasi environment
- Duplikasi `.env.example` menjadi `.env`
- Atur koneksi database:
```env
APP_NAME=SIGEMA
APP_ENV=local
APP_KEY=
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=client_qnsi
DB_USERNAME=root
DB_PASSWORD=
```

### 4) Generate app key
```bash
php artisan key:generate
```

### 5) Siapkan database
- Buat database `client_qnsi` (atau sesuai nama di `.env`)
- Jalankan migrasi (dan seeder jika tersedia)
```bash
php artisan migrate
```

### 6) Jalankan server
```bash
php artisan serve
```
Akses aplikasi di `http://127.0.0.1:8000` atau sesuai `APP_URL`.

---

## Alur Penggunaan

1. **Autentikasi**
   - Buat akun melalui halaman `register` (`resources/views/auth/register.blade.php`)
   - Login melalui halaman `login` (`resources/views/auth/login.blade.php`)
   - Untuk akses admin, tandai user sebagai admin di DB (mengacu ke middleware `IsAdmin`)

2. **Kelola Variabel & Dataset**
   - Tambah variabel di menu Variabel (`resources/views/variabel/index.blade.php`)
   - Impor dataset (Excel/CSV) via menu Clustering
   - Lihat data di DataTables

3. **Proses Clustering**
   - Jalankan inisialisasi: `clustering/inisialisasi` (lihat `inisialisasi.blade.php`)
   - Lakukan penskalaan/normalisasi: `clustering/scale` (`scale.blade.php`)
   - Eksekusi proses dan lihat hasil ringkas: `hasilProses.blade.php` / `results.blade.php`
   - Ekspor hasil ke PDF: `pdf.blade.php`

4. **Audit & Panduan**
   - Cek log aktivitas: `resources/views/log/index.blade.php`
   - Baca panduan: `resources/views/panduan/index.blade.php`

---

## Struktur Direktori (ringkas)
- `app/Http/Controllers/ClusteringController.php`: Orkestrasi proses clustering
- `app/Imports/*`: Logika impor dataset (Excel/CSV)
- `app/Models/*`: Model Eloquent (`Dataset`, `Variabel`, `Pengelompokan`, dst.)
- `resources/views/clustering/*`: Halaman clustering (inisialisasi, scale, hasil, PDF)
- `resources/views/user/*`: Profil & manajemen pengguna
- `routes/web.php`: Definisi rute aplikasi
- `app/Http/Middleware/IsAdmin.php`: Pembatasan akses admin

---

## Kontribusi
- Fork repo, buat branch fitur: `feat/nama-fitur`
- Lakukan edits terpisah dan ringkas
- Ajukan Pull Request dengan deskripsi perubahan

---

## Troubleshooting
- Error koneksi DB: pastikan `.env` sesuai, DB berjalan, dan user memiliki akses
- 500/Key error: jalankan `php artisan key:generate`
- Cache config: 
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

---

## Lisensi
Tentukan lisensi proyek (mis. MIT). Tambahkan berkas `LICENSE` jika belum ada.

---

## Kontak
- Buat issue di tab Issues repo ini
- Atau hubungi melalui profil LinkedIn yang tertera di deskripsi proyek


