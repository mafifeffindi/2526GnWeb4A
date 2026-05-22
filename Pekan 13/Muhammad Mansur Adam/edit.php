<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id='$id'");
$d = mysqli_fetch_array($data);

if(isset($_POST['update'])){
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$prodi = $_POST['prodi'];

	mysqli_query($koneksi,
		"UPDATE mahasiswa SET nim='$nim', nama='$nama', prodi='$prodi' WHERE id='$id'");
	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Data</title>
	<link rel="stylesheet" href="style.css">
	<style>
		.form-container {
			max-width: 400px;
			margin: 60px auto;
			padding: 32px 28px 24px 28px;
			background: #fff;
			border-radius: 12px;
			box-shadow: 0 4px 24px rgba(0,0,0,0.08);
		}
		.form-container h2 {
			margin-bottom: 24px;
			color: #2c3e50;
			text-align: center;
		}
		.form-group {
			margin-bottom: 18px;
		}
		.form-group label {
			display: block;
			margin-bottom: 6px;
			color: #34495e;
			font-weight: 500;
		}
		.form-group input {
			width: 100%;
			padding: 10px 12px;
			border: 1px solid #bdc3c7;
			border-radius: 6px;
			font-size: 15px;
			transition: border-color 0.2s;
		}
		.form-group input:focus {
			border-color: #3498db;
			outline: none;
		}
		.form-btn {
			width: 100%;
			padding: 12px;
			background: #3498db;
			color: #fff;
			border: none;
			border-radius: 6px;
			font-size: 16px;
			font-weight: bold;
			cursor: pointer;
			transition: background 0.2s;
		}
		.form-btn:hover {
			background: #217dbb;
		}
	</style>
</head>
<body style="background:#f4f6f8;">

<div class="form-container">
	<h2>Edit Data Mahasiswa</h2>
	<form method="post">
		<div class="form-group">
			<label for="nim">NIM</label>
			<input type="text" id="nim" name="nim" value="<?php echo $d['nim']; ?>" required>
		</div>
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" id="nama" name="nama" value="<?php echo $d['nama']; ?>" required>
		</div>
		<div class="form-group">
			<label for="prodi">Prodi</label>
			<input type="text" id="prodi" name="prodi" value="<?php echo $d['prodi']; ?>" required>
		</div>
		<button class="form-btn" type="submit" name="update">Update</button>
	</form>
</div>

</body>
</html>