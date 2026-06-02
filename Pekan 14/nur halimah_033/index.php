<?php
include 'koneksi.php';

// Proteksi halaman - wajib login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Fitur Pencarian Data (Kolom disesuaikan menjadi program_studi)
$keyword = "";
if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $query = "SELECT * FROM mahasiswa WHERE 
              nim LIKE '%$keyword%' OR 
              nama LIKE '%$keyword%' OR 
              program_studi LIKE '%$keyword%' OR 
              email LIKE '%$keyword%' OR 
              no_hp LIKE '%$keyword%'";
} else {
    $query = "SELECT * FROM mahasiswa";
}

$data = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php">Universitas Trunojoyo Madura</a>
        <div class="navbar-nav ms-auto">
            <span class="nav-link text-white me-3">Halo, <?= htmlspecialchars($_SESSION['username']); ?></span>
            <a class="btn btn-danger btn-sm text-white" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h5>
            <a href="tambah.php" class="btn btn-success btn-sm">+ Tambah Data</a>
        </div>
        <div class="card-body">
            
            <form action="" method="get" class="row g-3 mb-4">
                <div class="col-sm-9">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari berdasarkan NIM, Nama, Program Studi, Email, atau No HP..." value="<?= htmlspecialchars($keyword); ?>" autocomplete="off">
                </div>
                <div class="col-sm-3 d-grid">
                    <div class="btn-group">
                        <button type="submit" name="cari" class="btn btn-primary">Cari</button>
                        <?php if($keyword != ""): ?>
                            <a href="index.php" class="btn btn-secondary">Reset</a>
                        <?php endif; ?>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if(mysqli_num_rows($data) > 0) {
                            while($d = mysqli_fetch_array($data)){
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($d['nim']); ?></td>
                            <td><?= htmlspecialchars($d['nama']); ?></td>
                            <td><?= htmlspecialchars($d['program_studi']); ?></td>
                            <td><?= htmlspecialchars($d['email']); ?></td>
                            <td><?= htmlspecialchars($d['no_hp']); ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm me-1">Edit</a>
                                <a href="hapus.php?id=<?= $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data mahasiswa bernama <?= htmlspecialchars($d['nama']); ?>?');">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted py-3'>Data tidak ditemukan atau masih kosong.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<footer class="text-center text-muted mt-5 py-3">
    <small>&copy; 2026 Aplikasi CRUD Mahasiswa Terintegrasi Bootstrap</small>
</footer>

</body>
</html>
