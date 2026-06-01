<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit();
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Mahasiswa</h2>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <a href="tambah.php" class="btn btn-success">+ Tambah Data</a>
                </div>
                <div class="col-md-6">
                    <form method="GET" action="index.php" class="d-flex">
                        <input type="text" name="cari" class="form-control me-2" placeholder="Cari Nama atau NIM..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
                        <button type="submit" class="btn btn-primary">Cari</button>
                        <?php if(isset($_GET['cari'])): ?>
                            <a href="index.php" class="btn btn-secondary ms-2">Reset</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Prodi</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['cari'])) {
                        $cari = $_GET['cari'];
                        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%$cari%' OR nim LIKE '%$cari%'");
                    } else {
                        $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
                    }
                    
                    $no = 1;
                    while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['nim']; ?></td>
                        <td><?php echo $d['nama']; ?></td>
                        <td><?php echo $d['prodi']; ?></td>
                        <td><?php echo $d['email']; ?></td>
                        <td><?php echo $d['no_hp']; ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data <?php echo $d['nama']; ?>?');">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>