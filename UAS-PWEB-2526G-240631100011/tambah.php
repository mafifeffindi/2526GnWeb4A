<?php
// tambah.php - Halaman Tambah Buku
require 'koneksi.php';
require 'functions.php';

$judul_halaman = 'Tambah Buku';
$error = '';
$success = '';

// Proses Form POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi dan bersihkan input
    $judul      = bersihkan_input($_POST['judul'] ?? '', $koneksi);
    $pengarang  = bersihkan_input($_POST['pengarang'] ?? '', $koneksi);
    $penerbit   = bersihkan_input($_POST['penerbit'] ?? '', $koneksi);
    $tahun      = (int)($_POST['tahun_terbit'] ?? 0);
    $genre      = bersihkan_input($_POST['genre'] ?? '', $koneksi);
    $stok       = (int)($_POST['stok'] ?? 0);
    $deskripsi  = bersihkan_input($_POST['deskripsi'] ?? '', $koneksi);

    // Percabangan: validasi input
    if (empty($judul) || empty($pengarang) || empty($penerbit) || empty($genre)) {
        $error = 'Semua field bertanda bintang (*) wajib diisi!';
    } elseif ($tahun < 1000 || $tahun > date('Y')) {
        $error = 'Tahun terbit tidak valid!';
    } elseif ($stok < 0) {
        $error = 'Stok tidak boleh negatif!';
    } else {
        // Simpan ke database
        $sql = "INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, genre, stok, deskripsi)
                VALUES ('$judul', '$pengarang', '$penerbit', $tahun, '$genre', $stok, '$deskripsi')";

        if (mysqli_query($koneksi, $sql)) {
            header('Location: daftar.php?notif=tambah_berhasil');
            exit;
        } else {
            $error = 'Gagal menyimpan data: ' . mysqli_error($koneksi);
        }
    }
}

// Daftar genre
$daftar_genre = ['Novel', 'Roman', 'Sejarah', 'Nonfiksi', 'Pengembangan Diri', 'Fantasi', 'Sains', 'Teknologi', 'Agama', 'Biografi', 'Anak-anak', 'Komedi', 'Misteri', 'Lainnya'];

include 'header.php';
?>

<div class="page-header">
    <h1>➕ Tambah Buku Baru</h1>
    <p>Isi formulir berikut untuk menambahkan buku baru ke dalam sistem.</p>
</div>

<?php if (!empty($error)): tampilkan_notif($error, 'error'); endif; ?>

<div class="card">
    <div class="card-header">
        <h2>📝 Formulir Data Buku</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="tambah.php">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Judul Buku <span>*</span></label>
                    <input type="text" name="judul" class="form-control"
                           placeholder="Contoh: Laskar Pelangi"
                           value="<?php echo isset($_POST['judul']) ? htmlspecialchars($_POST['judul']) : ''; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pengarang <span>*</span></label>
                    <input type="text" name="pengarang" class="form-control"
                           placeholder="Contoh: Andrea Hirata"
                           value="<?php echo isset($_POST['pengarang']) ? htmlspecialchars($_POST['pengarang']) : ''; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Penerbit <span>*</span></label>
                    <input type="text" name="penerbit" class="form-control"
                           placeholder="Contoh: Gramedia"
                           value="<?php echo isset($_POST['penerbit']) ? htmlspecialchars($_POST['penerbit']) : ''; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tahun Terbit <span>*</span></label>
                    <input type="number" name="tahun_terbit" class="form-control"
                           placeholder="Contoh: 2020"
                           min="1000" max="<?php echo date('Y'); ?>"
                           value="<?php echo isset($_POST['tahun_terbit']) ? htmlspecialchars($_POST['tahun_terbit']) : ''; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Genre <span>*</span></label>
                    <select name="genre" class="form-control" required>
                        <option value="">-- Pilih Genre --</option>
                        <?php
                        // Perulangan: generate opsi genre
                        foreach ($daftar_genre as $g):
                            $selected = (isset($_POST['genre']) && $_POST['genre'] === $g) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $g; ?>" <?php echo $selected; ?>><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control"
                           placeholder="0"
                           min="0"
                           value="<?php echo isset($_POST['stok']) ? htmlspecialchars($_POST['stok']) : '0'; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"
                          placeholder="Tuliskan sinopsis atau deskripsi singkat buku..."><?php echo isset($_POST['deskripsi']) ? htmlspecialchars($_POST['deskripsi']) : ''; ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg">💾 Simpan Buku</button>
                <a href="daftar.php" class="btn btn-outline btn-lg">✕ Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
