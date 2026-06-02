<?php
include 'koneksi.php';

// Proteksi halaman: wajib login
if (!isset($_SESSION['user'])) {
    header("location: login.php");
    exit();
}

// Fitur pencarian data
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_GET['search']);
    $data = mysqli_query($koneksi,
        "SELECT * FROM mahasiswa
         WHERE nim LIKE '%$search%'
            OR nama LIKE '%$search%'
            OR prodi LIKE '%$search%'
            OR email LIKE '%$search%'
            OR nomor_hp LIKE '%$search%'
         ORDER BY id DESC"
    );
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa ORDER BY id DESC");
}

$total = mysqli_num_rows($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
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

<!-- Main Content -->
<div class="container mt-4">

    <!-- Header Card -->
    <div class="page-header-card card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h5 class="mb-1 fw-bold text-white"><i class="bi bi-people-fill me-2"></i>Daftar Mahasiswa</h5>
                <small class="text-white-50">Total: <?= $total ?> data ditemukan</small>
            </div>
            <a href="tambah.php" class="btn btn-light fw-semibold">
                <i class="bi bi-plus-circle me-1"></i>Tambah Data
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="get" action="index.php">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Cari berdasarkan NIM, Nama, Prodi, Email, atau No. HP..."
                           value="<?= htmlspecialchars($search) ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search me-1"></i>Cari
                    </button>
                    <?php if ($search): ?>
                        <a href="index.php" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i>Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <?php if ($search): ?>
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-1"></i>
            Menampilkan hasil pencarian untuk: <strong>"<?= htmlspecialchars($search) ?>"</strong>
        </div>
    <?php endif; ?>

    <!-- Tabel Data -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 data-table">
                    <thead>
                        <tr>
                            <th class="text-center" style="width:50px">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th class="text-center" style="width:130px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    if (mysqli_num_rows($data) > 0):
                        while ($d = mysqli_fetch_array($data)):
                    ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($d['nim']) ?></span></td>
                            <td class="fw-semibold"><?= htmlspecialchars($d['nama']) ?></td>
                            <td><?= htmlspecialchars($d['prodi']) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($d['email']) ?>" class="text-decoration-none text-muted">
                                    <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($d['email']) ?>
                                </a>
                            </td>
                            <td>
                                <i class="bi bi-telephone me-1 text-muted"></i><?= htmlspecialchars($d['nomor_hp']) ?>
                            </td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-sm btn-warning me-1" title="Edit">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                                <a href="hapus.php?id=<?= $d['id'] ?>&nama=<?= urlencode($d['nama']) ?>"
                                   class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        endwhile;
                    else:
                    ?>
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                <?= $search ? "Tidak ada data yang sesuai pencarian." : "Belum ada data mahasiswa." ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<footer class="text-center text-muted py-4 mt-5">
    <small>&copy; <?= date('Y') ?> Sistem Data Mahasiswa &mdash; Pemrograman Web</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
