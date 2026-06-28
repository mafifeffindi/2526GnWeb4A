<?php
// ============================================================
// index.php — Beranda (Home)
// ============================================================
session_start();
require 'koneksi.php';
require 'functions.php';

$pageTitle = 'Beranda';
$activeNav = 'beranda';

// Hitung ringkasan keuangan
$ringkasan = hitungRingkasan($conn);
$masuk  = $ringkasan['masuk'];
$keluar = $ringkasan['keluar'];
$saldo  = $ringkasan['saldo'];

// Hitung persentase untuk donut ring
$total    = $masuk + $keluar;
$pctMasuk = $total > 0 ? round(($masuk  / $total) * 100) : 0;
$pctKeluar= $total > 0 ? round(($keluar / $total) * 100) : 0;

// SVG donut parameters
$r = 44; $cx = 60; $cy = 60;
$circumference = 2 * M_PI * $r; // ≈ 276.46
$dashMasuk  = ($circumference * $pctMasuk)  / 100;
$dashKeluar = ($circumference * $pctKeluar) / 100;
$offsetKeluar = $circumference - $dashMasuk; // keluar starts after masuk arc

// Ambil 5 transaksi terbaru
$recent = $conn->query(
    "SELECT * FROM catatan ORDER BY tanggal DESC, id DESC LIMIT 5"
);

// Jumlah total catatan
$totalCatatan = $conn->query("SELECT COUNT(*) AS n FROM catatan")->fetch_assoc()['n'];

include 'header.php';
?>

<div class="page-header">
  <p class="eyebrow">Dashboard</p>
  <h2>Ringkasan Keuangan</h2>
  <p>Pantau pemasukan, pengeluaran, dan saldo kamu.</p>
</div>

<?= getFlash() ?>

<!-- Summary Cards -->
<div class="summary-grid">
  <div class="summary-card card-saldo">
    <p class="card-label">Saldo Saat Ini</p>
    <p class="card-amount <?= $saldo >= 0 ? 'positive' : 'negative' ?>">
      <?= formatRupiah(abs($saldo)) ?>
    </p>
    <p class="card-sub"><?= $saldo >= 0 ? 'Keuangan sehat' : 'Pengeluaran melebihi pemasukan' ?></p>
  </div>

  <div class="summary-card card-masuk">
    <p class="card-label">Total Pemasukan</p>
    <p class="card-amount positive"><?= formatRupiah($masuk) ?></p>
    <p class="card-sub"><?= $pctMasuk ?>% dari total transaksi</p>
  </div>

  <div class="summary-card card-keluar">
    <p class="card-label">Total Pengeluaran</p>
    <p class="card-amount negative"><?= formatRupiah($keluar) ?></p>
    <p class="card-sub"><?= $pctKeluar ?>% dari total transaksi</p>
  </div>
</div>

<!-- Balance Ring -->
<div class="ring-wrapper">
  <div class="ring-container">
    <svg viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
      <!-- Track -->
      <circle class="ring-track" cx="<?= $cx ?>" cy="<?= $cy ?>" r="<?= $r ?>"/>

      <?php if ($total > 0): ?>
        <!-- Masuk arc -->
        <circle class="ring-masuk" cx="<?= $cx ?>" cy="<?= $cy ?>" r="<?= $r ?>"
          stroke-dasharray="<?= round($dashMasuk, 2) ?> <?= round($circumference - $dashMasuk, 2) ?>"
          stroke-dashoffset="0"/>
        <!-- Keluar arc (starts after masuk) -->
        <circle class="ring-keluar" cx="<?= $cx ?>" cy="<?= $cy ?>" r="<?= $r ?>"
          stroke-dasharray="<?= round($dashKeluar, 2) ?> <?= round($circumference - $dashKeluar, 2) ?>"
          stroke-dashoffset="-<?= round($dashMasuk, 2) ?>"/>
      <?php else: ?>
        <circle class="ring-track" cx="<?= $cx ?>" cy="<?= $cy ?>" r="<?= $r ?>"
          stroke-dasharray="<?= round($circumference * 0.5, 2) ?> <?= round($circumference * 0.5, 2) ?>"/>
      <?php endif; ?>
    </svg>
    <div class="ring-center">
      <strong><?= $totalCatatan ?></strong>
      CATATAN
    </div>
  </div>

  <div class="ring-legend">
    <h3>Alokasi Keuangan</h3>
    <div class="legend-row">
      <span class="legend-dot mint"></span>
      <span class="legend-label">Pemasukan</span>
      <span class="legend-val mint"><?= formatRupiah($masuk) ?></span>
    </div>
    <div class="legend-row">
      <span class="legend-dot coral"></span>
      <span class="legend-label">Pengeluaran</span>
      <span class="legend-val coral"><?= formatRupiah($keluar) ?></span>
    </div>
    <div class="legend-row" style="margin-top:14px;padding-top:14px;border-top:1px solid var(--border)">
      <span class="legend-dot" style="background:var(--text)"></span>
      <span class="legend-label"><strong style="color:var(--text)">Saldo Bersih</strong></span>
      <span class="legend-val" style="color:<?= $saldo >= 0 ? 'var(--mint)' : 'var(--coral)' ?>">
        <?= ($saldo >= 0 ? '+' : '-') . formatRupiah(abs($saldo)) ?>
      </span>
    </div>
  </div>
</div>

<!-- Recent Transactions Table -->
<div class="table-card">
  <div class="table-card-header">
    <h3>Transaksi Terbaru</h3>
    <a href="daftar.php" style="font-size:.82rem;color:var(--mint);font-weight:600;">
      Lihat semua →
    </a>
  </div>

  <?php if ($recent && $recent->num_rows > 0): ?>
  <table>
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Tipe</th>
        <th style="text-align:right">Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $recent->fetch_assoc()): ?>
      <tr>
        <td class="date-cell"><?= formatTanggal($row['tanggal']) ?></td>
        <td><?= bersihkan($row['deskripsi']) ?></td>
        <td style="color:var(--muted);font-size:.82rem"><?= bersihkan($row['kategori']) ?></td>
        <td>
          <span class="type-badge <?= $row['tipe'] ?>">
            <?= $row['tipe'] === 'masuk' ? 'Pemasukan' : 'Pengeluaran' ?>
          </span>
        </td>
        <td style="text-align:right">
          <span class="amount-cell <?= $row['tipe'] ?>">
            <?= ($row['tipe'] === 'masuk' ? '+' : '-') . formatRupiah($row['jumlah']) ?>
          </span>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
  <div class="empty-state">
    <div class="empty-icon"></div>
    <p>Belum ada catatan keuangan.<br>
      <a href="tambah.php" style="color:var(--mint)">Tambah catatan pertamamu →</a>
    </p>
  </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
