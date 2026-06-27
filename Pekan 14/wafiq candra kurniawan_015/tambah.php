<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .card-header { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-bottom: none; }
        .form-control { border-radius: 10px; }
        .btn-custom { border-radius: 20px; font-weight: 500; padding: 10px 25px; }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header pt-4 pb-4 text-center">
                    <h5 class="mb-0 fw-bold">Tambah Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="proses_tambah.php">
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">NIM</label>
                            <input type="text" name="nim" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-lg" required>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary btn-custom shadow-sm">Kembali</a>
                            <button type="submit" class="btn btn-success btn-custom shadow-sm">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>