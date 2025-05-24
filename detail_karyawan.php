<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id = $id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="mt-5">
    <div class="container" style="max-width: 800px;">
        <h3 class="text-center mb-4">Detail Karyawan</h3>
        <table class="table table-bordered">
            <tr><th>Nama</th><td><?= $data['nama'] ?></td></tr>
            <tr><th>Alamat</th><td><?= $data['alamat'] ?></td></tr>
            <tr><th>Umur</th><td><?= $data['umur'] ?> Tahun</td></tr>
            <tr><th>Jenis Kelamin</th><td><?= $data['jenis_kelamin'] ?></td></tr>
            <tr><th>Status</th><td><?= $data['status'] ?></td></tr>
            <tr><th>Tanggal Input</th><td><?= $data['created_at'] ?></td></tr>
        </table>
        <a href="karyawan.php" class="btn btn-secondary">← Kembali ke Daftar Karyawan</a>
    </div>
</body>
</html>
