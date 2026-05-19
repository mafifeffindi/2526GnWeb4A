<?php
include 'koneksi.php';

if(isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];

    mysqli_query($koneksi, "INSERT INTO mahasiswa VALUES(
    '',
    '$nama',
    '$nim',
    '$jurusan'
    )");

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

    <label>Nama</label><br>
    <input type="text" name="nama"><br><br>

    <label>NIM</label><br>
    <input type="text" name="nim"><br><br>

    <label>Jurusan</label><br>
    <input type="text" name="jurusan"><br><br>

    <button type="submit" name="submit">Simpan</button>

</form>

</body>
</html>
