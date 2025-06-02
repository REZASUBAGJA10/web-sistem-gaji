<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tarif Lembur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Tambah Tarif Lembur</h2>
    <form method="POST" action="proses_tambah_lembur.php">
        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                <?php
                $jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
                while ($j = mysqli_fetch_assoc($jabatan)) {
                    echo "<option value='{$j['id']}'>{$j['nama_jabatan']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tarif (Rp)</label>
            <input type="number" name="tarif" class="form-control" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Lembur</button>
            <a href="lembur.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</body>
</html>
