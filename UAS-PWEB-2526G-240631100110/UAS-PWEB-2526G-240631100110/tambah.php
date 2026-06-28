<?php
// ============================================================
// tambah.php — Tambah Catatan Keuangan (CREATE)
// ============================================================
session_start();
require 'koneksi.php';
require 'functions.php';

$pageTitle = 'Tambah Catatan';
$activeNav = 'tambah';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil & validasi input
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

        $stmt = $conn->prepare(
            "INSERT INTO catatan (deskripsi, jumlah, tipe, kategori, tanggal) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('sdsss', $deskripsi, $jumlah, $tipe, $kategori, $tanggal);

        if ($stmt->execute()) {
            setFlash('sukses', "Catatan \"$deskripsi\" berhasil ditambahkan!");
            redirect('index.php');
        } else {
            $errors[] = 'Gagal menyimpan data. Silakan coba lagi.';
        }
        $stmt->close();
    }
}

// Kategori berdasarkan tipe (dipakai JS untuk filter dinamis)
$kategoriMasuk  = ['Gaji', 'Freelance', 'Beasiswa', 'Bisnis', 'Hadiah', 'Transfer Masuk', 'Lainnya'];
$kategoriKeluar = ['Makan & Minum', 'Transport', 'Belanja', 'Hiburan', 'Pendidikan', 'Kesehatan', 'Tagihan', 'Transfer Keluar', 'Lainnya'];

include 'header.php';
?>

<div class="page-header">
  <p class="eyebrow">Transaksi Baru</p>
  <h2>Tambah Catatan</h2>
  <p>Catat pemasukan atau pengeluaran kamu hari ini.</p>
</div>

<?php if (!empty($errors)): ?>
<div class="alert alert-error">
  <?php foreach ($errors as $e): ?>
    <?= bersihkan($e) ?><br>
  <?php endforeach; ?>
</div>
<?php endif; ?>

<div class="form-card">
  <form method="POST" action="tambah.php" id="formTambah">

    <!-- Tipe Transaksi -->
    <div class="form-group">
      <label for="tipe">Tipe Transaksi</label>
      <select name="tipe" id="tipe" required onchange="updateKategori(this.value)">
        <option value="" disabled <?= empty($_POST['tipe']) ? 'selected' : '' ?>>— Pilih tipe —</option>
        <option value="masuk"  <?= ($_POST['tipe'] ?? '') === 'masuk'  ? 'selected' : '' ?>>Pemasukan</option>
        <option value="keluar" <?= ($_POST['tipe'] ?? '') === 'keluar' ? 'selected' : '' ?>>Pengeluaran</option>
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
          step="1"
          placeholder="cth. 150000"
          value="<?= htmlspecialchars($_POST['jumlah'] ?? '') ?>"
          required
        >
        <p class="form-hint">Masukkan angka tanpa titik/koma.</p>
      </div>

      <!-- Tanggal -->
      <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input
          type="date"
          name="tanggal"
          id="tanggal"
          value="<?= htmlspecialchars($_POST['tanggal'] ?? date('Y-m-d')) ?>"
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
        placeholder="cth. Bayar kost bulan Juni"
        value="<?= htmlspecialchars($_POST['deskripsi'] ?? '') ?>"
        required
      >
    </div>

    <!-- Kategori -->
    <div class="form-group">
      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" required>
        <option value="" disabled selected>— Pilih kategori —</option>
        <?php
        // Render semua opsi; JS akan filter based on tipe
        $allKat = array_unique(array_merge($kategoriMasuk, $kategoriKeluar));
        foreach ($allKat as $k):
        ?>
          <option
            value="<?= htmlspecialchars($k) ?>"
            <?= ($_POST['kategori'] ?? '') === $k ? 'selected' : '' ?>
          ><?= htmlspecialchars($k) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="btn-group">
      <button type="submit" class="btn btn-primary">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Catatan
      </button>
      <a href="index.php" class="btn btn-secondary">Batal</a>
    </div>

  </form>
</div>

<script>
// Kategori per tipe
const kategoriData = {
  masuk:  <?= json_encode($kategoriMasuk) ?>,
  keluar: <?= json_encode($kategoriKeluar) ?>
};

const savedKategori = <?= json_encode($_POST['kategori'] ?? '') ?>;

function updateKategori(tipe) {
  const sel = document.getElementById('kategori');
  sel.innerHTML = '<option value="" disabled selected>— Pilih kategori —</option>';

  if (!tipe || !kategoriData[tipe]) return;

  kategoriData[tipe].forEach(k => {
    const opt = document.createElement('option');
    opt.value = k;
    opt.textContent = k;
    if (k === savedKategori) opt.selected = true;
    sel.appendChild(opt);
  });
}

// Init on page load if tipe already selected (after POST error)
const tipeEl = document.getElementById('tipe');
if (tipeEl.value) updateKategori(tipeEl.value);
</script>

<?php include 'footer.php'; ?>
