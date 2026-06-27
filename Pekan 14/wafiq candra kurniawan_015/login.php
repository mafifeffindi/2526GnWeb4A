<?php
session_start();
include 'koneksi.php'; 

if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    header("Location: index.php");
    exit;
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    if($cek > 0){
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("Location: index.php");
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Aplikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Background disamakan dengan warna Navbar Dashboard */
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .card-login {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .card-header {
            background: rgba(255, 255, 255, 0.1);
            border-bottom: none;
        }
        .btn-custom {
            /* Warna tombol disamakan dengan tema biru */
            background: #1e3c72;
            color: white;
            border-radius: 25px;
            padding: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
        }
        .text-theme {
            /* Warna teks judul disamakan */
            color: #1e3c72;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-login bg-white">
                    <div class="card-header text-center pt-4 pb-0">
                        <h4 class="mb-0 fw-bold text-theme">Welcome Back!</h4>
                        <p class="text-muted small">Silakan login untuk melanjutkan</p>
                    </div>
                    <div class="card-body p-4">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger p-2 text-center" style="border-radius: 10px;"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control form-control-lg" style="border-radius: 10px;" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-muted small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control form-control-lg" style="border-radius: 10px;" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-custom w-100 shadow-sm">MASUK</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>