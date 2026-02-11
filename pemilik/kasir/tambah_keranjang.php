<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Ambil data produk dari database
    $sql = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $p = mysqli_fetch_assoc($sql);

    // Masukkan ke dalam session keranjang
    $item = [
        'id' => $p['id_produk'],
        'nama' => $p['nama_produk'],
        'harga' => $p['harga'],
        'qty' => $jumlah,
        'subtotal' => $p['harga'] * $jumlah
    ];

    $_SESSION['keranjang'][] = $item;
    header("location:dashboard.php");
}
?>