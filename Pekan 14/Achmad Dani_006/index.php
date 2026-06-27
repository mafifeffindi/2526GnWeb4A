<?php

session_start();

if(!isset($_SESSION['login'])){
    header("Location:login.php");
}

include 'koneksi.php';

$cari = "";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];

    $data = mysqli_query($conn,
    "SELECT * FROM mahasiswa
    WHERE nama LIKE '%$cari%'
    OR nim LIKE '%$cari%'");
}else{
    $data = mysqli_query($conn,
    "SELECT * FROM mahasiswa");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1 class="page-title">Data Mahasiswa</h1>
                <p class="subtitle">Kelola daftar mahasiswa dengan antarmuka yang lebih rapi, pencarian cepat, dan aksi yang jelas.</p>
            </div>
            <div class="actions">
                <a href="tambah.php" class="button secondary">Tambah Data</a>
                <a href="logout.php" class="button danger">Logout</a>
            </div>
        </div>

        <div class="card">
            <form method="GET" class="search-form">
                <input type="text" name="cari" placeholder="Cari berdasarkan nama atau NIM" value="<?php echo htmlspecialchars($cari); ?>">
                <button type="submit" class="button">Cari</button>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($data) > 0): ?>
                            <?php while($d=mysqli_fetch_array($data)): ?>
                                <tr>
                                    <td><?php echo $d['id']; ?></td>
                                    <td><?php echo htmlspecialchars($d['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($d['nim']); ?></td>
                                    <td><?php echo htmlspecialchars($d['jurusan']); ?></td>
                                    <td><?php echo htmlspecialchars($d['email']); ?></td>
                                    <td><?php echo htmlspecialchars($d['no_hp']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $d['id']; ?>" class="button secondary">Edit</a>
                                        <a href="hapus.php?id=<?php echo $d['id']; ?>" class="button danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="no-data">Belum ada data yang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>