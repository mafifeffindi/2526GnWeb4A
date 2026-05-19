php
<?php
session_start();

if(!isset($_SESSION['login'])) {
    header("Location: login.php");
}

include 'koneksi.php';

$cari = "";
if(isset($_GET['cari'])) {
    $cari = $_GET['cari'];
    $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nama LIKE '%$cari%' OR nim LIKE '%$cari%'");
} else {
    $query = mysqli_query($conn, "SELECT * FROM mahasiswa");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Data Mahasiswa</h2>
    

</div>

    <a href="tambah.php" class="btn">+ Tambah Data</a>
    <a href="logout.php" class="btn-logout">Logout</a>

    <form method="GET">
        <input type="text" name="cari" placeholder="Cari nama atau NIM">
        <button type="submit">Cari</button>
    </form>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>prodi</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while($data = mysqli_fetch_array($query)) {
        ?>

        <tr>
            <td><?= $no++; ?></td>
            <td><?= $data['nama']; ?></td>
            <td><?= $data['nim']; ?></td>
            <td><?= $data['prodi']; ?></td>
            <td><?= $data['email']; ?></td>
            <td><?= $data['no_hp']; ?></td>
            <td>
                <a href="edit.php?id=<?= $data['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?= $data['id']; ?>"
                onclick="return confirm('Yakin ingin menghapus data ini?')">
                Hapus</a>
            </td>
        </tr>

        <?php } ?>
    </table>
</div>

</body>
</html>
