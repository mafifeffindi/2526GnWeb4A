<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){

    // Menggunakan mysqli_real_escape_string untuk mencegah error tanda petik
    $nim = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    // Perbaikan query: Menyebutkan kolom secara eksplisit tanpa mengisi kolom ID (Auto Increment)
    $query = "INSERT INTO mahasiswa (nim, nama, prodi, email, no_hp) 
    VALUES ('$nim', '$nama', '$prodi', '$email', '$no_hp')";
    mysqli_query($koneksi, $query);
   
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Tambah Data</title>
</head>
<body>

<h2>Tambah Data Mahasiswa</h2>

<form method="post">
    <input type="text" name="nim" placeholder="NIM" required><br><br>
    <input type="text" name="nama" placeholder="Nama" required><br><br>
    <input type="text" name="prodi" placeholder="Prodi" required><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="text" name="no_hp" placeholder="Nomor HP"><br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>

</body>
</html>
