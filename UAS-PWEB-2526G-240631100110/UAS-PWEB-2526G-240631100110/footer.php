<?php
// footer.php — Shared closing tags + mobile bottom nav
if (!isset($activeNav)) $activeNav = 'beranda';
?>
</main><!-- end .main-content -->

<!-- ── Mobile Bottom Nav ──────────────────────────────────── -->
<nav class="mobile-nav">
  <a href="index.php" class="<?= $activeNav === 'beranda' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
    </svg>
    Beranda
  </a>
  <a href="tambah.php" class="<?= $activeNav === 'tambah' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/>
    </svg>
    Tambah
  </a>
  <a href="daftar.php" class="<?= $activeNav === 'daftar' ? 'active' : '' ?>">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect width="6" height="4" x="9" y="3" rx="1"/><path d="M9 12h6M9 16h4"/>
    </svg>
    Catatan
  </a>
</nav>

</body>
</html>
