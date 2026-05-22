<?php
include 'koneksi.php';

if(isset($_POST['simpan'])){
	$nim = $_POST['nim'];
	$nama = $_POST['nama'];
	$prodi = $_POST['prodi'];

	mysqli_query($koneksi,
		"INSERT INTO mahasiswa (nim, nama, prodi) VALUES('$nim', '$nama', '$prodi')");

	header("Location: index.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tambah Data</title>
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
	<h2>Tambah Data Mahasiswa</h2>
	<form method="post">
		<div class="form-group">
			<label for="nim">NIM</label>
			<input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
		</div>
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" id="nama" name="nama" placeholder="Masukkan Nama" required>
		</div>
		<div class="form-group">
			<label for="prodi">Prodi</label>
			<input type="text" id="prodi" name="prodi" placeholder="Masukkan Prodi" required>
		</div>
		<button class="form-btn" type="submit" name="simpan">Simpan</button>
	</form>
</div>

</body>
</html>