<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT lembur.*, jabatan.nama_jabatan 
    FROM lembur 
    JOIN jabatan ON lembur.id_jabatan = jabatan.id 
    WHERE lembur.id = $id
"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Tarif Lembur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="mt-5">
    <div class="container" style="max-width: 800px;">
        <h3 class="text-center mb-4">Detail Tarif Lembur</h3>
        <table class="table table-bordered">
            <tr><th>Jabatan</th><td><?= $data['nama_jabatan'] ?></td></tr>
            <tr><th>Tarif Per Jam</th><td>Rp <?= number_format($data['tarif']) ?></td></tr>
        </table>
        <a href="lembur.php" class="btn btn-secondary">← Kembali ke Daftar Lembur</a>
    </div>
</body>
</html>
