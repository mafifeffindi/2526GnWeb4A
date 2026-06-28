-- ============================================================
-- database.sql — Dompetku: Sistem Catatan Keuangan Sederhana
-- Nama   : Muhammad Mansur Adam
-- NIM    : 240631100110
-- Matkul : Pemrograman Web
-- ============================================================

-- Buat dan pilih database
CREATE DATABASE IF NOT EXISTS dompetku
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE dompetku;

-- Drop tabel jika sudah ada (untuk re-import)
DROP TABLE IF EXISTS catatan;

-- Buat tabel catatan
CREATE TABLE catatan (
  id         INT(11)      NOT NULL AUTO_INCREMENT,
  deskripsi  VARCHAR(200) NOT NULL,
  jumlah     DECIMAL(15,2) NOT NULL,
  tipe       ENUM('masuk','keluar') NOT NULL,
  kategori   VARCHAR(100) NOT NULL,
  tanggal    DATE         NOT NULL,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_tipe    (tipe),
  INDEX idx_tanggal (tanggal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ── Data Awal (minimal 5 record) ──────────────────────────
INSERT INTO catatan (deskripsi, jumlah, tipe, kategori, tanggal) VALUES
  ('Beasiswa UKT Semester Genap',   1500000.00, 'masuk',  'Beasiswa',       '2025-06-01'),
  ('Bayar kost bulan Juni',          600000.00, 'keluar', 'Tagihan',        '2025-06-02'),
  ('Freelance desain logo UMKM',     350000.00, 'masuk',  'Freelance',      '2025-06-05'),
  ('Beli buku pemrograman web',       85000.00, 'keluar', 'Pendidikan',     '2025-06-07'),
  ('Makan siang seminggu',           120000.00, 'keluar', 'Makan & Minum',  '2025-06-09'),
  ('Transfer dari orang tua',        500000.00, 'masuk',  'Transfer Masuk', '2025-06-10'),
  ('Token listrik kost',              50000.00, 'keluar', 'Tagihan',        '2025-06-11'),
  ('Jasa pembuatan website toko',    800000.00, 'masuk',  'Freelance',      '2025-06-14'),
  ('Transport Bangkalan–Surabaya',    60000.00, 'keluar', 'Transport',      '2025-06-15'),
  ('Langganan internet bulanan',      99000.00, 'keluar', 'Tagihan',        '2025-06-18');
