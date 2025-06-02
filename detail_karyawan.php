<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id = $id"));

$fotoPath = "uploads/" . $data['foto'];
if (empty($data['foto']) || !file_exists($fotoPath)) {
    $fotoPath = ($data['jenis_kelamin'] == 'Perempuan') ? "uploads/default_wanita.png" : "uploads/default_pria.png";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Sama dengan daftar karyawan */
        }
        .card-custom {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th {
            width: 150px;
            color: #555;
        }
    </style>
</head>
<body class="mt-5">
    <div class="container" style="max-width: 800px;">
        <h3 class="text-center mb-4">Detail Karyawan</h3>
        <div class="card card-custom p-4">
            <div class="row g-4 align-items-center">
                <div class="col-md-8">
                    <table class="table table-borderless mb-0">
                        <tr><th>Nama</th><td><?= $data['nama'] ?></td></tr>
                        <tr><th>Alamat</th><td><?= $data['alamat'] ?></td></tr>
                        <tr><th>Umur</th><td><?= $data['umur'] ?> Tahun</td></tr>
                        <tr><th>Jenis Kelamin</th><td><?= $data['jenis_kelamin'] ?></td></tr>
                        <tr><th>Status</th><td><?= $data['status'] ?></td></tr>
                        <tr><th>Tanggal Input</th><td><?= date('d-m-Y', strtotime($data['created_at'])) ?></td></tr>
                    </table>
                    <a href="karyawan.php" class="btn btn-secondary mt-3">← Kembali ke Daftar Karyawan</a>
                </div>
                <div class="col-md-4 text-center">
                    <img src="<?= $fotoPath ?>" class="rounded-circle mt-2 mb-2" width="200" height="20 0" style="object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
