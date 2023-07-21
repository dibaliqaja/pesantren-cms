<!-- [in English README](https://github.com) 🇬🇧 👈 SOON -->

<h1 align="center">
  <img src="https://raw.githubusercontent.com/dibaliqaja/pesantren-cms/master/public/assets/img/ponpes.svg" width="130px"/><br/>
  Pesantren CMS
</h1>
<p align="center">Sistem Manajemen Pondok Pesantren</p>

<p align="center">
    <a href="https://github.com/dibaliqaja/pesantren-cms/actions/workflows/laravel.yml" target="_blank">
        <img src="https://img.shields.io/badge/actions-passing-success?style=for-the-badge&logo=github-actions" alt="github actions" />
    </a>
    &nbsp;
    <a href="https://github.com/dibaliqaja/pesantren-cms/releases" target="_blank">
        <img src="https://img.shields.io/badge/version-v1.0.0-red?style=for-the-badge&logo=none" alt="system version" />
    </a>
    &nbsp;
    <a href="https://github.com/dibaliqaja/pesantren-cms" target="_blank">
        <img src="https://img.shields.io/badge/Laravel-v10.9.0-fb503b?style=for-the-badge&logo=laravel" alt="laravel version" />
    </a>
    &nbsp;
    <img src="https://img.shields.io/badge/license-mit-red?style=for-the-badge&logo=none" alt="license" />
</p>

### Fitur
- Admin Panel
  - Autentikasi Administrator dan Pengurus
  - Manajamen Data Santri
  - Manajemen Data Pengguna Sistem
  - Manajemen Biaya Pembayaran Pesantren
  - Manajemen Biaya Pembayaran Pendaftaran Santri
  - Manajemen Biaya Pembayaran Syahriah (SPP) Santri
  - Buku Kas Pesantren
  - Manajemen Surat Masuk dan Surat Keluar
  - Log Aktivitas Pengguna Sistem
- API
  - Autentikasi Santri
  - Buku Kas
  - Ubah Password
  - Edit Profil Santri
  - Histori Pembayaran Syahriah (SPP) Santri

Catatan: <i>Role</i> Pengguna yang terdaftar pada aplikasi: <b>Administrator, Pengurus, Santri</b>

### ⚙️ PHP 8.1
- PesantrenCMS membutuhkan versi PHP minimal 8.1.

### ⚡️ Instalasi
1. Kloning repo ini dengan menjalankan perintah berikut pada terminal
```bash
git clone https://github.com/dibaliqaja/pesantren-cms.git
```
2. Setelah proses kloning repo selesai, pindah ke direktori aplikasi
```bash
cd pesantren-cms
```
3. Install Composer <i>dependencies</i>
```bash
composer install
```
4. Install NPM <i>dependencies</i>
```bash
npm install
```
5. Buat salinan file `.env`
```bash
cp .env.example .env
```
6. Enkripsi aplikasi dengan perintah berikut
```bash
php artisan key:generate
```
7. Buat basis data untuk aplikasi

8. Di dalam <i>file</i> `.env`, sesuaikan informasi basis data yang sudah dibuat
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database-name}
DB_USERNAME={username-database}
DB_PASSWORD={password-database}
```
9. Migrasi basis data
```bash
php artisan migrate
```
10. Membuat tautan simbolis dari `public/storage` ke `storage/app/public`
```bash
php artisan storage:link
```
12. <i>Seed</i> basis data
```bash
php artisan db:seed
```
12. Menjalankan aplikasi
```bash
php artisan serve
```

Catatan:
- Tambahkan `jwt secret` untuk API
```bash
php artisan jwt:secret
```

Untuk melihat implementasi API dapat dilihat pada repositori berikut
> https://github.com/dibaliqaja/pesantren-app

### Kredensial Pengguna yang ada pada Seeder
| #        | Administrator    | Pengurus            | Santri              |
| -------- | ---------------- | ------------------- | ------------------- |
| Email    | admin@ponpes.com | pengurus@ponpes.com | santri@ponpes.com |
| Password | password         | password            | password            |

## Lisensi

Proyek ini dilisensikan di bawah lisensi [MIT](https://opensource.org/licenses/MIT).
