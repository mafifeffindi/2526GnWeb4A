<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['cari'])) {
    $keyword = $_GET['cari'];
    $query_string = "SELECT * FROM mahasiswa WHERE nim LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR prodi LIKE '%$keyword%'";
} else {
    $query_string = "SELECT * FROM mahasiswa";
}

$data = mysqli_query($koneksi, $query_string);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
        <span class="navbar-brand mb-0 h1">SIAKAD PEKAN 14</span>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Halo, <strong><?php echo $_SESSION['user']; ?></strong></span>
            <a href="logout.php" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin keluar?');">Logout</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="m-0 text-secondary">Daftar Informasi Mahasiswa</h4>
                <a href="tambah.php" class="btn btn-success">+ Tambah Mahasiswa</a>
            </div>

            <form method="get" action="index.php" class="row g-2 mb-4">
                <div class="col-md-4">
                    <input type="text" name="cari" class="form-control" placeholder="Cari NIM, Nama, atau Prodi..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cari Data</button>
                </div>
                <?php if (isset($_GET['cari'])): ?>
                <div class="col-auto">
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
                <?php endif; ?>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th>NIM</th>
                            <th>Nama Lengkap</th>
                            <th>Prodi</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (mysqli_num_rows($data) > 0) {
                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $d['nim']; ?></td>
                                <td><strong><?php echo $d['nama']; ?></strong></td>
                                <td><?php echo $d['prodi']; ?></td>
                                <td><?php echo $d['email']; ?></td>
                                <td><?php echo $d['nohp']; ?></td>
                                <td class="text-center">
                                    <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-warning me-1 text-white">Edit</a>
                                    <a href="hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data <?php echo $d['nama']; ?>?');">Hapus</a>
                                </td>
                            </tr>
                            <?php
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted py-4'>Data kosong atau tidak ditemukan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
