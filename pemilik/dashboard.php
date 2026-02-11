<?php 
session_start();
include '../config/koneksi.php';
if($_SESSION['role'] != "pemilik"){ header("location:../index.php"); }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pemilik - Toko Kelontong</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-primary mb-4">
        <div class="container">
            <span class="navbar-brand">Toko Kelontong - Panel Pemilik</span>
            <a href="../logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Stok Barang</h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahBarang">+ Tambah Produk</button>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-3">
    <h5>Daftar Stok Barang</h5>
    <?php
// 1. Hitung Total Jenis Barang
$query_barang = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$data_barang = mysqli_fetch_assoc($query_barang);

// 2. Hitung Barang yang Stoknya Hampir Habis (di bawah 5)
$query_stok_low = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk WHERE stok < 5");
$data_stok_low = mysqli_fetch_assoc($query_stok_low);

// 3. Hitung Total Omzet (Pendapatan)
$query_omzet = mysqli_query($conn, "SELECT SUM(total_bayar) as total FROM transaksi");
$data_omzet = mysqli_fetch_assoc($query_omzet);
?>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h6>Total Jenis Produk</h6>
                <h3><?= $data_barang['total']; ?> Item</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h6>Stok Menipis (< 5)</h6>
                <h3><?= $data_stok_low['total']; ?> Produk</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h6>Total Omzet</h6>
                <h3>Rp <?= number_format($data_omzet['total']); ?></h3>
            </div>
        </div>
    </div>
</div> Lihat Laporan Penjualan
        </a>
        <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahBarang">
            + Tambah Produk
        </button>
        <a href="tambah_stok.php" class="btn btn-success shadow-sm">
    + Tambah Stok
</a>
    </div>
</div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM produk");
                        while($row = mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
                            <td><?= $row['nama_produk']; ?></td>
                            <td>Rp <?= number_format($row['harga']); ?></td>
                            <td><?= $row['stok']; ?></td>
                            <td>
                                <a href="hapus_produk.php?id=<?= $row['id_produk']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahBarang" tabindex="-1">
        <div class="modal-dialog">
            <form action="tambah_produk.php" method="POST" class="modal-content">
                <div class="modal-header"><h5>Tambah Barang Baru</h5></div>
                <div class="modal-body">
                    <div class="mb-3"><label>Nama Produk</label><input type="text" name="nama" class="form-control" required></div>
                    <div class="mb-3"><label>Harga</label><input type="number" name="harga" class="form-control" required></div>
                    <div class="mb-3"><label>Stok Awal</label><input type="number" name="stok" class="form-control" required></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
