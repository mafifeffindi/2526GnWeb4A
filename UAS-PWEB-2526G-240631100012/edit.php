<?php 
require 'fungsi.php';

// Ambil ID dari parameter GET
if (!isset($_GET['id'])) {
    header("Location: tampil.php");
    exit;
}
$id = $_GET['id'];

// Ambil data lama menggunakan Fungsi ke-2 yang kita buat
$mhs = ambilMahasiswaPerId($koneksi, $id);
if (!$mhs) {
    header("Location: tampil.php");
    exit;
}

// Proses Update ketika form di-submit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    $query_update = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan', email='$email' WHERE id='$id'";
    if (mysqli_query($koneksi, $query_update)) {
        header("Location: tampil.php?pesan=diubah");
        exit;
    }
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4 bg-white">
            <h3 class="mb-4">Edit Data Mahasiswa</h3>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($mhs['nim']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($mhs['nama']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select">
                        <option value="Pendidikan Informatika" <?= $mhs['jurusan'] == 'Pendidikan Informatika' ? 'selected' : ''; ?>>Pendidikan Informatika</option>
                        <option value="Teknik Informatika" <?= $mhs['jurusan'] == 'Teknik Informatika' ? 'selected' : ''; ?>>Teknik Informatika</option>
                        <option value="Sistem Informasi" <?= $mhs['jurusan'] == 'Sistem Informasi' ? 'selected' : ''; ?>>Sistem Informasi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($mhs['email']); ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="tampil.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-warning">Perbarui Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>