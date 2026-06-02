<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){

    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($koneksi,
    "INSERT INTO mahasiswa
    VALUES
    ('','$nim','$nama','$prodi','$email','$no_hp')");

    header("location:index.php");
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

<form method="post">

<input type="text"
name="nim"
placeholder="NIM"><br><br>

<input type="text"
name="nama"
placeholder="Nama"><br><br>

<input type="text"
name="prodi"
placeholder="Prodi"><br><br>

<input type="text"
name="email"
placeholder="Email"><br><br>

<input type="text"
name="no_hp"
placeholder="No HP"><br><br>

<button type="submit"
name="simpan">

Simpan

</button>

</form>

</div>

</body>
</html>