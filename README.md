 # Website Berita

Project Laravel untuk aplikasi berita/podcast dengan area admin dan pengalaman publik. Dokumentasi ini berisi panduan setup, eksekusi lokal, dan alur kerja tim GitHub.

## Alur kerja tim

`Fork → Clone → Buat branch → Kerjakan perubahan → Commit → Push → Pull Request → Review → Merge`

## 1. Fork repository

Fork digunakan untuk membuat salinan repository utama ke akun GitHub milik Anda sendiri.

1. Buka repository utama di GitHub.
2. Klik tombol Fork di pojok kanan atas.
3. Pilih akun atau organisasi tujuan.
4. Klik Create fork.

Setelah selesai, repository akan tersedia di akun Anda dengan format seperti:
`https://github.com/username-kamu/website-berita`

## 2. Clone repository hasil fork

```bash
git clone https://github.com/username-kamu/website-berita.git
cd website-berita
```

Buat branch kerja baru:

```bash
git checkout -b fitur/nama-fitur
```

Pastikan tidak mengerjakan langsung di branch main.

## 3. Push ke repository fork sendiri

Setelah perubahan selesai:

```bash
git add .
git commit -m "Jelaskan perubahan yang dibuat"
git push -u origin fitur/nama-fitur
```

`origin` pada langkah ini merujuk ke repository fork milik Anda sendiri.

## 4. Membuat Pull Request

1. Buka repository fork di GitHub.
2. Klik Compare & pull request.
3. Pastikan tujuan pull request benar:
   - base repository: repository utama
   - base branch: main
   - head repository: repository fork Anda
   - compare branch: branch kerja Anda
4. Isi judul dan deskripsi perubahan.
5. Klik Create pull request.

Jika reviewer meminta revisi, lakukan perubahan di branch yang sama, lalu push ulang. Pull Request akan otomatis diperbarui.

## Aturan kerja tim

- Setiap anggota membuat branch sendiri.
- Sebelum mulai bekerja, tarik perubahan terbaru dari main:

```bash
git checkout main
git pull origin main
```

- Kerjakan fitur di branch masing-masing.
- Buat Pull Request untuk setiap perubahan atau fitur baru.
- Jangan memasukkan file sensitif seperti `.env`, password, API key, database lokal, atau file pribadi ke GitHub.
- Setelah pull request di-merge, update branch lokal sebelum memulai kerja berikutnya.

## Persyaratan sistem

Pastikan perangkat Anda sudah memiliki:

- PHP 8.3+
- Composer
- Node.js dan npm
- MySQL atau database yang sesuai
- Git

## Setup project

1. Clone repository dan masuk ke folder proyek.
2. Install dependency PHP:

```bash
composer install
```

3. Salin file environment:

```bash
copy .env.example .env
```

Pada Windows PowerShell, jika `copy` tidak tersedia bisa gunakan `Copy-Item .env.example .env`.

4. Konfigurasi database di file `.env`.
5. Generate application key:

```bash
php artisan key:generate
```

6. Jalankan migrasi dan seeder:

```bash
php artisan migrate --seed
```

7. Buat link storage:

```bash
php artisan storage:link
```

8. Jalankan aplikasi:

```bash
php artisan serve
```

9. Jalankan frontend assets:

```bash
npm install
npm run build
```

Untuk mode development saat mengubah frontend:

```bash
npm run dev
```

## Akses admin

Setelah migrasi dan seeder selesai, login ke admin menggunakan:

- URL: `http://127.0.0.1:8000/admin/login`
- Email: `admin@example.com`
- Password: `BeritaAdmin@2026!`

Nilai password ini diambil dari konfigurasi admin di `.env` dan dapat diubah sesuai kebutuhan lingkungan deployment atau local development.

## Catatan penting

- Jangan commit file `.env` ke repository.
- Gunakan branch berbeda untuk setiap tugas.
- Lakukan review sebelum merge ke main.
- Ikuti dokumentasi tambahan seperti `ARCHITECTURE.md`, `DATABASE.md`, `FEATURES.md`, dan `TESTING.md` untuk panduan domain dan pengembangan proyek.
