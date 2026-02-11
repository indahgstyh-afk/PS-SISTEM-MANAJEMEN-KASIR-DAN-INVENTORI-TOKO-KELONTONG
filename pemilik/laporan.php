<?php 
session_start();
include '../config/koneksi.php';
if($_SESSION['role'] != "pemilik"){ header("location:../index.php"); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan - Pemilik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Laporan Keuangan Toko</span>
            <a href="dashboard.php" class="btn btn-light btn-sm">Kembali ke Stok</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Riwayat Transaksi</h5>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No. Transaksi</th>
                            <th>Tanggal & Waktu</th>
                            <th>Total Bayar</th>
                        </tr>
                    </thead>
                   <tbody>
    <?php
    $total_pendapatan = 0;
    // Mengambil data dari tabel transaksi
    $query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
    
    while($row = mysqli_fetch_assoc($query)){
        $total_pendapatan += $row['total_bayar'];
        $id_trx = $row['id_transaksi'];
    ?>
    <tr>
        <td>TRX-00<?= $id_trx; ?></td>
        <td><?= $row['tgl_transaksi']; ?></td>
        
        <td>
            <ul class="mb-0" style="padding-left: 15px;">
                <?php 
                // Mengambil detail barang berdasarkan id_transaksi
                $detail = mysqli_query($conn, "SELECT * FROM detail_transaksi WHERE id_transaksi = '$id_trx'");
                while($d = mysqli_fetch_assoc($detail)){
                    echo "<li>" . $d['nama_produk'] . " (" . $d['qty'] . " pcs)</li>";
                }
                ?>
            </ul>
        </td>
        
        <td>Rp <?= number_format($row['total_bayar']); ?></td>
    </tr>
    <?php } ?>
</tbody>
                    <tfoot>
                        <tr class="table-warning">
                            <th colspan="2" class="text-center">TOTAL PENDAPATAN KESELURUHAN</th>
                            <th>Rp <?= number_format($total_pendapatan); ?></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>