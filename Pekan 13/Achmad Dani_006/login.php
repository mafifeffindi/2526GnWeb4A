<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "123"){

        $_SESSION['login'] = true;

        header("Location: index.php");

    } else {

        echo "Login gagal!";

    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>LOGIN</h2>

<form method="POST">

    Username <br>
    <input type="text" name="username">
    <br><br>

    Password <br>
    <input type="password" name="password">
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

</body>
</html>