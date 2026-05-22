<?php
include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f4f6f8;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            padding: 32px 36px 36px 36px;
        }
        h2 {
            color: #2c3e50;
            margin-bottom: 24px;
        }
        .add-btn {
            display: inline-block;
            margin-bottom: 18px;
            background: #3498db;
            color: #fff !important;
            padding: 8px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        .add-btn:hover {
            background: #217dbb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            padding: 12px 14px;
            border: 1px solid #e1e4e8;
            text-align: left;
        }
        th {
            background: #3498db;
            color: #fff;
            font-size: 16px;
        }
        tr:nth-child(even) {
            background: #f8fafc;
        }
        .action-links a {
            margin-right: 10px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        .action-links a:hover {
            color: #217dbb;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Mahasiswa</h2>
    <a class="add-btn" href="tambah.php">+ Tambah Data</a>
    <table>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>
        <?php
        $Sno = 1;
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $Sno++; ?></td>
            <td><?php echo $d['nim']; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo $d['prodi']; ?></td>
            <td class="action-links">
                <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a>
                <a href="hapus.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>

</body>
</html>