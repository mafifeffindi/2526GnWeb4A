<?php
session_start();
if($_SESSION['status'] != "login"){
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
        .card-custom { border: none; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
        .card-header { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white; border-bottom: none; }
        .form-control { border-radius: 10px; }
        .btn-custom { border-radius: 20px; font-weight: 500; padding: 10px 25px; }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-custom">
                <div class="card-header pt-4 pb-4 text-center">
                    <h5 class="mb-0 fw-bold">Edit Data Mahasiswa</h5>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="proses_edit.php" id="formEditData" onsubmit="konfirmasiEdit(event)">
                        <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                        
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg" value="<?php echo $d['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">NIM</label>
                            <input type="text" name="nim" class="form-control form-control-lg" value="<?php echo $d['nim']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small fw-bold">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" value="<?php echo $d['email']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small fw-bold">Nomor HP</label>
                            <input type="text" name="no_hp" class="form-control form-control-lg" value="<?php echo $d['no_hp']; ?>" required>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary btn-custom shadow-sm">Kembali</a>
                            <button type="submit" class="btn btn-warning btn-custom shadow-sm text-dark">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiEdit(event) {
        event.preventDefault(); // Mencegah form langsung tersubmit
        Swal.fire({
            title: 'Simpan Perubahan?',
            text: "Pastikan data yang Anda ubah sudah benar.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<span style="color:black; font-weight:bold;">Ya, Update Data!</span>',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika user klik 'Ya', submit form secara otomatis pakai JavaScript
                document.getElementById('formEditData').submit();
            }
        });
    }
</script>

</body>
</html>