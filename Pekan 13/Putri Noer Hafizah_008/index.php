<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Data Mahasiswa</h2>
<a href="tambah.php">+ Tambah Data</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    <?php
    $no = 1;
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa");
    while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nim']; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td>
            <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a>
            <a href="hapus.php?id=<?php echo $d['id']; ?>">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
