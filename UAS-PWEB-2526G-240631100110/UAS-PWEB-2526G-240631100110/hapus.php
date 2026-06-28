<?php
// ============================================================
// hapus.php — Hapus Catatan (DELETE)
// ============================================================
session_start();
require 'koneksi.php';
require 'functions.php';

$pageTitle = 'Hapus Catatan';
$activeNav = 'daftar';

$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    setFlash('error', 'ID catatan tidak valid.');
    redirect('daftar.php');
}

// Ambil data
$stmt = $conn->prepare("SELECT * FROM catatan WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$catatan = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$catatan) {
    setFlash('error', 'Catatan tidak ditemukan.');
    redirect('daftar.php');
}

// Konfirmasi hapus via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['konfirmasi'])) {
    $del = $conn->prepare("DELETE FROM catatan WHERE id = ?");
    $del->bind_param('i', $id);

    if ($del->execute()) {
        setFlash('sukses', "Catatan \"" . bersihkan($catatan['deskripsi']) . "\" berhasil dihapus.");
        redirect('daftar.php');
    } else {
        setFlash('error', 'Gagal menghapus catatan.');
        redirect('daftar.php');
    }
    $del->close();
}

include 'header.php';
?>

<div class="page-header">
  <p class="eyebrow">Konfirmasi</p>
  <h2>Hapus Catatan</h2>
  <p>Tindakan ini tidak dapat dibatalkan.</p>
</div>

<div class="confirm-card">
  <h3>Yakin ingin menghapus?</h3>
  <p>Catatan berikut akan dihapus secara permanen dari sistem dan tidak bisa dikembalikan.</p>

  <div class="item-preview">
    <div style="margin-bottom:6px">
      <span style="color:var(--muted);font-size:.78rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase">Deskripsi</span><br>
      <strong><?= bersihkan($catatan['deskripsi']) ?></strong>
    </div>
    <div style="display:flex;gap:24px;flex-wrap:wrap">
      <div>
        <span style="color:var(--muted);font-size:.78rem">Jumlah</span><br>
        <span style="font-family:'JetBrains Mono',monospace;font-weight:600;color:<?= $catatan['tipe']==='masuk'?'var(--mint)':'var(--coral)' ?>">
          <?= formatRupiah($catatan['jumlah']) ?>
        </span>
      </div>
      <div>
        <span style="color:var(--muted);font-size:.78rem">Tipe</span><br>
        <span class="type-badge <?= $catatan['tipe'] ?>">
          <?= $catatan['tipe'] === 'masuk' ? 'Pemasukan' : 'Pengeluaran' ?>
        </span>
      </div>
      <div>
        <span style="color:var(--muted);font-size:.78rem">Tanggal</span><br>
        <span style="color:var(--muted);font-size:.85rem"><?= formatTanggal($catatan['tanggal']) ?></span>
      </div>
    </div>
  </div>

  <form method="POST" action="hapus.php?id=<?= $id ?>">
    <input type="hidden" name="konfirmasi" value="1">
    <div class="btn-group" style="justify-content:center">
      <button type="submit" class="btn btn-danger">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        Ya, Hapus Sekarang
      </button>
      <a href="daftar.php" class="btn btn-secondary">Batal</a>
    </div>
  </form>
</div>

<?php include 'footer.php'; ?>
