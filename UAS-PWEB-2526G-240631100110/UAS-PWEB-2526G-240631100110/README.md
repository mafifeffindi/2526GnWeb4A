# Dompetku — Sistem Catatan Keuangan Sederhana

> UAS Pemrograman Web · Universitas Trunojoyo Madura · 2024/2025

---

## Identitas

| | |
|---|---|
| **Nama** | Muhammad Mansur Adam |
| **NIM** | 240631100110 |
| **Mata Kuliah** | Pemrograman Web |
| **Judul Aplikasi** | Dompetku — Sistem Catatan Keuangan Sederhana |

---

## Deskripsi Singkat

**Dompetku** adalah aplikasi web manajemen keuangan pribadi berbasis PHP Native dan MySQL. Pengguna dapat mencatat pemasukan dan pengeluaran harian, melihat ringkasan saldo secara real-time melalui visualisasi donut ring, serta memfilter dan mencari riwayat transaksi berdasarkan tipe, bulan, atau kata kunci.

Dibangun dengan desain antarmuka dark dashboard menggunakan custom CSS (tanpa Bootstrap), typeface **Plus Jakarta Sans** (buatan desainer Indonesia), dan aksen warna **mint** untuk pemasukan serta **coral** untuk pengeluaran.

---

## Fitur Utama

- **Dashboard ringkasan** — saldo, total pemasukan, total pengeluaran, dan balance ring SVG dinamis
- **CRUD lengkap** — Tambah, Lihat, Edit, Hapus catatan transaksi
- **Filter & Pencarian** — filter by tipe, bulan, dan keyword search
- **Kategori dinamis** — pilihan kategori berubah otomatis sesuai tipe (pemasukan/pengeluaran)
- **Flash messages** — notifikasi sukses/gagal via session
- **Pagination** — daftar transaksi terpaginasi 10 per halaman
- **Responsive** — sidebar pada desktop, mobile bottom nav pada layar kecil

---

## Struktur Database

**Database:** `dompetku`

**Tabel:** `catatan`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT AUTO_INCREMENT | Primary key |
| `deskripsi` | VARCHAR(200) | Keterangan transaksi |
| `jumlah` | DECIMAL(15,2) | Nominal dalam Rupiah |
| `tipe` | ENUM('masuk','keluar') | Jenis transaksi |
| `kategori` | VARCHAR(100) | Kategori transaksi |
| `tanggal` | DATE | Tanggal transaksi |
| `created_at` | TIMESTAMP | Waktu input otomatis |

---

## Struktur Repository

```
UAS-PWEB-2526G-240631100110/
│
├── index.php          ← Beranda (ringkasan + transaksi terbaru)
├── tambah.php         ← Form tambah catatan (CREATE)
├── daftar.php         ← Daftar semua catatan + filter (READ)
├── edit.php           ← Form edit catatan (UPDATE)
├── hapus.php          ← Konfirmasi & eksekusi hapus (DELETE)
├── koneksi.php        ← Koneksi database MySQL
├── functions.php      ← Helper functions (formatRupiah, dll)
├── header.php         ← Shared header + sidebar
├── footer.php         ← Shared footer + mobile nav
├── database.sql       ← Script database & data awal
│
├── css/
│   └── style.css      ← Stylesheet utama (custom, tanpa Bootstrap)
│
├── img/               ← Screenshot aplikasi
│
└── README.md
```

---

## Cara Menjalankan Aplikasi

### Persyaratan
- XAMPP (atau WAMP/Laragon) dengan PHP ≥ 7.4 dan MySQL
- Browser modern

### Langkah-langkah

**1. Clone atau download repository ini**
```bash
git clone https://github.com/mansuradam/UAS-PWEB-2526G-240631100110.git
```

**2. Pindahkan folder ke direktori XAMPP**
```
C:\xampp\htdocs\UAS-PWEB-2526G-240631100110\
```

**3. Import database**
- Buka `http://localhost/phpmyadmin`
- Klik **Import** → pilih file `database.sql`
- Klik **Go**

*(Atau jalankan via terminal: `mysql -u root -p < database.sql`)*

**4. Jalankan aplikasi**

Buka browser dan akses:
```
http://localhost/UAS-PWEB-2526G-240631100110/
```

---

## Implementasi Teknis PHP

| Elemen | Implementasi |
|---|---|
| Variabel | `$masuk`, `$keluar`, `$saldo`, `$filterTipe`, dll |
| Percabangan | Validasi form, cek tipe transaksi, filter WHERE |
| Perulangan | `while ($row = $data->fetch_assoc())` di daftar & beranda |
| Function | `formatRupiah()`, `formatTanggal()`, `hitungRingkasan()`, `bersihkan()`, `setFlash()`, `getFlash()`, `redirect()` |
| include/require | `require 'koneksi.php'`, `require 'functions.php'`, `include 'header.php'`, `include 'footer.php'` |
| Form Processing | GET (filter/search), POST (tambah, edit, hapus) |
| CRUD | Create (`tambah.php`), Read (`daftar.php`, `index.php`), Update (`edit.php`), Delete (`hapus.php`) |

---

## Pernyataan Penggunaan GenAI

Proyek ini dikembangkan dengan bantuan **Claude (Anthropic)** sebagai alat bantu generasi kode dan desain antarmuka. Seluruh logika bisnis, struktur database, dan keputusan desain telah dipahami dan diverifikasi oleh penulis.

---

*© 2025 Muhammad Mansur Adam · Universitas Trunojoyo Madura*
