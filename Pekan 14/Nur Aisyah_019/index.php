<?php
session_start();

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

$keyword = "";

if(isset($_GET['keyword'])){
    $keyword = $_GET['keyword'];

    $data = mysqli_query($conn,"
        SELECT * FROM mahasiswa
        WHERE nama LIKE '%$keyword%'
        OR nim LIKE '%$keyword%'
        OR jurusan LIKE '%$keyword%'
    ");
}else{
    $data = mysqli_query($conn,"SELECT * FROM mahasiswa");
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

    <a href="tambah.php" class="btn tambah">+ Tambah Data</a>
    <a href="logout.php" class="btn logout">Logout</a>

    <br><br>

    <form method="GET">
        <input type="text" name="keyword" placeholder="Cari data..." value="<?= $keyword; ?>">
        <button type="submit">Cari</button>
    </form>

    <br>

    <table>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while($row = mysqli_fetch_assoc($data)){
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['nim']; ?></td>
            <td><?= $row['jurusan']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['no_hp']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id']; ?>" class="btn edit">Edit</a>

                <a href="hapus.php?id=<?= $row['id']; ?>"
                class="btn hapus"
                onclick="return confirm('Yakin ingin menghapus data ini?')">
                Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>