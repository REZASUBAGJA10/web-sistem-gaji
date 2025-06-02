<?php include 'config/koneksi.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Gaji Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Tambah Gaji Karyawan</h2>

    <form method="POST" action="proses_tambah_gaji.php">
        <div class="mb-3">
            <label class="form-label">Karyawan</label>
            <select name="id_karyawan" class="form-control" required>
                <option value="">Pilih Karyawan</option>
                <?php
                $karyawan = mysqli_query($koneksi, "SELECT * FROM karyawan");
                while ($k = mysqli_fetch_assoc($karyawan)) {
                    echo "<option value='{$k['id']}'>{$k['nama']}</option>";
                }
                ?>
            </select>
        </div>

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
            <label class="form-label">Periode Gaji</label>
            <input type="text" name="periode_gaji" class="form-control" placeholder="Contoh: April 2025" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bonus (Rp)</label>
            <input type="number" name="bonus" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tunjangan (Rp)</label>
            <input type="number" name="tunjangan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jam Lembur</label>
            <input type="number" name="jam_lembur" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Gaji</button>
            <a href="gaji.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
