<?php
// header.php — Shared Page Shell (include di setiap halaman)
// $pageTitle dan $activeNav harus di-set sebelum include ini
if (!isset($pageTitle)) $pageTitle = 'Dompetku';
if (!isset($activeNav)) $activeNav = 'beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?> — Dompetku</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ── Sidebar ──────────────────────────────────────────── -->
<aside class="sidebar">
  <div class="brand">
    <div class="brand-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 12V7H5a2 2 0 0 1 0-4h14v4"/>
        <path d="M3 5v14a2 2 0 0 0 2 2h16v-5"/>
        <path d="M18 12a2 2 0 0 0 0 4h4v-4Z"/>
      </svg>
    </div>
    <h1>Dompet<span>ku</span></h1>
    <p>Catatan Keuangan Pribadi</p>
  </div>

  <p class="nav-label">Menu Utama</p>
  <ul>
    <li class="nav-item">
      <a href="index.php" class="<?= $activeNav === 'beranda' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Beranda
      </a>
    </li>
    <li class="nav-item">
      <a href="tambah.php" class="<?= $activeNav === 'tambah' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 8v8M8 12h8"/>
        </svg>
        Tambah Catatan
      </a>
    </li>
    <li class="nav-item">
      <a href="daftar.php" class="<?= $activeNav === 'daftar' ? 'active' : '' ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
          <rect width="6" height="4" x="9" y="3" rx="1"/>
          <path d="M9 12h6M9 16h4"/>
        </svg>
        Semua Catatan
      </a>
    </li>
  </ul>

  <div class="sidebar-footer">
    <p><strong>Muhammad Mansur Adam</strong><br>240631100110</p>
  </div>
</aside>

<!-- ── Main Content Area ──────────────────────────────────── -->
<main class="main-content">
