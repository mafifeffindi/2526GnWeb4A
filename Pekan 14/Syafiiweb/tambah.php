<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
}

include "koneksi.php";

if(isset($_POST['simpan'])){

mysqli_query($conn,

"INSERT INTO mahasiswa
(nama,nim,jurusan,email,no_hp)

VALUES(

'$_POST[nama]',
'$_POST[nim]',
'$_POST[jurusan]',
'$_POST[email]',
'$_POST[no_hp]'

)"

);

header("Location:index.php");
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

<h2>Tambah Mahasiswa</h2>

<form method="POST">

<input type="text" name="nama" placeholder="Nama">

<input type="text" name="nim" placeholder="NIM">

<input type="text" name="jurusan" placeholder="Jurusan">

<input type="email" name="email" placeholder="Email">

<input type="text" name="no_hp" placeholder="No HP">

<button name="simpan">
Simpan
</button>

</form>

</div>

</body>
</html>