<?php
include 'config/koneksi.php';
$jabatan_query = mysqli_query($koneksi, "SELECT * FROM jabatan");
$rating_query = mysqli_query($koneksi, "SELECT * FROM rating");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Tambah Karyawan</h2>
    <form method="POST" action="proses_tambah_karyawan.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Divisi</label>
            <select name="divisi" class="form-select" required>
                <option value="">Pilih Divisi</option>
                <option value="IT">IT</option>
                <option value="Marketing">Marketing</option>
                <option value="Finance">Finance</option>
                <option value="HRD">HRD</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="Aktif">Aktif</option>
                <option value="NonAktif">NonAktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                <?php while ($jabatan = mysqli_fetch_assoc($jabatan_query)) { ?>
                    <option value="<?= $jabatan['id'] ?>"><?= $jabatan['nama_jabatan'] ?></option>
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
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Karyawan</button>
            <a href="karyawan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
