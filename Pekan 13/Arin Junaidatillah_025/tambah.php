<?php
include 'koneksi.php';

if(isset($_POST['submit'])){
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $no_hp  = $_POST['no_hp'];

    mysqli_query($koneksi, "INSERT INTO mahasiswa (nama, email, no_hp) VALUES ('$nama','$email','$no_hp')");

    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>

<h2>Tambah Data Mahasiswa</h2>

<form method="POST">
    Nama:<br>
    <input type="text" name="nama" required><br><br>

    Email:<br>
    <input type="email" name="email" required><br><br>

    No HP:<br>
    <input type="text" name="no_hp" required><br><br>

    <button type="submit" name="submit">Simpan</button>
</form>

<br>
<a href="index.php">← Kembali</a>

</body>
</html>