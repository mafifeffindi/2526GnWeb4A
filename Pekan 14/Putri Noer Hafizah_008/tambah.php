<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data</title>
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

<h3 class="text-center mb-4 text-primary">Tambah Data</h3>

<form method="POST">
    <input type="text" name="nim" class="form-control mb-2" placeholder="NIM">
    <input type="text" name="nama" class="form-control mb-2" placeholder="Nama">
    <input type="text" name="prodi" class="form-control mb-2" placeholder="Prodi">
    <input type="text" name="email" class="form-control mb-2" placeholder="Email">
    <input type="text" name="no_hp" class="form-control mb-2" placeholder="No HP">

    <button type="submit" name="simpan" class="btn btn-primary w-100">Simpan</button>
    <a href="index.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
</form>

</div>
</div>
</div>

<?php
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO mahasiswa 
    (nim, nama, prodi, email, no_hp) VALUES (
        '$_POST[nim]',
        '$_POST[nama]',
        '$_POST[prodi]',
        '$_POST[email]',
        '$_POST[no_hp]'
    )");

    header("location:index.php");
}
?>

</body>
</html>
