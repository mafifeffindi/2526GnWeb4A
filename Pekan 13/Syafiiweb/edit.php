<?php

include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM mahasiswa WHERE id='$id'");

$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];

mysqli_query($conn,
"UPDATE mahasiswa SET

nama='$nama',
nim='$nim',
jurusan='$jurusan',
email='$email',
no_hp='$no_hp'

WHERE id='$id'
");

header("location:index.php");

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Data</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2 class="text-center mb-4">
Edit Data Mahasiswa
</h2>

<form method="POST">

<input type="text"
name="nama"
value="<?php echo $d['nama']; ?>"
class="form-control mb-3">

<input type="text"
name="nim"
value="<?php echo $d['nim']; ?>"
class="form-control mb-3">

<input type="text"
name="jurusan"
value="<?php echo $d['jurusan']; ?>"
class="form-control mb-3">

<input type="email"
name="email"
value="<?php echo $d['email']; ?>"
class="form-control mb-3">

<input type="text"
name="no_hp"
value="<?php echo $d['no_hp']; ?>"
class="form-control mb-3">

<button type="submit"
name="update"
class="btn btn-success w-100">
Update
</button>

</form>

</div>
</div>
</div>

</body>
</html>