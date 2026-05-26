login

<?php
session_start();
include 'koneksi.php';

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = mysqli_query($koneksi,
    "SELECT * FROM login
    WHERE username='$username'
    AND password='$password'");

    $cek = mysqli_num_rows($data);

    if($cek > 0){

        $_SESSION['status'] = "login";

        header("location:index.php");

    } else {

        $error = "Username atau Password salah!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

</head>
<body>

<div class="login-container">

    <div class="login-box">

        <h2>Login</h2>
        <p class="sub-title">
            Silakan login terlebih dahulu
        </p>

        <?php if($error != ""){ ?>

            <div class="error">
                <?php echo $error; ?>
            </div>

        <?php } ?>

        <form method="POST">

            <input
            type="text"
            name="username"
            placeholder="Username"
            required>

            <input
            type="password"
            name="password"
            placeholder="Password"
            required>

            <button
            type="submit"
            name="login">

            Login

            </button>

        </form>

    </div>

</div>

</body>
</html>
