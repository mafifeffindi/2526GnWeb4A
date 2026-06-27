<?php
// index.php - Halaman Beranda
require 'koneksi.php';
require 'functions.php';

$judul_halaman = 'Beranda';

$total_buku = hitung_total_buku($koneksi);
$total_stok  = hitung_total_stok($koneksi);

// Hitung jumlah genre unik
$result_genre = mysqli_query($koneksi, "SELECT COUNT(DISTINCT genre) as total FROM buku");
$row_genre = mysqli_fetch_assoc($result_genre);
$total_genre = $row_genre['total'];

// Ambil 6 buku terbaru
$buku_terbaru = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id DESC LIMIT 6");

include 'header.php';
?>

<!-- Hero Section -->
<div class="hero">
    <h1>📚 Sistem Pendataan Buku</h1>
    <p>Kelola koleksi buku perpustakaan dengan mudah, cepat, dan terorganisir.</p>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="tambah.php" class="btn btn-lg" style="background:white;color:var(--primary);">➕ Tambah Buku</a>
        <a href="daftar.php" class="btn btn-lg" style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.4);">📋 Lihat Semua</a>
    </div>
</div>

<!-- Statistik -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon blue">📚</div>
        <div class="stat-info">
            <h3><?php echo $total_buku; ?></h3>
            <p>Total Judul Buku</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">📦</div>
        <div class="stat-info">
            <h3><?php echo $total_stok; ?></h3>
            <p>Total Stok Buku</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon purple">🏷️</div>
        <div class="stat-info">
            <h3><?php echo $total_genre; ?></h3>
            <p>Genre Tersedia</p>
        </div>
    </div>
</div>

<!-- Buku Terbaru -->
<div class="card">
    <div class="card-header">
        <h2>📖 Buku Terbaru Ditambahkan</h2>
        <a href="daftar.php" class="btn btn-outline btn-sm">Lihat Semua →</a>
    </div>
    <div class="card-body">
        <?php if (mysqli_num_rows($buku_terbaru) > 0): ?>
        <div class="book-grid">
            <?php
            $nomor = 1;
            while ($buku = mysqli_fetch_assoc($buku_terbaru)):
            ?>
            <div class="book-card">
                <div class="book-card-title"><?php echo htmlspecialchars($buku['judul']); ?></div>
                <div class="book-card-author">✍️ <?php echo htmlspecialchars($buku['pengarang']); ?></div>
                <span class="badge-genre"><?php echo htmlspecialchars($buku['genre']); ?></span>
                <div class="book-card-meta">
                    <span>📅 <?php echo $buku['tahun_terbit']; ?></span>
                    <?php echo format_stok($buku['stok']); ?>
                </div>
            </div>
            <?php
            $nomor++;
            endwhile;
            ?>
        </div>
        <?php else: ?>
        <div class="empty-state">
            <div class="icon">📭</div>
            <h3>Belum ada buku</h3>
            <p>Mulai tambahkan buku pertama kamu!</p>
            <br>
            <a href="tambah.php" class="btn btn-primary">➕ Tambah Buku</a>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
