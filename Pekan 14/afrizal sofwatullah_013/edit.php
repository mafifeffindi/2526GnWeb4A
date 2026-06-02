<?php
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

$id = intval($_GET['id']);
$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($result);

if (!$d) {
    header("location: index.php");
    exit();
}

$errors = [];

if (isset($_POST['update'])) {
    $nim      = mysqli_real_escape_string($koneksi, trim($_POST['nim']));
    $nama     = mysqli_real_escape_string($koneksi, trim($_POST['nama']));
    $prodi    = mysqli_real_escape_string($koneksi, trim($_POST['prodi']));
    $email    = mysqli_real_escape_string($koneksi, trim($_POST['email']));
    $nomor_hp = mysqli_real_escape_string($koneksi, trim($_POST['nomor_hp']));

    if (empty($nim))   $errors[] = "NIM wajib diisi.";
    if (empty($nama))  $errors[] = "Nama wajib diisi.";
    if (empty($prodi)) $errors[] = "Prodi wajib diisi.";
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $errors[] = "Format email tidak valid.";

    if (empty($errors)) {
        mysqli_query($koneksi,
            "UPDATE mahasiswa SET
                nim='$nim', nama='$nama', prodi='$prodi',
                email='$email', nomor_hp='$nomor_hp'
             WHERE id='$id'"
        );
        header("location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php"><i class="bi bi-house me-1"></i>Home</a></li>
                    <li class="breadcrumb-item active">Edit Data</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-header form-card-header-edit">
                    <h5 class="mb-0 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">

                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Perbaiki kesalahan:</strong>
                            <ul class="mb-0 mt-1">
                                <?php foreach ($errors as $e): ?><li><?= $e ?></li><?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="post" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">NIM <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-123"></i></span>
                                    <input type="text" name="nim" class="form-control"
                                           value="<?= htmlspecialchars(isset($_POST['nim']) ? $_POST['nim'] : $d['nim']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="nama" class="form-control"
                                           value="<?= htmlspecialchars(isset($_POST['nama']) ? $_POST['nama'] : $d['nama']) ?>" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold">Program Studi <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-book"></i></span>
                                    <input type="text" name="prodi" class="form-control"
                                           value="<?= htmlspecialchars(isset($_POST['prodi']) ? $_POST['prodi'] : $d['prodi']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control"
                                           value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : $d['email']) ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nomor HP</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                                    <input type="tel" name="nomor_hp" class="form-control"
                                           value="<?= htmlspecialchars(isset($_POST['nomor_hp']) ? $_POST['nomor_hp'] : $d['nomor_hp']) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" name="update" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i>Update
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
