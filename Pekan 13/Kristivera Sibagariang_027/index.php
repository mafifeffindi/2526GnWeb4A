<?php
include 'koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
<h2>Data Mahasiswa</h2>

<a href="tambah.php">+ Tambah Data</a>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Jurusan</th>
        <th>Aksi</th>
    </tr>
</center>
    <?php
    $no = 1;
    while($d = mysqli_fetch_array($data)) {
    ?>

    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td><?php echo $d['nim']; ?></td>
        <td><?php echo $d['jurusan']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a>
            |
            <a href="hapus.php?id=<?php echo $d['id']; ?>">Hapus</a>
        </td>
    </tr>

    <?php } ?>

</table>

</body>
</html>
