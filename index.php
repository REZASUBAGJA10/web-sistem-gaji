<?php
include 'config/koneksi.php';
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Gaji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background-color: #f5f7fa;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            padding: 20px;
            height: 100vh;
            position: fixed;
            width: 250px;
        }
        .sidebar h4 {
            margin-bottom: 30px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
            border-radius: 5px;
        }
        .sidebar a:hover,
        .sidebar .active {
            background-color: #0d6efd;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #ddd;
            position: fixed;
            bottom: 0;
            width: calc(100% - 250px);
            margin-left: 250px;
        }
        @media (max-width: 768px) {
            footer {
                width: 100%;
                margin-left: 0;
                position: relative;
            }
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h4> Sistem Gaji</h4>
    <ul class="nav flex-column">
        <li><a class="<?= $current_page == 'index.php' ? 'active' : '' ?>" href="index.php"><i class="bi bi-house"></i> Dashboard</a></li>
        <li><a class="<?= $current_page == 'karyawan.php' ? 'active' : '' ?>" href="karyawan.php"><i class="bi bi-people"></i> Daftar Karyawan</a></li>
        <li><a class="<?= $current_page == 'jabatan.php' ? 'active' : '' ?>" href="jabatan.php"><i class="bi bi-briefcase"></i> Daftar Jabatan</a></li>
        <li><a class="<?= $current_page == 'rating.php' ? 'active' : '' ?>" href="rating.php"><i class="bi bi-star"></i> Daftar Rating</a></li>
        <li><a class="<?= $current_page == 'lembur.php' ? 'active' : '' ?>" href="lembur.php"><i class="bi bi-clock-history"></i> Tarif Lembur</a></li>
        <li><a class="<?= $current_page == 'gaji.php' ? 'active' : '' ?>" href="gaji.php"><i class="bi bi-cash-stack"></i> Gaji Karyawan</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="alert alert-success text-center  " role="alert">
        <marquee behavior="" direction="">👋 <strong>Selamat datang!</strong> di Sistem Manajemen Gaji Karyawan</marquee>
    </div>

    <h1 class="text-center fw-bold mb-5">SELAMAT DATANG DI PT. MAKMUR</h1>

    <div class="row text-white text-center mb-4 justify-content-center">
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-primary py-3 px-4 rounded shadow-sm">
                <i class="bi bi-people-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Karyawan</h6>
                <h5>3</h5>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-success py-3 px-4 rounded shadow-sm">
                <i class="bi bi-briefcase-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Jabatan</h6>
                <h5>4</h5>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-dark py-3 px-4 rounded shadow-sm">
                <i class="bi bi-star-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Rating</h6>
                <h5>4</h5>
            </div>
        </div>
    </div>

    <h3 class="text-center mb-3">Karyawan Terbaru</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Status</th>
                    <th>Jabatan</th>
                    <th>Rating</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "
                    SELECT k.nama, k.umur, k.jenis_kelamin, k.status, 
                           j.nama_jabatan, r.nilai_rating, k.created_at
                    FROM karyawan k
                    LEFT JOIN jabatan j ON k.id_jabatan = j.id
                    LEFT JOIN rating r ON k.id_rating = r.id
                    ORDER BY k.created_at DESC
                    LIMIT 5
                ");
                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['umur'] ?> Tahun</td>
                    <td>
                        <?= $row['jenis_kelamin'] == 'Laki-laki' ? '<span class="badge bg-primary">Laki-laki</span>' : '<span class="badge bg-warning text-dark">Perempuan</span>' ?>
                    </td>
                    <td>
                        <?= $row['status'] == 'Aktif' ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-secondary">Non Aktif</span>' ?>
                    </td>
                    <td>
                        <span class="badge bg-info text-dark"><?= $row['nama_jabatan'] ?? '-' ?></span>
                    </td>
                    <td><?= $row['nilai_rating'] ?? '-' ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
            $total_slot = 10;
            $terisi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM karyawan"));
            $persen = ($terisi / $total_slot) * 100;
            ?>
            <div class="mb-3">
                <label class="form-label">Progress Pengisian Data Karyawan</label>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?= $persen ?>%;" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"><?= round($persen) ?>%</div>
                </div>
            </div>

    </div>
</div>


<footer class="text-end px-3 py-2 shadow-sm"
        style="position: fixed; bottom: 0; right: 0; background-color: #f8f9fa; z-index: 1040; border-top-left-radius: 10px;">
    <small>© 2025 Sistem Gaji — by Reza subagja</small>
</footer>

</body>
</html>





  