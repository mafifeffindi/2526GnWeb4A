<?php
// edit.php - Halaman Edit Data Buku
require 'koneksi.php';
require 'functions.php';

$judul_halaman = 'Edit Buku';

// Cek ID dari GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: daftar.php');
    exit;
}

$id = (int)$_GET['id'];
$buku = get_buku_by_id($koneksi, $id);

// Percabangan: cek apakah data buku ditemukan
if (!$buku) {
    header('Location: daftar.php?notif=tidak_ditemukan');
    exit;
}

$error = '';

// Proses Form POST (Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul      = bersihkan_input($_POST['judul'] ?? '', $koneksi);
    $pengarang  = bersihkan_input($_POST['pengarang'] ?? '', $koneksi);
    $penerbit   = bersihkan_input($_POST['penerbit'] ?? '', $koneksi);
    $tahun      = (int)($_POST['tahun_terbit'] ?? 0);
    $genre      = bersihkan_input($_POST['genre'] ?? '', $koneksi);
    $stok       = (int)($_POST['stok'] ?? 0);
    $deskripsi  = bersihkan_input($_POST['deskripsi'] ?? '', $koneksi);

    // Validasi
    if (empty($judul) || empty($pengarang) || empty($penerbit) || empty($genre)) {
        $error = 'Semua field bertanda bintang (*) wajib diisi!';
    } elseif ($tahun < 1000 || $tahun > date('Y')) {
        $error = 'Tahun terbit tidak valid!';
    } elseif ($stok < 0) {
        $error = 'Stok tidak boleh negatif!';
    } else {
        $sql = "UPDATE buku SET
                    judul = '$judul',
                    pengarang = '$pengarang',
                    penerbit = '$penerbit',
                    tahun_terbit = $tahun,
                    genre = '$genre',
                    stok = $stok,
                    deskripsi = '$deskripsi'
                WHERE id = $id";

        if (mysqli_query($koneksi, $sql)) {
            header('Location: daftar.php?notif=edit_berhasil');
            exit;
        } else {
            $error = 'Gagal memperbarui data: ' . mysqli_error($koneksi);
        }
    }
}

// Daftar genre
$daftar_genre = ['Novel', 'Roman', 'Sejarah', 'Nonfiksi', 'Pengembangan Diri', 'Fantasi', 'Sains', 'Teknologi', 'Agama', 'Biografi', 'Anak-anak', 'Komedi', 'Misteri', 'Lainnya'];

include 'header.php';
?>

<div class="page-header">
    <h1>✏️ Edit Data Buku</h1>
    <p>Perbarui informasi buku yang sudah ada.</p>
</div>

<?php if (!empty($error)): tampilkan_notif($error, 'error'); endif; ?>

<!-- Detail buku sebelum diedit -->
<div class="card" style="margin-bottom:20px; border-left:4px solid var(--warning);">
    <div class="card-body" style="padding:16px 20px;">
        <p style="font-size:0.85rem;color:var(--gray);margin-bottom:4px;">Sedang mengedit buku:</p>
        <strong><?php echo htmlspecialchars($buku['judul']); ?></strong>
        <span style="color:var(--gray);"> — <?php echo htmlspecialchars($buku['pengarang']); ?></span>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2>📝 Formulir Edit Buku</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Judul Buku <span>*</span></label>
                    <input type="text" name="judul" class="form-control"
                           value="<?php echo htmlspecialchars(isset($_POST['judul']) ? $_POST['judul'] : $buku['judul']); ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Pengarang <span>*</span></label>
                    <input type="text" name="pengarang" class="form-control"
                           value="<?php echo htmlspecialchars(isset($_POST['pengarang']) ? $_POST['pengarang'] : $buku['pengarang']); ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Penerbit <span>*</span></label>
                    <input type="text" name="penerbit" class="form-control"
                           value="<?php echo htmlspecialchars(isset($_POST['penerbit']) ? $_POST['penerbit'] : $buku['penerbit']); ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tahun Terbit <span>*</span></label>
                    <input type="number" name="tahun_terbit" class="form-control"
                           min="1000" max="<?php echo date('Y'); ?>"
                           value="<?php echo isset($_POST['tahun_terbit']) ? htmlspecialchars($_POST['tahun_terbit']) : $buku['tahun_terbit']; ?>"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Genre <span>*</span></label>
                    <select name="genre" class="form-control" required>
                        <option value="">-- Pilih Genre --</option>
                        <?php
                        $genre_saat_ini = isset($_POST['genre']) ? $_POST['genre'] : $buku['genre'];
                        // Perulangan: tampilkan opsi genre
                        foreach ($daftar_genre as $g):
                            $selected = ($genre_saat_ini === $g) ? 'selected' : '';
                        ?>
                        <option value="<?php echo $g; ?>" <?php echo $selected; ?>><?php echo $g; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control"
                           min="0"
                           value="<?php echo isset($_POST['stok']) ? htmlspecialchars($_POST['stok']) : $buku['stok']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4"><?php echo htmlspecialchars(isset($_POST['deskripsi']) ? $_POST['deskripsi'] : ($buku['deskripsi'] ?? '')); ?></textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-warning btn-lg">💾 Perbarui Data</button>
                <a href="daftar.php" class="btn btn-outline btn-lg">✕ Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
