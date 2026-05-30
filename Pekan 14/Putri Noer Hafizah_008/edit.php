<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }
    </style>
</head>
<body>

<div class="container mt-5">
<div class="card shadow mx-auto" style="max-width: 500px;">
<div class="card-body">

<h3 class="text-center mb-4 text-primary">Edit Data</h3>

<form method="POST">
    <input type="text" name="nim" value="<?= $d['nim']; ?>" class="form-control mb-2">
    <input type="text" name="nama" value="<?= $d['nama']; ?>" class="form-control mb-2">
    <input type="text" name="prodi" value="<?= $d['prodi']; ?>" class="form-control mb-2">
    <input type="text" name="email" value="<?= $d['email']; ?>" class="form-control mb-2">
    <input type="text" name="no_hp" value="<?= $d['no_hp']; ?>" class="form-control mb-2">

    <button type="submit" name="update" class="btn btn-primary w-100">Update</button>
    <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>

</div>
</div>
</div>

<?php
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE mahasiswa SET
        nim='$_POST[nim]',
        nama='$_POST[nama]',
        prodi='$_POST[prodi]',
        email='$_POST[email]',
        no_hp='$_POST[no_hp]'
        WHERE id='$id'
    ");

    header("location:index.php");
}
?>

</body>
</html>
