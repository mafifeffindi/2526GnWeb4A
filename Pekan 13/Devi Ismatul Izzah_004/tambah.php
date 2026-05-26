<?php
session_start();
include 'koneksi.php';

// Jika belum login, redirect ke login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Jika form disubmit
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $query = "INSERT INTO mahasiswa (nama, nim, prodi, email, no_hp)
              VALUES ('$nama', '$nim', '$prodi', '$email', '$no_hp')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card col-md-6 mx-auto shadow">
        <div class="card-header text-center">
            <h3>Tambah Mahasiswa</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Prodi</label>
                    <input type="text" name="prodi" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>No HP</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success w-100">Simpan</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>