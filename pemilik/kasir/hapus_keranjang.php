<?php
session_start();

// Menghapus semua data di dalam session keranjang
unset($_SESSION['keranjang']);

// Mengembalikan kasir ke halaman dashboard
header("location:dashboard.php");
?>