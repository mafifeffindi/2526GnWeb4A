<?php
session_start();
if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Fitur Pencarian Data
$keyword = "";
$query_sql = "SELECT * FROM nama_tabelmu"; // Ubah sesuai nama tabelmu

if (isset($_GET['cari'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $query_sql = "SELECT * FROM nama_tabelmu WHERE 
                  nama LIKE '%$keyword%' OR 
                  email LIKE '%$keyword%' OR 
                  nomor_hp LIKE '%$keyword%'";
}

$result = mysqli_query($koneksi, $query_sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Manajemen Data</span>
            <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="tambah.php" class="btn btn-success">+ Tambah Data Baru</a>
                
                <form action="" method="GET" class="d-flex gap-2">
                    <input type="text" name="keyword" class="form-control form-control-sm" placeholder="Cari data..." value="<?= htmlspecialchars($keyword); ?>">
                    <button type="submit" name="cari" class="btn btn-sm btn-primary">Cari</button>
                    <?php if ($keyword != ""): ?>
                        <a href="index.php" class="btn btn-sm btn-secondary">Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) : 
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama']); ?></td>
                                <td><?= htmlspecialchars($row['email']); ?></td>
                                <td><?= htmlspecialchars($row['nomor_hp']); ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data <?= htmlspecialchars($row['nama']); ?>?');">Hapus</a>
                                </td>
                            </tr>
                        <?php 
                            endwhile; 
                        } else {
                            echo "<tr><td colspan='5' class='text-center text-muted'>Data tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>