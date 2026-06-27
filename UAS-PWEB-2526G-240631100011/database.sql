-- =============================================
-- Sistem Pendataan Buku
-- Nama: beyhaQi
-- NIM: 240631100011
-- =============================================

CREATE DATABASE IF NOT EXISTS db_buku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE db_buku;

CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    genre VARCHAR(50) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, genre, stok, deskripsi) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Novel', 15, 'Kisah inspiratif tentang perjuangan anak-anak Belitung dalam menggapai impian mereka.'),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 'Sejarah', 10, 'Novel pertama dari tetralogi Buru yang mengisahkan kehidupan Minke di era kolonial Belanda.'),
('Filosofi Teras', 'Henry Manampiring', 'Kompas', 2018, 'Nonfiksi', 20, 'Buku tentang filosofi Stoa yang diaplikasikan dalam kehidupan modern Indonesia.'),
('Dilan 1990', 'Pidi Baiq', 'Pastel Books', 2014, 'Roman', 12, 'Kisah cinta remaja di Bandung tahun 1990 antara Milea dan Dilan yang penuh kenangan.'),
('Atomic Habits', 'James Clear', 'Penguin Books', 2018, 'Pengembangan Diri', 25, 'Panduan praktis membangun kebiasaan baik dan menghilangkan kebiasaan buruk secara efektif.'),
('Harry Potter dan Batu Bertuah', 'J.K. Rowling', 'Gramedia', 1997, 'Fantasi', 8, 'Kisah petualangan seorang bocah penyihir bernama Harry Potter di Sekolah Hogwarts.'),
('Sapiens', 'Yuval Noah Harari', 'Alvabet', 2011, 'Nonfiksi', 18, 'Sejarah singkat umat manusia dari zaman purba hingga era modern yang mengubah cara pandang kita.');
