<?php
include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");

// Tambahan (Opsional): Cek apakah query berhasil dijalankan
if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="tambah.php">+ Tambah Data</a>
    <br><br> <!-- Tambahan: Memberi sedikit jarak antara link dan tabel -->
    
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Prodi</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <!-- Menggunakan htmlspecialchars untuk mencegah celah keamanan XSS -->
            <td><?php echo htmlspecialchars($d['nim']); ?></td>
            <td><?php echo htmlspecialchars($d['nama']); ?></td>
            <td><?php echo htmlspecialchars($d['prodi']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $d['id']; ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo $d['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>

    </table>
</body>
</html>