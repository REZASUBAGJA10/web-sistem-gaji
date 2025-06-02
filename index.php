<?php
include 'config/koneksi.php';
$current_page = basename($_SERVER['PHP_SELF']);

// Hitung total data
$totalKaryawan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM karyawan"))['total'];
$totalJabatan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jabatan"))['total'];
$totalRating = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM rating"))['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Sistem Gaji</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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
            top: 0;
            left: 0;
            z-index: 1050;
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
        .progress {
            height: 20px;
        }
        .progress-bar {
            background-color: #0d6efd;
            height: 100%;
        }
    </style>
</head>
<body>
<button class="btn btn-dark d-md-none m-3" id="toggleSidebar">
    <i class="bi bi-list"></i> Menu
</button>
<div class="sidebar">
    <div class="text-center mb-3">
        <img src="image/gambar.png" alt="Logo" style="max-width: 70px;">
    </div>
    <h4 class="h1">Sistem Gaji</h4>
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
    <div class="alert alert-success text-center" role="alert">
        <marquee behavior="" direction="">👋 <strong>Selamat datang!</strong> di Sistem Manajemen Gaji Karyawan</marquee>
    </div>
    <h1 class="text-center fw-bold mb-5">SELAMAT DATANG DI PT. CLAN UCHIHA</h1>

    <div class="row text-white text-center mb-4 justify-content-center">
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-primary py-3 px-4 rounded shadow-sm">
                <i class="bi bi-people-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Karyawan</h6>
                <h5><?= $totalKaryawan ?></h5>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-success py-3 px-4 rounded shadow-sm">
                <i class="bi bi-briefcase-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Jabatan</h6>
                <h5><?= $totalJabatan ?></h5>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mb-2">
            <div class="bg-dark py-3 px-4 rounded shadow-sm">
                <i class="bi bi-star-fill fs-4"></i>
                <h6 class="mt-2 mb-0">Total Rating</h6>
                <h5><?= $totalRating ?></h5>
            </div>
        </div>
    </div>

    <h3 class="text-center mb-4">Karyawan Terbaru</h3>
    <div class="row">
        <?php
        // Ambil semua karyawan
        $query = "SELECT k.*, j.nama_jabatan, r.nilai_rating 
                  FROM karyawan k 
                  LEFT JOIN jabatan j ON k.id_jabatan = j.id 
                  LEFT JOIN rating r ON k.id_rating = r.id 
                  ORDER BY k.created_at DESC"; // Hapus LIMIT untuk menampilkan semua karyawan
        $result = mysqli_query($koneksi, $query);

        // Cek apakah query berhasil
        if (!$result) {
            die("Query Error: " . mysqli_error($koneksi));
        }

        while ($data = mysqli_fetch_assoc($result)) {
            $fotoPath = "uploads/" . $data['foto'];

            // Jika foto kosong atau tidak ada, gunakan foto default
            if (empty($data['foto']) || !file_exists($fotoPath)) {
                $fotoPath = $data['jenis_kelamin'] == 'Perempuan' ? "uploads/default_wanita.png" : "uploads/default_pria.png";
            }
        ?>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100 p-2" style="font-size: 13px;">
                <img src="<?= $fotoPath ?>" class="rounded-circle mx-auto d-block mt-2" width="100" height="100" style="object-fit: cover;">

                <div class="card-body text-start p-2">
                    <h6 class="fw-bold mb-1 text-center"><?= htmlspecialchars($data['nama']) ?></h6>

                    <p class="mb-1"><strong>Status:</strong>
                        <span class="badge bg-<?= $data['status'] == 'Aktif' ? 'success' : 'secondary' ?>">
                            <?= htmlspecialchars($data['status']) ?>
                        </span>
                    </p>

                    <p class="mb-1"><strong>Jabatan:</strong>
                        <span class="badge bg-<?= empty($data['nama_jabatan']) ? 'danger' : 'info' ?>">
                            <?= htmlspecialchars($data['nama_jabatan']) ?>
                        </span>
                    </p>

                    <p class="mb-1 d-flex align-items-center">
                        <strong class="me-2">Rating:</strong>
                        <?php
                        $rating = (int) $data['nilai_rating'];
                        for ($i = 1; $i <= 5; $i++) {
                            $starClass = $i <= $rating ? 'fas' : 'far';
                            echo '<i class="' . $starClass . ' fa-star text-warning me-1" title="' . $rating . ' dari 5"></i>';
                        }
                        ?>
                    </p>
                    <p class="mb-1"><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($data['created_at'])) ?></p>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

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

<footer class="text-end px-3 py-2 shadow-sm"
        style="position: fixed; bottom: 0; right: 0; background-color: #f8f9fa; z-index: 1040; border-top-left-radius: 10px;">
    <small>© 2025 Sistem Gaji — by Reza Subagja</small>
</footer>

<script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
</script>

</body>
</html>
