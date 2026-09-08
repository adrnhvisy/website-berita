# Review Record

- **Source File**：README.md
- **Source File Path**：c:/Users/User/OneDrive/เอกสาร/tugas - MI 3 Manajemen Proyek sistem informasi (Bapak Fajar Sidqi)/website/berita/README.md
- **Source File Version**：Unknown
- **Review Time**：20260908_0749
- **Review Version**：v1
- **Annotation Count**：0
  - Comments：0
  - Deletions：0
  - Insert After：0
  - Insert Before：0

---

## Instructions

> Instructions are listed in **reverse order** (bottom-up). Please execute them strictly from top to bottom.
> Each instruction provides a "Text Anchor" for precise positioning. Please match the anchor text first; blockIndex is for reference only.

---

## 原始数据（JSON）

> 如需精确操作，可使用以下 JSON 数据。其中 `blockIndex` 是基于空行分割的块索引（从0开始），`startOffset` 是目标文本在块内的字符偏移量（从0开始），可用于区分同一块内的重复文本。

```json
{
  "fileName": "README.md",
  "docVersion": "未知",
  "reviewVersion": 1,
  "annotationCount": 0,
  "rawMarkdown": " # Panduan Kerja Tim di GitHub\n\n## Alur singkat\n\n`Fork → Clone → Buat branch → Kerjakan perubahan → Commit → Push → Pull Request → Review → Merge`\n\n## 1. Melakukan Fork\n\nFork adalah membuat salinan repository orang lain ke akun GitHub sendiri.\n\n1. Buka halaman repository asli di GitHub.\n2. Klik tombol **Fork** di kanan atas.\n3. Pilih akun pribadi atau organisasi tujuan.\n4. Klik **Create fork**.\n\nSetelah selesai, repository akan muncul di akun sendiri dengan alamat seperti:\n`https://github.com/username-kamu/website-berita`\n\n## 2. Clone repository hasil fork\n\nBuka repository hasil fork, klik tombol hijau **Code**, pilih **HTTPS**, lalu salin URL-nya.\n\nDi terminal jalankan:\n\n```bash\ngit clone https://github.com/username-kamu/website-berita.git\ncd website-berita\n```\n\nKemudian buat branch untuk pekerjaan sendiri:\n\n```bash\ngit checkout -b fitur/nama-fitur\n```\n\nJangan mengerjakan langsung di branch `main` agar pekerjaan anggota tim tidak saling bertabrakan.\n\n## 3. Push ke repository fork sendiri\n\nSetelah selesai mengubah kode:\n\n```bash\ngit add .\ngit commit -m \"Jelaskan perubahan yang dibuat\"\ngit push -u origin fitur/nama-fitur\n```\n\n`origin` adalah repository fork milik sendiri. Setelah push, branch akan muncul di GitHub.\n\n## 4. Membuat Pull Request ke repository asli\n\n1. Buka repository fork di GitHub.\n2. Klik **Compare & pull request** atau tab **Pull requests** lalu **New pull request**.\n3. Pastikan arah tujuan benar:\n\t - **base repository**: repository asli milik pemilik proyek.\n\t - **base branch**: biasanya `main`.\n\t - **head repository**: repository fork milik sendiri.\n\t - **compare branch**: branch pekerjaan, misalnya `fitur/nama-fitur`.\n4. Isi judul dan penjelasan perubahan.\n5. Klik **Create pull request**.\n\nPemilik repository asli akan melakukan review. Jika diminta perbaikan, lakukan perubahan di branch yang sama, lalu jalankan kembali `git add`, `git commit`, dan `git push`. Pull Request akan otomatis diperbarui.\n\n## Kerja tim sehari-hari\n\n- Setiap anggota membuat branch sendiri.\n- Sebelum mulai bekerja, ambil perubahan terbaru:\n\n\t```bash\n\tgit checkout main\n\tgit pull origin main\n\t```\n\n- Kerjakan fitur di branch masing-masing.\n- Buat Pull Request untuk setiap fitur atau perbaikan.\n- Jangan memasukkan `.env`, password, API key, database lokal, atau file pribadi ke GitHub.\n- Setelah Pull Request di-merge, perbarui branch lokal sebelum memulai pekerjaan berikutnya.\n\n\n## Tahapan Instalasi & Penggunaan\n1. Download project menggunakan git dengan perintah: `git clone <url>` lalu masuk ke dalam `folder project` atau download secara manual\n2. Install dependency: `composer update` dan `composer install`\n3. Copy file environment: `cp .env.example .env` atau `copy .env.example .env`\n4. Konfigurasi database pada .env\n5. Generate application key: `php artisan key:generate`\n6. Storage link: `php artisan storage:link`\n7. Jalankan migration: `php artisan migrate --seed`\n8. Jalankan project: `php artisan serve` dan `npm run build` -> `npm run dev` `(opsional: kalau mau melakukan perubahan pada website. ini akan mempermudah <^.^>)`\n9. Akses ke dashboard: `127.0.0.1:8000/admin/login`, login menggunakan email: `admin@example.com` password: `BeritaAdmin@2026!`\n",
  "annotations": []
}
```