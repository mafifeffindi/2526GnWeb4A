-- Buat database
CREATE DATABASE IF NOT EXISTS db_kampus;
USE db_kampus;

-- Tabel mahasiswa (dengan field email dan nomor_hp)
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(20),
    nama VARCHAR(100),
    prodi VARCHAR(100),
    email VARCHAR(100),
    nomor_hp VARCHAR(20)
);

-- Tabel users untuk login
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert akun admin default (password: admin123)
INSERT INTO users (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
