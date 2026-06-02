<?php

include 'koneksi.php';

if(isset($_POST['submit'])){

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

mysqli_query($conn,
"INSERT INTO mahasiswa VALUES(
'',
'$nama',
'$nim',
'$jurusan',
'$email',
'$no_hp'
)");

header("location:index.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Data</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">
Tambah Data Mahasiswa
</h2>

<form method="POST">

<input type="text"
name="nama"
class="form-control mb-3"
placeholder="Nama">

<input type="text"
name="nim"
class="form-control mb-3"
placeholder="NIM">

<input type="text"
name="jurusan"
class="form-control mb-3"
placeholder="Jurusan">

<input type="email"
name="email"
class="form-control mb-3"
placeholder="Email">

<input type="text"
name="no_hp"
class="form-control mb-3"
placeholder="No HP">

<button type="submit"
name="submit"
class="btn btn-primary w-100">
Simpan
</button>

</form>

</div>
</div>
</div>

</body>
</html>