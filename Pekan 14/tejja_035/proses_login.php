php
<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "admin" && $password == "12345") {
    $_SESSION['login'] = true;
    header("Location: index.php");
} else {
    echo "Login gagal";
}
?>