<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Gaji Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 80px;
            margin-bottom: 100px;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            margin-bottom: 25px;
            text-align: center;
        }

        .aksi-btn-table {
            display: flex;
            justify-content: center;
            gap: 6px;
            flex-wrap: nowrap;
        }

        .aksi-btn-table a {
            min-width: 60px;
            white-space: nowrap;
            font-size: 0.8rem;
            padding: 4px 8px;
        }

        .card-gaji {
            margin-bottom: 15px;
        }

        .card-gaji .card-body p {
            margin: 2px 0;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f8f9fa;
            z-index: 1040;
            padding: 10px 20px;
            text-align: end;
            box-shadow: 0 -1px 5px rgba(0,0,0,0.1);
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
    <h2>Daftar Gaji Karyawan</h2>

  
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Periode</th>
                    <th>Bonus</th>
                    <th>Tunjangan</th>
                    <th>Jam Lembur</th>
                    <th>Total Gaji (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "
                    SELECT 
                        g.*, 
                        k.nama, 
                        j.nama_jabatan, 
                        l.tarif_per_jam,
                        (g.bonus + g.tunjangan + (g.jam_lembur * IFNULL(l.tarif_per_jam, 0))) AS total_gaji
                    FROM gaji g
                    JOIN karyawan k ON g.id_karyawan = k.id
                    JOIN jabatan j ON g.id_jabatan = j.id
                    LEFT JOIN lembur l ON g.id_jabatan = l.id_jabatan
                    ORDER BY g.created_at DESC
                ");
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td>
                        <span class="badge bg-info text-dark"><?= $row['nama_jabatan'] ?? '-' ?></span>
                    </td>
                    <td><?= $row['periode_gaji'] ?></td>
                    <td>Rp <?= number_format($row['bonus'], 0, ',', '.') ?></td>
                    <td>Rp <?= number_format($row['tunjangan'], 0, ',', '.') ?></td>
                    <td><?= $row['jam_lembur'] ?></td>
                    <td>Rp <?= number_format($row['total_gaji'], 0, ',', '.') ?></td>
                    <td>
                        <div class="aksi-btn-table">
                            <a href="edit_gaji.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_gaji.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            <a href="detail_gaji.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
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
        <div class="card card-gaji shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= $no++ . '. ' . $row['nama'] ?></h5>
                <p><strong>Jabatan:</strong> <?= $row['nama_jabatan'] ?></p>
                <p><strong>Periode:</strong> <?= $row['periode_gaji'] ?></p>
                <p><strong>Bonus:</strong> Rp <?= number_format($row['bonus'], 0, ',', '.') ?></p>
                <p><strong>Tunjangan:</strong> Rp <?= number_format($row['tunjangan'], 0, ',', '.') ?></p>
                <p><strong>Jam Lembur:</strong> <?= $row['jam_lembur'] ?></p>
                <p><strong>Total Gaji:</strong> Rp <?= number_format($row['total_gaji'], 0, ',', '.') ?></p>
                <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                    <a href="edit_gaji.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_gaji.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    <a href="detail_gaji.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

   
    <div class="btn-container">
        <a href="index.php" class="btn btn-secondary btn-sm">← Kembali ke Dashboard</a>
        <a href="tambah_gaji.php" class="btn btn-primary btn-sm">+ Tambah Gaji</a>
    </div>
</div>

<footer>
    <small>© 2025 Sistem Gaji — by Reza</small>
</footer>

</body>
</html>
