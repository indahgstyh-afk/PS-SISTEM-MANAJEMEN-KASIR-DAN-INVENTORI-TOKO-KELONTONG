<?php
include '../config/koneksi.php';

if(isset($_POST['simpan'])){
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    // Pastikan nama tabel dan kolom sesuai dengan database yang kita buat di awal
    $query = mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok) VALUES ('$nama', '$harga', '$stok')");

    if($query){
        header("location:dashboard.php");
    } else {
        echo "Gagal menyimpan: " . mysqli_error($conn);
    }
}
?>