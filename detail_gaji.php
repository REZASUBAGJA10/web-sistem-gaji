<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($koneksi, "
    SELECT 
        g.*, 
        k.nama AS nama_karyawan, 
        j.nama_jabatan,
        l.tarif_per_jam
    FROM gaji g 
    JOIN karyawan k ON g.id_karyawan = k.id 
    JOIN jabatan j ON g.id_jabatan = j.id 
    LEFT JOIN lembur l ON g.id_jabatan = l.id_jabatan 
    WHERE g.id = '$id'
");

$data = mysqli_fetch_assoc($query);

// Hitung ulang total lembur dan total gaji
$tarif = $data['tarif_per_jam'] ?? 0;
$total_lembur = $data['jam_lembur'] * $tarif;
$total_gaji = $data['bonus'] + $data['tunjangan'] + $total_lembur;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Gaji Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 5%;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
        }
        table {
            margin: 0 auto;
            width: 100%;
        }
        td {
            text-align: left;
        }
        .btn-back {
            margin-top: 20px;
            margin-right: 74%;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Detail Gaji Karyawan</h2>
    <table class="table table-bordered mt-4">
        <tr><th>Nama Karyawan</th><td><?= $data['nama_karyawan'] ?></td></tr>
        <tr><th>Jabatan</th><td><?= $data['nama_jabatan'] ?></td></tr>
        <tr><th>Periode Gaji</th><td><?= $data['periode_gaji'] ?></td></tr>
        <tr><th>Bonus</th><td>Rp <?= number_format($data['bonus'], 0, ',', '.') ?></td></tr>
        <tr><th>Tunjangan</th><td>Rp <?= number_format($data['tunjangan'], 0, ',', '.') ?></td></tr>
        <tr><th>Jam Lembur</th><td><?= $data['jam_lembur'] ?> jam</td></tr>
        <tr><th><strong>Total Gaji</strong></th><td><strong>Rp <?= number_format($total_gaji, 0, ',', '.') ?></strong></td></tr>
    </table>
    <a href="gaji.php" class="btn btn-secondary btn-sm btn-back">← Kembali ke Daftar Gaji</a>
</div>
</body>
</html>
