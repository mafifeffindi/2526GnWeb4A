<?php
// hapus.php - Halaman Konfirmasi & Proses Hapus Buku
require 'koneksi.php';
require 'functions.php';

$judul_halaman = 'Hapus Buku';

// Cek ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: daftar.php');
    exit;
}

$id = (int)$_GET['id'];
$buku = get_buku_by_id($koneksi, $id);

// Percabangan: buku tidak ditemukan
if (!$buku) {
    header('Location: daftar.php');
    exit;
}

// Jika user konfirmasi hapus (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['konfirmasi_hapus'])) {
    $sql = "DELETE FROM buku WHERE id = $id";
    if (mysqli_query($koneksi, $sql)) {
        header('Location: daftar.php?notif=hapus_berhasil');
        exit;
    } else {
        $error = 'Gagal menghapus data: ' . mysqli_error($koneksi);
    }
}

include 'header.php';
?>

<div class="page-header">
    <h1>🗑️ Hapus Buku</h1>
    <p>Pastikan Anda yakin sebelum menghapus data.</p>
</div>

<?php if (isset($error)): tampilkan_notif($error, 'error'); endif; ?>

<div class="card" style="max-width:600px; margin:0 auto;">
    <div class="card-body">
        <div class="confirm-box">
            <div class="icon">⚠️</div>
            <h3>Konfirmasi Hapus Data</h3>
            <p>Apakah Anda yakin ingin menghapus buku berikut? Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
        </div>

        <!-- Detail buku yang akan dihapus -->
        <div class="detail-grid" style="margin-bottom:24px;">
            <div class="detail-item">
                <label>Judul Buku</label>
                <p><?php echo htmlspecialchars($buku['judul']); ?></p>
            </div>
            <div class="detail-item">
                <label>Pengarang</label>
                <p><?php echo htmlspecialchars($buku['pengarang']); ?></p>
            </div>
            <div class="detail-item">
                <label>Penerbit</label>
                <p><?php echo htmlspecialchars($buku['penerbit']); ?></p>
            </div>
            <div class="detail-item">
                <label>Tahun Terbit</label>
                <p><?php echo $buku['tahun_terbit']; ?></p>
            </div>
            <div class="detail-item">
                <label>Genre</label>
                <p><span class="badge-genre"><?php echo htmlspecialchars($buku['genre']); ?></span></p>
            </div>
            <div class="detail-item">
                <label>Stok</label>
                <p><?php echo format_stok($buku['stok']); ?></p>
            </div>
            <?php if (!empty($buku['deskripsi'])): ?>
            <div class="detail-item detail-full">
                <label>Deskripsi</label>
                <p><?php echo htmlspecialchars($buku['deskripsi']); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Form konfirmasi hapus (POST) -->
        <form method="POST" action="hapus.php?id=<?php echo $id; ?>">
            <div class="form-actions" style="justify-content:center;">
                <button type="submit" name="konfirmasi_hapus" class="btn btn-danger btn-lg">
                    🗑️ Ya, Hapus Buku Ini
                </button>
                <a href="daftar.php" class="btn btn-outline btn-lg">✕ Batal</a>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
