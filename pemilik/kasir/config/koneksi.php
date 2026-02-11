<?php
$conn = mysqli_connect("localhost", "root", "", "toko_kelontong");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>