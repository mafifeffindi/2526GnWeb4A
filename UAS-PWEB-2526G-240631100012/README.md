# UAS-PWEB-2526G-240631100012
1. Nama  : Muhammad Hawaari
2. NIM  : 240631100012
3. Judul aplikasi  : Sistem Pendataan Mahasiswa Berbasis Web Menggunakan PHP Native dan MySQL
4. Deskripsi singkat  : Aplikasi ini merupakan sebuah sistem informasi sederhana yang dirancang untuk mengelola data akademis mahasiswa secara digital. Sistem ini mendukung penuh fungsionalitas CRUD (Create, Read, Update, Delete) yang memungkinkan pengguna untuk menambahkan data mahasiswa baru, melihat daftar mahasiswa yang terdaftar secara real-time, memperbarui informasi data mahasiswa, serta menghapus data yang tidak diperlukan lagi. Aplikasi ini dibangun dengan struktur HTML5, PHP Native untuk logika pemrograman backend, database MySQL sebagai media penyimpanan, serta dibalut dengan framework CSS Bootstrap 5 untuk menghasilkan antarmuka pengguna yang rapi, bersih, dan responsif.
5. Screenshot aplikasi :
   <img width="1361" height="639" alt="image" src="https://github.com/user-attachments/assets/aacd42dc-f62c-49b2-a70f-6fffaa77b261" />
    <img width="1362" height="638" alt="image" src="https://github.com/user-attachments/assets/41d5c3b8-7fac-4d65-a458-5638c88f6ba9" />
      <img width="1361" height="641" alt="image" src="https://github.com/user-attachments/assets/2d7659d8-a500-4e61-af17-06ef117d4e46" />
7. Struktur database :Nama Database: db_mahasiswa
    Nama Tabel: mahasiswa
    Struktur kolom (fields) pada tabel mahasiswa:
      id : INT (Primary Key, Auto Increment)
      nim : VARCHAR(15) (Unique Key, Not Null)
      nama : VARCHAR(100) (Not Null)
      jurusan : VARCHAR(50) (Not Null)
      email : VARCHAR(100) (Not Null)
8. Cara menjalankan aplikasi :Pastikan aplikasi XAMPP Control Panel sudah terinstal dan berjalan di komputer/laptop.
    a. Aktifkan modul Apache dan MySQL pada XAMPP Control Panel dengan mengeklik tombol Start.
    b. Ekstrak atau letakkan folder project db_mahasiswa ke dalam direktori web server lokal di: C:\xampp\htdocs\
    c. Buka browser web (seperti Google Chrome atau Mozilla Firefox), lalu masuk ke halaman phpMyAdmin melalui alamat localhost/phpmyadmin/
    d. Buat database baru bernama db_mahasiswa, kemudian pilih database tersebut dan lakukan Import pada file database.sql yang telah              disediakan di dalam folder project untuk memuat struktur tabel dan data awal.
  e. Setelah database berhasil ter-import, buka tab baru pada browser dan jalankan aplikasi dengan mengetikkan alamat URL berikut pada address bar:
  localhost/db_mahasiswa/
  f. Aplikasi Sistem Pendataan Mahasiswa siap digunakan.
