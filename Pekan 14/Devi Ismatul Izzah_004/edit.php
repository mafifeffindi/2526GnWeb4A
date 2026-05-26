<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
}

$id=$_GET['id'];

$data=mysqli_query($koneksi,
"SELECT * FROM mahasiswa WHERE id='$id'");

$row=mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

$nama=$_POST['nama'];
$nim=$_POST['nim'];
$prodi=$_POST['prodi'];
$email=$_POST['email'];
$no_hp=$_POST['no_hp'];

mysqli_query($koneksi,
"UPDATE mahasiswa SET
nama='$nama',
nim='$nim',
prodi='$prodi',
email='$email',
no_hp='$no_hp'
WHERE id='$id'");

header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Data</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="container mt-5">

<div class="card col-md-6 mx-auto">

<div class="card-header text-center">
<h3>Edit Data</h3>
</div>

<div class="card-body">

<form method="POST">

<input type="text"
name="nama"
value="<?= $row['nama']; ?>"
class="form-control mb-3"
required>

<input type="text"
name="nim"
value="<?= $row['nim']; ?>"
class="form-control mb-3"
required>

<input type="text"
name="prodi"
value="<?= $row['prodi']; ?>"
class="form-control mb-3"
required>

<input type="email"
name="email"
value="<?= $row['email']; ?>"
class="form-control mb-3"
required>

<input type="text"
name="no_hp"
value="<?= $row['no_hp']; ?>"
class="form-control mb-3"
required>

<button
name="update"
class="btn btn-primary w-100">
Update
</button>

</form>

</div>
</div>
</div>

</body>
</html>