<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

if(isset($_POST['submit'])){

$nama=$_POST['nama'];
$nim=$_POST['nim'];
$prodi=$_POST['prodi'];
$email=$_POST['email'];
$no_hp=$_POST['no_hp'];

mysqli_query($koneksi,
"INSERT INTO mahasiswa
(nama,nim,prodi,email,no_hp)
VALUES
('$nama','$nim','$prodi','$email','$no_hp')");

header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Data</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container mt-5">

<div class="card col-md-6 mx-auto">

<div class="card-header text-center">
<h3>Tambah Data</h3>
</div>

<div class="card-body">

<form method="POST">

<input type="text"
name="nama"
placeholder="Nama"
class="form-control mb-3"
required>

<input type="text"
name="nim"
placeholder="NIM"
class="form-control mb-3"
required>

<input type="text"
name="prodi"
placeholder="Prodi"
class="form-control mb-3"
required>

<input type="email"
name="email"
placeholder="Email"
class="form-control mb-3"
required>

<input type="text"
name="no_hp"
placeholder="No HP"
class="form-control mb-3"
required>

<button
name="submit"
class="btn btn-success w-100">
Simpan
</button>

</form>

</div>
</div>
</div>

</body>
</html>