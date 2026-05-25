<?php
session_start();
if (!isset($_SESSION['status_login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nomor_hp = mysqli_real_escape_string($koneksi, $_POST['nomor_hp']);

    $insert = mysqli_query($koneksi, "INSERT INTO nama_tabelmu (nama, email, nomor_hp) VALUES ('$nama', '$email', '$nomor_hp')");
    if ($insert) {
        header("Location: index.php");
    } else {
        echo "<script>alert('Gagal menyimpan data');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white"><h5>Form Tambah Data</h5></div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control" required>
                    </div>
                    <div class="mt-4">
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>