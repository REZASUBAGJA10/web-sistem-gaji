<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daftar Karyawan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin-top: 80px;
      margin-bottom: 100px;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f9;
    }
    .container {
      max-width: 1200px;
      margin: auto;
      padding: 20px;
    }
    h2 {
      margin-bottom: 30px;
      text-align: center;
      font-weight: bold;
    }
    .card-body {
      font-size: 0.8rem;
      padding: 10px;
    }
    .card-body h6 {
      font-size: 1rem;
      margin-bottom: 8px;
      font-weight: bold;
      text-align: center;
    }
    .btn-sm {
      font-size: 0.7rem;
      padding: 4px 8px;
    }
    .card {
      transition: 0.3s;
    }
    .card:hover {
      transform: translateY(-3px);
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: #fff;
      padding: 10px 20px;
      text-align: end;
      border-top: 1px solid #ddd;
      font-size: 0.85rem;
    }
    .fa-star {
      font-size: 13px;
      margin-right: 2px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Daftar Karyawan</h2>
  <div class="row">
    <?php
    $query = "SELECT k.*, j.nama_jabatan, r.nilai_rating FROM karyawan k 
              LEFT JOIN jabatan j ON k.id_jabatan = j.id 
              LEFT JOIN rating r ON k.id_rating = r.id";
    $result = mysqli_query($koneksi, $query);

   while ($data = mysqli_fetch_assoc($result)) {
    $fotoPath = "uploads/" . $data['foto'];

    if (empty($data['foto']) || !file_exists($fotoPath)) {
        if ($data['jenis_kelamin'] == 'Perempuan') {
            $fotoPath = "uploads/default_wanita.png";
        } else {
            $fotoPath = "uploads/default_pria.png";
        }
    }

    ?>
<div class="col-lg-3 col-md-4 col-sm-6 mb-3">
  <div class="card border-0 shadow-sm h-100 p-2" style="font-size: 13px;">
        <img src="<?= $fotoPath ?>" class="rounded-circle mx-auto d-block mt-2" width="150" height="150" style="object-fit: cover;">
        <div class=" fw-bold card-body text-start p-2">
          <h6><?= htmlspecialchars($data['nama']) ?></h6>
          <p class="mb-1"><strong>Umur:</strong> <span class="badge bg-info text-dark"><?= $data['umur'] ?> Tahun</span></p>
          <p class="mb-1"><strong>Alamat:</strong> <span class="badge bg-success"><?= htmlspecialchars($data['alamat']) ?></span></p>
          <p class="mb-1"><strong>Divisi:</strong> <span class="badge bg-secondary"><?= htmlspecialchars($data['divisi']) ?></span></p>

          <p class="mb-1"><strong>Jenis Kelamin:</strong>
            <span class="badge bg-<?= $data['jenis_kelamin'] == 'Laki-laki' ? 'primary' : ($data['jenis_kelamin'] == 'Perempuan' ? 'warning' : 'secondary') ?>">
              <?= htmlspecialchars($data['jenis_kelamin']) ?>
            </span>
          </p>

          <p class="mb-1"><strong>Status:</strong>
            <span class="badge bg-<?= $data['status'] == 'Aktif' ? 'success' : 'secondary' ?>">
              <?= htmlspecialchars($data['status']) ?>
            </span>
          </p>

          <p class="mb-1"><strong>Jabatan:</strong>
            <span class="badge bg-<?= $data['nama_jabatan'] == '' ? 'danger' : 'info' ?>">
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

          <p class="mb-1"><strong><small>Tanggal:</small></strong> <small><?= date('d-m-Y', strtotime($data['created_at'])) ?></small></p>

          <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
            <a href="edit_karyawan.php?id=<?= $data['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus_karyawan.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
            <a href="detail_karyawan.php?id=<?= $data['id'] ?>" class="btn btn-info btn-sm">Detail</a>
          </div>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  

  

  <div class="text-center mt-4">
    <a href="index.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
    <a href="tambah_karyawan.php" class="btn btn-primary">+ Tambah Karyawan</a>
  </div>
</div>

<footer>
  <small>© 2025 Sistem Gaji — by Reza</small>
</footer>

</body>
</html>
