# 📚 SiPuBuku — Sistem Pendataan Buku

> UAS Pemrograman Web — Project Based Assessment

---

## Identitas Mahasiswa

| Field | Detail |
|-------|--------|
| **Nama** | beyhaQi |
| **NIM** | 240631100011 |
| **Mata Kuliah** | Pemrograman Web |
| **Judul Aplikasi** | SiPuBuku — Sistem Pendataan Buku |

---

## Deskripsi Aplikasi

**SiPuBuku** adalah aplikasi web sederhana untuk mengelola data koleksi buku perpustakaan. Aplikasi ini memungkinkan pengguna untuk menambah, melihat, mengedit, dan menghapus data buku secara mudah dan efisien.

**Fitur utama:**
- Beranda dengan statistik koleksi buku
- Daftar buku dengan fitur pencarian
- Tambah buku baru
- Edit data buku
- Hapus buku dengan konfirmasi
- Pencarian berdasarkan judul, pengarang, atau genre
- Indikator stok buku (tersedia / sedikit / habis)

---

## Struktur Database

**Database:** `db_buku`

**Tabel:** `buku`

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | INT AUTO_INCREMENT | Primary Key |
| `judul` | VARCHAR(200) | Judul buku |
| `pengarang` | VARCHAR(100) | Nama pengarang |
| `penerbit` | VARCHAR(100) | Nama penerbit |
| `tahun_terbit` | YEAR | Tahun terbit buku |
| `genre` | VARCHAR(50) | Genre/kategori buku |
| `stok` | INT | Jumlah stok buku |
| `deskripsi` | TEXT | Sinopsis/deskripsi buku |
| `created_at` | TIMESTAMP | Waktu data ditambahkan |

---

## Struktur File

```
UAS-PWEB-2526G-240631100011/
│
├── index.php          # Halaman Beranda
├── daftar.php         # Halaman Daftar Buku (Read)
├── tambah.php         # Halaman Tambah Buku (Create)
├── edit.php           # Halaman Edit Buku (Update)
├── hapus.php          # Halaman Hapus Buku (Delete)
├── koneksi.php        # Koneksi database
├── functions.php      # Fungsi-fungsi helper
├── header.php         # Template header & navbar
├── footer.php         # Template footer
├── database.sql       # File SQL database
│
├── css/
│   └── style.css      # Stylesheet eksternal
│
├── assets/            # Aset tambahan
├── img/               # Gambar
└── README.md          # Dokumentasi
```

---

## Cara Menjalankan Aplikasi

### Prasyarat
- PHP 7.4 atau lebih baru
- MySQL 5.7 atau lebih baru
- XAMPP / Laragon / WAMP (disarankan)

### Langkah-langkah

1. **Clone / Download Repository**
   ```bash
   git clone https://github.com/beyhaQi/UAS-PWEB-2526G-240631100011.git
   ```

2. **Pindahkan ke folder server**
   - XAMPP: Pindahkan ke `C:/xampp/htdocs/`
   - Laragon: Pindahkan ke `C:/laragon/www/`

3. **Import Database**
   - Buka phpMyAdmin di browser: `http://localhost/phpmyadmin`
   - Klik **Import** → pilih file `database.sql`
   - Klik **Go / Import**

4. **Konfigurasi Koneksi** *(jika perlu)*

   Buka file `koneksi.php` dan sesuaikan:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');    // sesuaikan username MySQL
   define('DB_PASS', '');        // sesuaikan password MySQL
   define('DB_NAME', 'db_buku');
   ```

5. **Jalankan Aplikasi**

   Buka browser dan akses:
   ```
   http://localhost/UAS-PWEB-2526G-240631100011/
   ```

---

## Checklist Spesifikasi

### HTML
- [x] Struktur HTML5 yang benar (`<!DOCTYPE html>`, semantic tags)
- [x] Minimal 4 halaman: Beranda, Tambah, Daftar, Edit (+ Hapus)

### CSS
- [x] CSS eksternal (`css/style.css`)
- [x] Tampilan rapi dan responsif
- [x] Custom CSS (tanpa Bootstrap)

### PHP
- [x] Variabel (`$judul`, `$pengarang`, dll)
- [x] Percabangan (`if/else`, validasi form)
- [x] Perulangan (`while`, `foreach`)
- [x] Function — 7 fungsi di `functions.php`:
  - `bersihkan_input()`
  - `tampilkan_notif()`
  - `format_stok()`
  - `get_semua_buku()`
  - `get_buku_by_id()`
  - `hitung_total_buku()`
  - `hitung_total_stok()`
- [x] `include` / `require` (`koneksi.php`, `functions.php`, `header.php`, `footer.php`)
- [x] Form Processing GET (pencarian) & POST (tambah, edit, hapus)
- [x] CRUD lengkap (Create, Read, Update, Delete)

### MySQL
- [x] 1 database: `db_buku`
- [x] 1 tabel: `buku`
- [x] 7 record data awal (melebihi minimal 5)
- [x] File `database.sql` tersedia

---

## Pernyataan Penggunaan GenAI

Proyek ini dikembangkan dengan bantuan **Claude AI (Anthropic)** sebagai alat bantu penulisan kode dan struktur aplikasi.

---

## Screenshot Aplikasi

> *(Tambahkan screenshot halaman Beranda, Daftar, Tambah, Edit, dan Hapus di sini)*

---

## Link

- **Repository GitHub:** (https://github.com/mafifeffindi/2526GnWeb4A/tree/main/UAS-PWEB-2526G-240631100011)

