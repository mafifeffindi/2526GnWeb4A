<?php
// daftar.php - Halaman Daftar Buku
require 'koneksi.php';
require 'functions.php';

$judul_halaman = 'Daftar Buku';

// Tangani pencarian (GET)
$keyword = '';
if (isset($_GET['cari']) && !empty($_GET['cari'])) {
    $keyword = $_GET['cari'];
}

$hasil_buku = get_semua_buku($koneksi, $keyword);
$jumlah = mysqli_num_rows($hasil_buku);

include 'header.php';
?>

<div class="page-header">
    <h1>📋 Daftar Buku</h1>
    <p>Menampilkan seluruh koleksi buku yang tersedia.</p>
</div>

<?php
// Tampilkan notifikasi dari redirect
if (isset($_GET['notif'])) {
    if ($_GET['notif'] === 'tambah_berhasil') {
        tampilkan_notif('Buku berhasil ditambahkan!');
    } elseif ($_GET['notif'] === 'edit_berhasil') {
        tampilkan_notif('Data buku berhasil diperbarui!');
    } elseif ($_GET['notif'] === 'hapus_berhasil') {
        tampilkan_notif('Buku berhasil dihapus!', 'error');
    }
}
?>

<div class="card">
    <div class="card-header">
        <h2>📚 Koleksi Buku (<?php echo $jumlah; ?> data)</h2>
        <div style="display:flex; gap:10px; align-items:center;">
            <!-- Form Pencarian GET -->
            <form method="GET" class="search-bar">
                <input type="text" name="cari" placeholder="🔍 Cari judul, pengarang, genre..." value="<?php echo htmlspecialchars($keyword); ?>">
                <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                <?php if (!empty($keyword)): ?>
                    <a href="daftar.php" class="btn btn-outline btn-sm">✕ Reset</a>
                <?php endif; ?>
            </form>
            <a href="tambah.php" class="btn btn-primary btn-sm">➕ Tambah</a>
        </div>
    </div>

    <div class="table-responsive">
        <?php if ($jumlah > 0): ?>
        <table>
            <thead>
                <tr>
                    <th class="td-no">No</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Genre</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                while ($buku = mysqli_fetch_assoc($hasil_buku)):
                ?>
                <tr>
                    <td class="td-no"><?php echo $nomor++; ?></td>
                    <td>
                        <strong><?php echo htmlspecialchars($buku['judul']); ?></strong>
                    </td>
                    <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                    <td><?php echo htmlspecialchars($buku['penerbit']); ?></td>
                    <td><?php echo $buku['tahun_terbit']; ?></td>
                    <td><span class="badge-genre"><?php echo htmlspecialchars($buku['genre']); ?></span></td>
                    <td><?php echo format_stok($buku['stok']); ?></td>
                    <td>
                        <div class="action-buttons">
                            <a href="edit.php?id=<?php echo $buku['id']; ?>" class="btn btn-warning btn-sm">✏️ Edit</a>
                            <a href="hapus.php?id=<?php echo $buku['id']; ?>" class="btn btn-danger btn-sm">🗑️ Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <div class="icon"><?php echo !empty($keyword) ? '🔍' : '📭'; ?></div>
            <h3><?php echo !empty($keyword) ? "Tidak ada hasil untuk \"$keyword\"" : 'Belum ada buku'; ?></h3>
            <p><?php echo !empty($keyword) ? 'Coba kata kunci lain.' : 'Mulai tambahkan buku pertama!'; ?></p>
            <br>
            <?php if (empty($keyword)): ?>
                <a href="tambah.php" class="btn btn-primary">➕ Tambah Buku</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
