<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:login.php");
}

include 'koneksi.php';

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nama LIKE '%".$cari."%' OR nim LIKE '%".$cari."%'");
} else {
    $data = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa - Pekan 14</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Data Mahasiswa (Pekan 14)</h2>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
        
        <div class="row mb-3">
            <div class="col-md-6">
                <a href="tambah.php" class="btn btn-success">+ Tambah Data</a>
            </div>
            <div class="col-md-6">
                <form method="get" class="d-flex">
                    <input type="text" name="cari" class="form-control me-2" placeholder="Cari Nama atau NIM..." value="<?php if(isset($_GET['cari'])){echo $_GET['cari'];} ?>">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </form>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['nim']; ?></td>
                    <td><?php echo $d['nama']; ?></td>
                    <td><?php echo $d['prodi']; ?></td>
                    <td><?php echo $d['email']; ?></td>
                    <td><?php echo $d['no_hp']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm btn-hapus" data-id="<?php echo $d['id']; ?>" data-nama="<?php echo $d['nama']; ?>">Hapus</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.btn-hapus').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Ingin menghapus data mahasiswa atas nama " + nama + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'remove.php?id=' + id;
                    }
                })
            });
        });
    </script>
</body>
</html>