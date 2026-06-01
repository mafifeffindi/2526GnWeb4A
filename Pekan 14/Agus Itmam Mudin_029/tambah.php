<?php
session_start();
if ($_SESSION['status'] != "login") { header("location:login.php"); exit(); }
include 'koneksi.php';

if(isset($_POST['simpan'])){
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    mysqli_query($koneksi, "INSERT INTO mahasiswa (nim, nama, prodi, email, no_hp) VALUES ('$nim', '$nama', '$prodi', '$email', '$no_hp')");
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Tambah Data Mahasiswa</h5>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3"><label>NIM</label><input type="text" name="nim" class="form-control" required></div>
                <div class="mb-3"><label>Nama</label><input type="text" name="nama" class="form-control" required></div>
                <div class="mb-3"><label>Prodi</label><input type="text" name="prodi" class="form-control" required></div>
                <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                <div class="mb-3"><label>No HP</label><input type="text" name="no_hp" class="form-control" required></div>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>