<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$query_total = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM mahasiswa");
$data_total = mysqli_fetch_assoc($query_total);
$jumlah_mahasiswa = $data_total['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .navbar-custom { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .card-data { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); }
        .table-custom thead th { background-color: #1e3c72; color: white; font-weight: 500; border: none; }
        .table-custom tbody tr:hover { background-color: #f1f5f9; }
        .btn-tambah { border-radius: 20px; padding: 8px 20px; font-weight: 500; }
        .stat-card { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: white; border: none; border-radius: 15px; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#"> Sistem Akademik</a>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">Halo, <strong><?php echo $_SESSION['username']; ?></strong>!</span>
            <a href="logout.php" class="btn btn-danger btn-sm" style="border-radius: 15px;" onclick="konfirmasiLogout(event, this.href)">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card stat-card shadow-sm p-3">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h6 class="text-uppercase fw-bold mb-1 opacity-75">Total Mahasiswa</h6>
                        <h2 class="mb-0 fw-bold"><?php echo $jumlah_mahasiswa; ?></h2>
                    </div>
                    <div style="font-size: 2.5rem; opacity: 0.8;">👨‍🎓</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-data bg-white p-4">
        <div class="card-body p-0">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-3" style="color: #1e3c72;">Data Mahasiswa</h5>
                    <a href="tambah.php" class="btn btn-success btn-tambah shadow-sm">+ Tambah Data Baru</a>
                </div>
                
                <div class="col-md-6 mt-3 mt-md-0">
                    <form method="GET" action="index.php" class="d-flex">
                        <input type="text" name="cari" class="form-control me-2" style="border-radius: 20px;" placeholder="Cari nama atau NIM..." value="<?php if(isset($_GET['cari'])) echo $_GET['cari']; ?>">
                        <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px;">Cari</button>
                        <?php if(isset($_GET['cari'])): ?>
                            <a href="index.php" class="btn btn-outline-secondary ms-2" style="border-radius: 20px;">Reset</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-custom align-middle">
                    <thead class="text-center">
                        <tr>
                            <th style="border-top-left-radius: 10px;">No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th style="border-top-right-radius: 10px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if(isset($_GET['cari'])){
                            $cari = $_GET['cari'];
                            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%".$cari."%' OR nim LIKE '%".$cari."%'");
                        } else {
                            $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
                        }

                        while($data = mysqli_fetch_array($query)){
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><strong style="color: #4a5568;"><?php echo $data['nama']; ?></strong></td>
                            <td><?php echo $data['nim']; ?></td>
                            <td><?php echo $data['email']; ?></td>
                            <td><?php echo $data['no_hp']; ?></td>
                            <td class="text-center">
                                <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-warning" style="border-radius: 10px;">Edit</a>
                                <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-danger" style="border-radius: 10px;" onclick="konfirmasiHapus(event, this.href, '<?php echo $data['nama']; ?>')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                        } 
                        if(mysqli_num_rows($query) == 0){
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>Data tidak ditemukan!</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Notifikasi Sukses (Menggantikan Alert Bootstrap)
    <?php if(isset($_SESSION['pesan'])): ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?php echo $_SESSION['pesan']; ?>',
        showConfirmButton: false,
        timer: 2500
    });
    <?php unset($_SESSION['pesan']); endif; ?>

    // 2. Pop-up Konfirmasi Hapus Data
    function konfirmasiHapus(event, url, nama) {
        event.preventDefault(); // Mencegah link langsung berpindah
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data mahasiswa bernama " + nama + " akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus Data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url; // Jika 'Ya', arahkan ke link hapus.php
            }
        });
    }

    // 3. Pop-up Konfirmasi Logout
    function konfirmasiLogout(event, url) {
        event.preventDefault();
        Swal.fire({
            title: 'Keluar Sistem?',
            text: "Anda harus login kembali untuk masuk ke dashboard.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3c72',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

</body>
</html>