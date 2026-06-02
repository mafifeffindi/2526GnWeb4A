<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){

    mysqli_query($conn,"
        INSERT INTO mahasiswa
        VALUES(
        '',
        '$_POST[nama]',
        '$_POST[nim]',
        '$_POST[jurusan]',
        '$_POST[email]',
        '$_POST[no_hp]'
        )
    ");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Tambah Data Mahasiswa</h2>

<form method="POST">

    <input type="text" name="nama" placeholder="Nama" required>

    <input type="text" name="nim" placeholder="NIM" required>

    <input type="text" name="jurusan" placeholder="Jurusan" required>

    <input type="email" name="email" placeholder="Email" required>

    <input type="text" name="no_hp" placeholder="Nomor HP" required>

    <button type="submit" name="simpan">Simpan</button>

</form>

</div>

</body>
</html>