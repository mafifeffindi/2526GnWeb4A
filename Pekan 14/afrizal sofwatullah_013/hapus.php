<?php
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

$id   = intval($_GET['id']);
$nama = htmlspecialchars($_GET['nama'] ?? '');

// Jika dikonfirmasi hapus
if (isset($_GET['konfirm']) && $_GET['konfirm'] === 'ya') {
    mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id='$id'");
    header("location: index.php");
    exit();
}

// Ambil data untuk ditampilkan di halaman konfirmasi
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($result);

if (!$d) {
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>Sistem Data Mahasiswa
        </a>
        <div class="ms-auto">
            <span class="text-white me-3">
                <i class="bi bi-person-circle me-1"></i><?= htmlspecialchars($_SESSION['user']) ?>
            </span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-box-arrow-right me-1"></i>Logout
            </a>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">

            <div class="card shadow border-0">
                <div class="card-body text-center p-5">
                    <!-- Ikon peringatan -->
                    <div class="delete-icon-wrapper mb-3">
                        <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 3rem;"></i>
                    </div>

                    <h4 class="fw-bold mb-1">Konfirmasi Hapus</h4>
                    <p class="text-muted mb-4">Apakah Anda yakin ingin menghapus data berikut?</p>

                    <!-- Detail data yang akan dihapus -->
                    <div class="alert alert-warning text-start mb-4">
                        <table class="table table-sm mb-0">
                            <tr><td class="fw-semibold text-nowrap" style="width:80px">NIM</td><td>: <?= htmlspecialchars($d['nim']) ?></td></tr>
                            <tr><td class="fw-semibold">Nama</td><td>: <?= htmlspecialchars($d['nama']) ?></td></tr>
                            <tr><td class="fw-semibold">Prodi</td><td>: <?= htmlspecialchars($d['prodi']) ?></td></tr>
                            <tr><td class="fw-semibold">Email</td><td>: <?= htmlspecialchars($d['email']) ?></td></tr>
                            <tr><td class="fw-semibold">No. HP</td><td>: <?= htmlspecialchars($d['nomor_hp']) ?></td></tr>
                        </table>
                    </div>

                    <p class="text-danger small mb-4">
                        <i class="bi bi-info-circle me-1"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </p>

                    <div class="d-flex gap-2 justify-content-center">
                        <a href="hapus.php?id=<?= $id ?>&konfirm=ya"
                           class="btn btn-danger px-4">
                            <i class="bi bi-trash-fill me-1"></i>Ya, Hapus
                        </a>
                        <a href="index.php" class="btn btn-secondary px-4">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
