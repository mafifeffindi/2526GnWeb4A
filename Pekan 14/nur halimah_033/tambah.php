<?php
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if(isset($_POST['simpan'])){
    $nim   = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    // KOLOM DATABASE SUDAH DISESUAIKAN: program_studi
    $query = "INSERT INTO mahasiswa (nim, nama, program_studi, email, no_hp) VALUES ('$nim', '$nama', '$prodi', '$email', '$no_hp')";
    
    if(mysqli_query($koneksi, $query)){
        header("location:index.php");
        exit;
    } else {
        echo "<div class='alert alert-danger mb-0 text-center'>Gagal menyimpan data! Error: " . mysqli_error($koneksi) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Form Tambah Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Contoh: 230411100033" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control" placeholder="Contoh: Pendidikan Informatika" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="tel" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php" class="btn btn-secondary">Kembali</a>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
