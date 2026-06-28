<?php 
require 'fungsi.php';

// Proses Delete (Form Processing GET / Ambil parameter URL)
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    $query_hapus = "DELETE FROM mahasiswa WHERE id = '$id_hapus'";
    if (mysqli_query($koneksi, $query_hapus)) {
        header("Location: tampil.php?pesan=dihapus");
        exit;
    }
}

include 'header.php'; 
$mahasiswa = ambilSemuaMahasiswa($koneksi);
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Data Mahasiswa</h2>
    <a href="tambah.php" class="btn btn-success">+ Tambah Mahasiswa</a>
</div>

<?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil **<?= $_GET['pesan']; ?>**!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm p-4 bg-white">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswa)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Data kosong.</td>
                    </tr>
                <?php else: ?>
                    <?php 
                    $no = 1; // Variabel counter
                    foreach ($mahasiswa as $mhs): // Perulangan
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><strong><?= htmlspecialchars($mhs['nim']); ?></strong></td>
                        <td><?= htmlspecialchars($mhs['nama']); ?></td>
                        <td><?= htmlspecialchars($mhs['jurusan']); ?></td>
                        <td><?= htmlspecialchars($mhs['email']); ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $mhs['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="tampil.php?hapus=<?= $mhs['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>