<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if(isset($_POST['submit'])){

    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($conn,
    "INSERT INTO mahasiswa
    VALUES(
    '',
    '$nama',
    '$nim',
    '$jurusan',
    '$email',
    '$no_hp'
    )");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
</head>
<body>

<h2>TAMBAH DATA</h2>

<form method="POST">

Nama <br>
<input type="text" name="nama">
<br><br>

NIM <br>
<input type="text" name="nim">
<br><br>

Jurusan <br>
<input type="text" name="jurusan">
<br><br>

Email <br>
<input type="email" name="email">
<br><br>

No HP <br>
<input type="text" name="no_hp">
<br><br>

<button type="submit" name="submit">
    Simpan
</button>

</form>

</body>
</html>