<?php
// ============================================================
// edit.php — Edit Catatan Keuangan (UPDATE)
// ============================================================
session_start();
require 'koneksi.php';
require 'functions.php';

$pageTitle = 'Edit Catatan';
$activeNav = 'daftar';

// Ambil ID dari URL
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    setFlash('error', 'ID catatan tidak valid.');
    redirect('daftar.php');
}

// Ambil data yang akan diedit
$stmt = $conn->prepare("SELECT * FROM catatan WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$catatan = $result->fetch_assoc();
$stmt->close();

if (!$catatan) {
    setFlash('error', 'Catatan tidak ditemukan.');
    redirect('daftar.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deskripsi = bersihkan($_POST['deskripsi'] ?? '');
    $jumlah    = $_POST['jumlah'] ?? '';
    $tipe      = $_POST['tipe'] ?? '';
    $kategori  = bersihkan($_POST['kategori'] ?? '');
    $tanggal   = $_POST['tanggal'] ?? '';

    // Validasi
    if (empty($deskripsi))  $errors[] = 'Deskripsi wajib diisi.';
    if (!is_numeric($jumlah) || (float)$jumlah <= 0) $errors[] = 'Jumlah harus berupa angka lebih dari 0.';
    if (!in_array($tipe, ['masuk', 'keluar'])) $errors[] = 'Tipe transaksi tidak valid.';
    if (empty($kategori))   $errors[] = 'Kategori wajib diisi.';
    if (empty($tanggal))    $errors[] = 'Tanggal wajib diisi.';

    if (empty($errors)) {
        $jumlah = (float)$jumlah;

        $upd = $conn->prepare(
            "UPDATE catatan SET deskripsi=?, jumlah=?, tipe=?, kategori=?, tanggal=? WHERE id=?"
        );
        $upd->bind_param('sdsssi', $deskripsi, $jumlah, $tipe, $kategori, $tanggal, $id);

        if ($upd->execute()) {
            setFlash('sukses', "Catatan \"$deskripsi\" berhasil diperbarui!");
            redirect('daftar.php');
        } else {
            $errors[] = 'Gagal memperbarui data. Silakan coba lagi.';
        }
        $upd->close();
    }

    // Jika ada error, gunakan nilai POST
    $catatan['deskripsi'] = $_POST['deskripsi'];
    $catatan['jumlah']    = $_POST['jumlah'];
    $catatan['tipe']      = $_POST['tipe'];
    $catatan['kategori']  = $_POST['kategori'];
    $catatan['tanggal']   = $_POST['tanggal'];
}

$kategoriMasuk  = ['Gaji', 'Freelance', 'Beasiswa', 'Bisnis', 'Hadiah', 'Transfer Masuk', 'Lainnya'];
$kategoriKeluar = ['Makan & Minum', 'Transport', 'Belanja', 'Hiburan', 'Pendidikan', 'Kesehatan', 'Tagihan', 'Transfer Keluar', 'Lainnya'];

include 'header.php';
?>

<div class="page-header">
  <p class="eyebrow">Edit Catatan #<?= $id ?></p>
  <h2>Perbarui Data</h2>
  <p>Ubah detail catatan keuangan yang sudah ada.</p>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-error">
  <?php foreach ($errors as $e): ?><?= bersihkan($e) ?><br><?php endforeach; ?>
</div>
<?php endif; ?>

<div class="form-card">
  <form method="POST" action="edit.php?id=<?= $id ?>">

    <!-- Tipe -->
    <div class="form-group">
      <label for="tipe">Tipe Transaksi</label>
      <select name="tipe" id="tipe" required onchange="updateKategori(this.value)">
        <option value="" disabled>— Pilih tipe —</option>
        <option value="masuk"  <?= $catatan['tipe'] === 'masuk'  ? 'selected' : '' ?>>Pemasukan</option>
        <option value="keluar" <?= $catatan['tipe'] === 'keluar' ? 'selected' : '' ?>>Pengeluaran</option>
      </select>
    </div>

    <div class="form-row">
      <!-- Jumlah -->
      <div class="form-group">
        <label for="jumlah">Jumlah (Rp)</label>
        <input
          type="number"
          name="jumlah"
          id="jumlah"
          min="1"
          step="500"
          value="<?= htmlspecialchars($catatan['jumlah']) ?>"
          required
        >
      </div>

      <!-- Tanggal -->
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input
          type="date"
          name="tanggal"
          id="tanggal"
          value="<?= htmlspecialchars($catatan['tanggal']) ?>"
          required
        >
      </div>
    </div>

    <!-- Deskripsi -->
    <div class="form-group">
      <label for="deskripsi">Deskripsi</label>
      <input
        type="text"
        name="deskripsi"
        id="deskripsi"
        maxlength="200"
        value="<?= htmlspecialchars($catatan['deskripsi']) ?>"
        required
      >
    </div>

    <!-- Kategori -->
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" required>
        <option value="" disabled>— Pilih kategori —</option>
      </select>
    </div>

    <div class="btn-group">
      <button type="submit" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="16" height="16"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Perubahan
      </button>
      <a href="daftar.php" class="btn btn-secondary">Batal</a>
      <a href="hapus.php?id=<?= $id ?>" class="btn btn-danger" style="margin-left:auto">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
        Hapus
      </a>
    </div>

  </form>
</div>

<script>
const kategoriData = {
  masuk:  <?= json_encode($kategoriMasuk) ?>,
  keluar: <?= json_encode($kategoriKeluar) ?>
};
const savedKategori = <?= json_encode($catatan['kategori']) ?>;

function updateKategori(tipe) {
  const sel = document.getElementById('kategori');
  sel.innerHTML = '<option value="" disabled>— Pilih kategori —</option>';
  if (!tipe || !kategoriData[tipe]) return;
  kategoriData[tipe].forEach(k => {
    const opt = document.createElement('option');
    opt.value = k;
    opt.textContent = k;
    if (k === savedKategori) opt.selected = true;
    sel.appendChild(opt);
  });
}

// Init on load
updateKategori(document.getElementById('tipe').value);
</script>

<?php include 'footer.php'; ?>
