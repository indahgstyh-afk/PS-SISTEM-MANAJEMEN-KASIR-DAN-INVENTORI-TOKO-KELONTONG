<?php
include '../config/koneksi.php';

// Ambil ID transaksi terakhir yang baru saja disimpan
$query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC LIMIT 1");
$trx = mysqli_fetch_assoc($query);
$id_trx = $trx['id_transaksi'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Pembayaran - TRX-00<?= $id_trx; ?></title>
    <style>
        body { font-family: 'Courier New', Courier, monospace; width: 300px; margin: 0 auto; padding: 20px; color: #000; }
        .text-center { text-align: center; }
        hr { border-top: 1px dashed black; }
        table { width: 100%; }
        .total { font-weight: bold; }
    </style>
</head>
<body onload="window.print();">
    <div class="text-center">
        <h3>TOKO KELONTONG</h3>
        <p>Jl. Toko Saya No. 123</p>
    </div>
    <hr>
    <p>No: TRX-00<?= $id_trx; ?><br>
       Tgl: <?= $trx['tgl_transaksi']; ?></p>
    <hr>
    <table>
        <?php
        // Mengambil detail barang dari tabel detail_transaksi
        $detail = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id_trx'");
        while($d = mysqli_fetch_assoc($detail)){
        ?>
        <tr>
            <td><?= $d['nama_produk']; ?></td>
            <td style="text-align: right;"><?= $d['qty']; ?> x <?= number_format($d['harga']); ?></td>
        </tr>
        <?php } ?>
    </table>
    <hr>
    <table>
        <tr class="total">
            <td>TOTAL</td>
            <td style="text-align: right;">Rp <?= number_format($trx['total_bayar']); ?></td>
        </tr>
    </table>
    <hr>
    <div class="text-center">
        <p>Terima Kasih<br>Selamat Belanja Kembali</p>
    </div>

    <script>
        // Menutup tab otomatis setelah selesai print/cancel agar kasir tidak bingung
        window.onafterprint = function() { window.close(); }
    </script>
</body>
</html>