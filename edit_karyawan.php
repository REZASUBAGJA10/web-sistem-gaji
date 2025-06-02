<?php
include 'config/koneksi.php';

$id = $_GET['id']; // Ambil ID karyawan dari URL
$query = "SELECT * FROM karyawan WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

// Ambil data jabatan dan rating untuk dropdown
$jabatan_query = mysqli_query($koneksi, "SELECT * FROM jabatan");
$rating_query = mysqli_query($koneksi, "SELECT * FROM rating");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .star {
            color: #FFD700; /* Warna kuning */
            font-size: 20px; /* Ukuran bintang */
        }
    </style>
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Karyawan</h2>
    <form method="POST" action="proses_edit_karyawan.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $row['alamat'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Divisi</label>
            <select name="divisi" class="form-select" required>
                <option value="IT" <?= $row['divisi'] == 'IT' ? 'selected' : '' ?>>IT</option>
                <option value="Marketing" <?= $row['divisi'] == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                <option value="Finance" <?= $row['divisi'] == 'Finance' ? 'selected' : '' ?>>Finance</option>
                <option value="HRD" <?= $row['divisi'] == 'HRD' ? 'selected' : '' ?>>HRD</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" class="form-control" value="<?= $row['umur'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki" <?= $row['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $row['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Aktif" <?= $row['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="NonAktif" <?= $row['status'] == 'NonAktif' ? 'selected' : '' ?>>NonAktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                <?php while ($jabatan = mysqli_fetch_assoc($jabatan_query)) { ?>
                    <option value="<?= $jabatan['id'] ?>" <?= $row['id_jabatan'] == $jabatan['id'] ? 'selected' : '' ?>><?= $jabatan['nama_jabatan'] ?></option>
                <?php } ?>
            </select>
        </div>

      
        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="id_rating" class="form-control" required>
                <option value="">Pilih Rating</option>
                <?php while ($rating = mysqli_fetch_assoc($rating_query)) { ?>
                    <option value="<?= $rating['id'] ?>"><?= $rating['nilai_rating'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
            <img src="uploads/<?= $row['foto'] ?>" width="100" class="mt-2" alt="Foto Karyawan">
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update Karyawan</button>
            <a href="karyawan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
