<?php
session_start();
include 'config/koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Di database kita tadi passwordnya '12345'
    $role = $_POST['role'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='$role'");
    $data = mysqli_fetch_assoc($query);

    if (mysqli_num_rows($query) > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $data['role'];

        if ($data['role'] == "pemilik") {
            header("location:pemilik/dashboard.php");
        } else {
            header("location:kasir/dashboard.php");
        }
    } else {
        echo "<script>alert('Username, Password, atau Role Salah!'); window.location='index.php';</script>";
    }
}
?>