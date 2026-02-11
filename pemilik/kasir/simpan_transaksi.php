<?php
session_start();
include '../config/koneksi.php';

if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
    $total_bayar = 0;
    foreach($_SESSION['keranjang'] as $item) { 
        $total_bayar += $item['subtotal']; 
    }

    // 1. Simpan ke tabel transaksi utama
    mysqli_query($conn, "INSERT INTO transaksi (total_bayar) VALUES ('$total_bayar')");
    $id_transaksi_baru = mysqli_insert_id($conn); 

    // 2. Simpan setiap barang ke detail_transaksi & Update Stok
    foreach ($_SESSION['keranjang'] as $val) {
        $id_p = $val['id'];
        $nama_p = $val['nama'];
        $hrg = $val['harga'];
        $qty = $val['qty'];
        $sub = $val['subtotal'];

        // Simpan detail
        mysqli_query($conn, "INSERT INTO detail_transaksi (id_transaksi, id_produk, nama_produk, harga, qty, subtotal) 
                             VALUES ('$id_transaksi_baru', '$id_p', '$nama_p', '$hrg', '$qty', '$sub')");
        
        // Update stok
        mysqli_query($conn, "UPDATE produk SET stok = stok - $qty WHERE id_produk = '$id_p'");
    }

    // 3. Kosongkan keranjang
    unset($_SESSION['keranjang']);

    // 4. Notifikasi dan Buka Struk
    // Notifikasi dan Buka Struk dengan jeda agar tidak bentrok
    echo "<script>
        alert('Transaksi Berhasil!');
        var win = window.open('cetak_struk.php', '_blank');
        if (win) {
            // Jika berhasil buka tab baru, pindahkan halaman utama setelah jeda
            setTimeout(function(){ window.location='dashboard.php'; }, 500);
        } else {
            // Jika diblokir oleh browser, beri tahu user
            alert('Mohon izinkan pop-up pada browser Anda untuk mencetak struk.');
            window.location='dashboard.php';
        }
    </script>";

} else {
    header("location:dashboard.php");
}
?>