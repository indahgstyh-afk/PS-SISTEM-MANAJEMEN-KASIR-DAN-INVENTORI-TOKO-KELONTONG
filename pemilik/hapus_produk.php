<?php
include '../config/koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];

// Hapus data berdasarkan ID
$query = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");

if($query){
    header("location:dashboard.php");
} else {
    echo "Gagal menghapus data";
}
?>