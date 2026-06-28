<?php 
require 'fungsi.php';

// Form Processing (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nim     = mysqli_real_escape_string($koneksi, $_POST['nim']);
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
    $email   = mysqli_real_escape_string($koneksi, $_POST['email']);

    // Percabangan validasi input sederhana
    if (!empty($nim) && !empty($nama)) {
        $query = "INSERT INTO mahasiswa (nim, nama, jurusan, email) VALUES ('$nim', '$nama', '$jurusan', '$email')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: tampil.php?pesan=disimpan");
            exit;
        }
    } else {
        $error = "NIM dan Nama tidak boleh kosong!";
    }
}

include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm p-4 bg-white">
            <h3 class="mb-4">Tambah Data Mahasiswa</h3>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?= $error; ?></div>
            <?php endif; ?>

            <form action="tambah.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text" name="nim" class="form-control" placeholder="Contoh: 240631100012" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jurusan</label>
                    <select name="jurusan" class="form-select">
                        <option value="Pendidikan Informatika">Pendidikan Informatika</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="tampil.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>