<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tarif Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 8%;
            margin-bottom: 80px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .card-lembur {
            margin-bottom: 15px;
        }

        .card-lembur .card-body p {
            margin: 2px 0;
        }

        @media (max-width: 768px) {
            table {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Tarif Lembur</h2>


    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Jabatan</th>
                    <th>Tarif (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "
                    SELECT lembur.*, jabatan.nama_jabatan 
                    FROM lembur 
                    JOIN jabatan ON lembur.id_jabatan = jabatan.id
                ");
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <span class="badge bg-info text-dark"><?= $row['nama_jabatan'] ?? '-' ?></span>
                    </td>
                    <td>Rp <?= number_format($row['tarif'], 0, ',', '.') ?></td>
                    <td>
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <a href="edit_lembur.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_lembur.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            <a href="detail_lembur.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <div class="d-md-none">
        <?php
        mysqli_data_seek($query, 0); 
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <div class="card card-lembur shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= $no++ . '. ' . $row['nama_jabatan'] ?></h5>
                <p><strong>Tarif Lembur:</strong> Rp <?= number_format($row['tarif'], 0, ',', '.') ?></p>
                <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                    <a href="edit_lembur.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_lembur.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                    <a href="detail_lembur.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

 
    <div class="d-flex flex-wrap gap-2 mb-3 mt-3 justify-content-center">
        <a href="index.php" class="btn btn-secondary btn-sm">← Kembali ke Dashboard</a>
        <a href="tambah_lembur.php" class="btn btn-primary btn-sm">+ Tambah Tarif Lembur</a>
    </div>
</div>


<footer class="w-100 px-4 py-2 text-end shadow-sm"
        style="position: fixed; bottom: 0; left: 0; right: 0; background-color: #f8f9fa; z-index: 1040;">
    <small>© 2025 Sistem Gaji — by Reza</small>
</footer>

</body>
</html>
