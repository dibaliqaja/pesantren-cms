<h1 align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="224px"/><br/>
  Pesantren CMS
</h1>
<p align="center">Pesantren CMS is Management System for <i>Pondok Pesantren</i></p>

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
        <img src="https://img.shields.io/badge/Laravel-9.11.0-fb503b?style=for-the-badge&logo=laravel" alt="laravel version" />
    </a>
    &nbsp;
    <img src="https://img.shields.io/badge/license-mit-red?style=for-the-badge&logo=none" alt="license" />
</p>

### Features
- Admin Panel
  - Login
  - Logout
  - Manajamen Data Santri
  - Manajemen Data Pengguna Sistem
  - Manajemen Biaya Pembayaran Pesantren
  - Manajemen Biaya Pembayaran Pendaftaran Santri
  - Manajemen Biaya Pembayaran Syahriah (SPP) Santri
  - Buku Kas Pesantren
  - Manajemen Surat Masuk dan Surat Keluar
  - Log Aktivitas Pengguna Sistem
- API
  - Login
  - Logout
  - Buku Kas
  - Ubah Password
  - Update Profil
  - Histori Pembayaran Syahriah (SPP)

Note: User Role is <b>Administrator, Pengurus, Santri</b>

### ⚙️ Requirements
- PHP >= 8.0
- BCMath PHP Extension
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

### ⚡️ Installation
1. Clone GitHub repo for this project locally
```bash
git clone https://github.com/dibaliqaja/pesantren-cms.git
```
2. Change directory in project which already clone
```bash
cd pesantren-cms
```
3. Install Composer dependencies
```bash
composer install
```
4. Install NPM dependencies
```bash
npm install
```
5. Create a copy of your .env file
```bash
cp .env.example .env
```
6. Generate an app encryption key
```bash
php artisan key:generate
```
7. Create an empty database for our application

8. In the .env file, add database information to allow Laravel to connect to the database
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={database-name}
DB_USERNAME={username-database}
DB_PASSWORD={password-database}
```
9. Migrate the database
```bash
php artisan migrate
```
10. Create a symbolic link from public/storage to storage/app/public
```bash
php artisan storage:link
```
12. Seed the database
```bash
php artisan db:seed
```
12. Running project
```bash
php artisan serve
```

### User Credentials in Seeder
| #        | Administrator    | Pengurus            | Santri              |
| -------- | ---------------- | ------------------- | ------------------- |
| Email    | admin@ponpes.com | pengurus@ponpes.com | pengurus@ponpes.com |
| Password | password         | password            | password            |

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
