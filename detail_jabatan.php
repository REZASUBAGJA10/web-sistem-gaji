<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jabatan WHERE id = $id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Jabatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="mt-5">
    <div class="container" style="max-width: 800px;">
        <h3 class="text-center mb-4">Detail Jabatan</h3>
        <table class="table table-bordered">
            <tr><th>Nama Jabatan</th><td><?= $data['nama_jabatan'] ?></td></tr>
            <tr><th>Gaji Pokok</th><td>Rp <?= number_format($data['gaji_pokok']) ?></td></tr>
        </table>
        <a href="jabatan.php" class="btn btn-secondary">← Kembali ke Daftar Jabatan</a>
    </div>
</body>
</html>
