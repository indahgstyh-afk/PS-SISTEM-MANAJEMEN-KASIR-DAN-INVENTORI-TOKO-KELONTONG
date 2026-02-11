<?php
session_start();
include '../config/koneksi.php';

// Logika simpan stok saat tombol ditekan
if (isset($_POST['simpan_stok'])) {
    $id_produk = $_POST['id_produk'];
    $jumlah_tambah = $_POST['jumlah'];

    // Update stok: stok lama + jumlah baru
    $query = mysqli_query($conn, "UPDATE produk SET stok = stok + $jumlah_tambah WHERE id_produk = '$id_produk'");

    if ($query) {
        echo "<script>alert('Stok berhasil ditambahkan!'); window.location='tambah_stok.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah stok!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Stok Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 500px;">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Form Tambah Stok Produk</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Pilih Produk</label>
                        <select name="id_produk" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php
                            $data = mysqli_query($conn, "SELECT * FROM produk");
                            while($d = mysqli_fetch_array($data)){
                                echo "<option value='".$d['id_produk']."'>".$d['nama_produk']." (Stok: ".$d['stok'].")</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Tambahan</label>
                        <input type="number" name="jumlah" class="form-control" placeholder="0" min="1" required>
                    </div>
                    <button type="submit" name="simpan_stok" class="btn btn-primary w-100">Simpan Perubahan Stok</button>
                    <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">Kembali ke Dashboard</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>