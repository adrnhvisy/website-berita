 # Panduan Kerja Tim di GitHub

## Alur singkat

`Fork → Clone → Buat branch → Kerjakan perubahan → Commit → Push → Pull Request → Review → Merge`

## 1. Melakukan Fork

Fork adalah membuat salinan repository orang lain ke akun GitHub sendiri.

1. Buka halaman repository asli di GitHub.
2. Klik tombol **Fork** di kanan atas.
3. Pilih akun pribadi atau organisasi tujuan.
4. Klik **Create fork**.

Setelah selesai, repository akan muncul di akun sendiri dengan alamat seperti:
`https://github.com/username-kamu/website-berita`

## 2. Clone repository hasil fork

Buka repository hasil fork, klik tombol hijau **Code**, pilih **HTTPS**, lalu salin URL-nya.

Di terminal jalankan:

```bash
git clone https://github.com/username-kamu/website-berita.git
cd website-berita
```

Kemudian buat branch untuk pekerjaan sendiri:

```bash
git checkout -b fitur/nama-fitur
```

Jangan mengerjakan langsung di branch `main` agar pekerjaan anggota tim tidak saling bertabrakan.

## 3. Push ke repository fork sendiri

Setelah selesai mengubah kode:

```bash
git add .
git commit -m "Jelaskan perubahan yang dibuat"
git push -u origin fitur/nama-fitur
```

`origin` adalah repository fork milik sendiri. Setelah push, branch akan muncul di GitHub.

## 4. Membuat Pull Request ke repository asli

1. Buka repository fork di GitHub.
2. Klik **Compare & pull request** atau tab **Pull requests** lalu **New pull request**.
3. Pastikan arah tujuan benar:
	 - **base repository**: repository asli milik pemilik proyek.
	 - **base branch**: biasanya `main`.
	 - **head repository**: repository fork milik sendiri.
	 - **compare branch**: branch pekerjaan, misalnya `fitur/nama-fitur`.
4. Isi judul dan penjelasan perubahan.
5. Klik **Create pull request**.

Pemilik repository asli akan melakukan review. Jika diminta perbaikan, lakukan perubahan di branch yang sama, lalu jalankan kembali `git add`, `git commit`, dan `git push`. Pull Request akan otomatis diperbarui.

## Kerja tim sehari-hari

- Setiap anggota membuat branch sendiri.
- Sebelum mulai bekerja, ambil perubahan terbaru:

	```bash
	git checkout main
	git pull origin main
	```

- Kerjakan fitur di branch masing-masing.
- Buat Pull Request untuk setiap fitur atau perbaikan.
- Jangan memasukkan `.env`, password, API key, database lokal, atau file pribadi ke GitHub.
- Setelah Pull Request di-merge, perbarui branch lokal sebelum memulai pekerjaan berikutnya.
