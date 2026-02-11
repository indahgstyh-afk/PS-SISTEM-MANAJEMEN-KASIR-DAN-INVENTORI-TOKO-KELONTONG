<?php 
session_start();
include '../config/koneksi.php';
if($_SESSION['role'] != "kasir"){ header("location:../index.php"); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kasir - Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-success mb-4">
        <div class="container">
            <span class="navbar-brand">Toko Kelontong - Menu Kasir</span>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-3 shadow-sm">
                    <h5>Input Barang</h5>
                    <form action="tambah_keranjang.php" method="POST">
                        <div class="mb-3">
                            <label>Pilih Produk</label>
                            <select name="id_produk" class="form-select">
                                <?php
                                $produk = mysqli_query($conn, "SELECT * FROM produk WHERE stok > 0");
                                while($p = mysqli_fetch_assoc($produk)){
                                    echo "<option value='".$p['id_produk']."'>".$p['nama_produk']." (Stok: ".$p['stok'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" value="1" min="1">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Tambah ke Daftar</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-3 shadow-sm">
                    <h5>Daftar Belanjaan</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php 
    $total = 0; // Menyiapkan variabel untuk hitung total belanja
    
    // Mengecek apakah ada barang di keranjang belanja
    if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) {
        foreach ($_SESSION['keranjang'] as $key => $val) {
            $total += $val['subtotal']; // Tambahkan subtotal ke total
            ?>
            <tr>
                <td><?php echo $val['nama']; ?></td>
                <td>Rp <?php echo number_format($val['harga']); ?></td>
                <td><?php echo $val['qty']; ?></td>
                <td>Rp <?php echo number_format($val['subtotal']); ?></td>
            </tr>
            <?php 
        }
    } else {
        // Jika keranjang masih kosong
        echo "<tr><td colspan='4' class='text-center text-muted py-3'>Belum ada barang dipilih</td></tr>";
    }
    ?>
    
    <tr class="table-success">
        <td colspan="3" class="text-end"><b>Total Bayar:</b></td>
        <td><b>Rp <?php echo number_format($total); ?></b></td>
    </tr>
</tbody>
                    </table>
                    <div class="mt-3">
    <a href="simpan_transaksi.php" class="btn btn-primary w-100">Selesaikan Transaksi & Cetak Struk</a>
    </a>
    <a href="bersihkan_keranjang.php" class="btn btn-outline-danger w-100 mt-2 btn-sm">
        <a href="hapus_keranjang.php" class="btn btn-outline-danger w-100 mt-2">Kosongkan Daftar Belanja</a>
    </a>
</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>