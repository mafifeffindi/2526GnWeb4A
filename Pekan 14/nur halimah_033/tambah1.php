<?php
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
    $nim   = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama  = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $prodi = mysqli_real_escape_string($koneksi, $_POST['prodi']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi', email='$email', no_hp='$no_hp' WHERE id='$id'";
    
    if(mysqli_query($koneksi, $query)){
        header("location:index.php");
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui data!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Form Ubah Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <form method="post" action="">
                        <div class="mb-3">
                            <label class="form-label">NIM</label>
                            <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($d['nim']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($d['nama']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control" value="<?= htmlspecialchars($d['prodi']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($d['email']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor HP</label>
                            <input type="tel" name="no_hp" class="form-control" value="<?= htmlspecialchars($d['no_hp']); ?>" required>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="update" class="btn btn-warning">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
