<?php
// ============================================================
// daftar.php — Daftar Semua Catatan (READ)
// ============================================================
session_start();
require 'koneksi.php';
require 'functions.php';

$pageTitle = 'Semua Catatan';
$activeNav = 'daftar';

// ── Filter via GET ─────────────────────────────────────────
$filterTipe = $_GET['tipe'] ?? '';
$filterBulan= $_GET['bulan'] ?? '';
$search     = trim($_GET['q'] ?? '');

$where  = [];
$params = [];
$types  = '';

if ($filterTipe && in_array($filterTipe, ['masuk', 'keluar'])) {
    $where[]  = 'tipe = ?';
    $params[] = $filterTipe;
    $types   .= 's';
}
if ($filterBulan) {
    $where[]  = 'DATE_FORMAT(tanggal, "%Y-%m") = ?';
    $params[] = $filterBulan;
    $types   .= 's';
}
if ($search) {
    $where[]  = '(deskripsi LIKE ? OR kategori LIKE ?)';
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types   .= 'ss';
}

$whereSQL = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

// ── Pagination ─────────────────────────────────────────────
$perPage = 10;
$page    = max(1, (int)($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;

// Count total
$countSQL = "SELECT COUNT(*) AS n FROM catatan $whereSQL";
if ($params) {
    $countStmt = $conn->prepare($countSQL);
    $countStmt->bind_param($types, ...$params);
    $countStmt->execute();
    $totalRows = $countStmt->get_result()->fetch_assoc()['n'];
} else {
    $totalRows = $conn->query($countSQL)->fetch_assoc()['n'];
}
$totalPages = max(1, ceil($totalRows / $perPage));
$page = min($page, $totalPages);
$offset = ($page - 1) * $perPage;

// Fetch data
$dataSQL = "SELECT * FROM catatan $whereSQL ORDER BY tanggal DESC, id DESC LIMIT $perPage OFFSET $offset";
if ($params) {
    $dataStmt = $conn->prepare($dataSQL);
    $dataStmt->bind_param($types, ...$params);
    $dataStmt->execute();
    $data = $dataStmt->get_result();
} else {
    $data = $conn->query($dataSQL);
}

// Ringkasan (filtered)
$sumSQL = "SELECT tipe, SUM(jumlah) AS total FROM catatan $whereSQL GROUP BY tipe";
$sumMasuk = 0; $sumKeluar = 0;
if ($params) {
    $sumStmt = $conn->prepare($sumSQL);
    $sumStmt->bind_param($types, ...$params);
    $sumStmt->execute();
    $sumResult = $sumStmt->get_result();
} else {
    $sumResult = $conn->query($sumSQL);
}
while ($sr = $sumResult->fetch_assoc()) {
    if ($sr['tipe'] === 'masuk')  $sumMasuk  = (float)$sr['total'];
    if ($sr['tipe'] === 'keluar') $sumKeluar = (float)$sr['total'];
}

// Build pagination URL helper
function pageUrl(int $p): string {
    $q = $_GET;
    $q['page'] = $p;
    return 'daftar.php?' . http_build_query($q);
}

include 'header.php';
?>

<div class="page-header">
  <p class="eyebrow">Riwayat</p>
  <h2>Semua Catatan</h2>
  <p>Total <?= $totalRows ?> catatan ditemukan.</p>
</div>

<?= getFlash() ?>

<!-- Filter Bar -->
<form method="GET" action="daftar.php" class="filter-bar">
  <input type="text" name="q" placeholder="Cari deskripsi / kategori..." value="<?= htmlspecialchars($search) ?>" style="flex:1;min-width:180px">

  <select name="tipe" onchange="this.form.submit()">
    <option value="">Semua Tipe</option>
    <option value="masuk"  <?= $filterTipe === 'masuk'  ? 'selected' : '' ?>>Pemasukan</option>
    <option value="keluar" <?= $filterTipe === 'keluar' ? 'selected' : '' ?>>Pengeluaran</option>
  </select>

  <input type="month" name="bulan" value="<?= htmlspecialchars($filterBulan) ?>" onchange="this.form.submit()" title="Filter bulan">

  <button type="submit" class="btn btn-secondary" style="padding:9px 16px;font-size:.85rem">Cari</button>

  <?php if ($search || $filterTipe || $filterBulan): ?>
  <a href="daftar.php" class="btn btn-secondary" style="padding:9px 16px;font-size:.85rem">✕ Reset</a>
  <?php endif; ?>

  <a href="tambah.php" class="btn btn-primary" style="margin-left:auto">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><path d="M12 5v14M5 12h14"/></svg>
    Tambah
  </a>
</form>

<!-- Mini Summary Strip -->
<?php if ($sumMasuk > 0 || $sumKeluar > 0): ?>
<div style="display:flex;gap:12px;margin-bottom:16px;flex-wrap:wrap">
  <div style="background:var(--mint-dim);border:1px solid var(--mint);border-radius:8px;padding:8px 16px;font-size:.82rem">
    <span style="color:var(--muted)">Pemasukan</span>
    <strong style="color:var(--mint);margin-left:8px;font-family:'JetBrains Mono',monospace"><?= formatRupiah($sumMasuk) ?></strong>
  </div>
  <div style="background:var(--coral-dim);border:1px solid var(--coral);border-radius:8px;padding:8px 16px;font-size:.82rem">
    <span style="color:var(--muted)">Pengeluaran</span>
    <strong style="color:var(--coral);margin-left:8px;font-family:'JetBrains Mono',monospace"><?= formatRupiah($sumKeluar) ?></strong>
  </div>
  <div style="background:var(--surface);border:1px solid var(--border);border-radius:8px;padding:8px 16px;font-size:.82rem">
    <span style="color:var(--muted)">Selisih</span>
    <?php $selisih = $sumMasuk - $sumKeluar; ?>
    <strong style="color:<?= $selisih >= 0 ? 'var(--mint)' : 'var(--coral)' ?>;margin-left:8px;font-family:'JetBrains Mono',monospace">
      <?= ($selisih >= 0 ? '+' : '') . formatRupiah($selisih) ?>
    </strong>
  </div>
</div>
<?php endif; ?>

<!-- Data Table -->
<div class="table-card">
  <div class="table-card-header">
    <h3>Daftar Transaksi</h3>
    <span>Halaman <?= $page ?> / <?= $totalPages ?></span>
  </div>

  <?php if ($data && $data->num_rows > 0): ?>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Tanggal</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Tipe</th>
        <th style="text-align:right">Jumlah</th>
        <th style="text-align:center">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = $offset + 1;
      while ($row = $data->fetch_assoc()):
      ?>
      <tr>
        <td style="color:var(--muted2);font-size:.78rem"><?= $no++ ?></td>
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
        <td style="text-align:center">
          <div class="action-btns" style="justify-content:center">
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn-icon" title="Edit">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
            </a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-icon danger" title="Hapus">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
            </a>
          </div>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <?php if ($totalPages > 1): ?>
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="<?= pageUrl($page - 1) ?>">‹</a>
    <?php endif; ?>

    <?php for ($i = max(1,$page-2); $i <= min($totalPages,$page+2); $i++): ?>
      <?php if ($i === $page): ?>
        <span class="current"><?= $i ?></span>
      <?php else: ?>
        <a href="<?= pageUrl($i) ?>"><?= $i ?></a>
      <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page < $totalPages): ?>
      <a href="<?= pageUrl($page + 1) ?>">›</a>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <?php else: ?>
  <div class="empty-state">
    <div class="empty-icon"></div>
    <p>Tidak ada catatan yang sesuai filter.<br>
      <a href="daftar.php" style="color:var(--mint)">Reset filter →</a>
    </p>
  </div>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
