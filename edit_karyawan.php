<?php
include 'config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id = $id"));


$jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
$rating = mysqli_query($koneksi, "SELECT * FROM rating");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Data Karyawan</h2>

    <form method="POST" action="proses_edit_karyawan.php">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= $data['alamat'] ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" class="form-control" value="<?= $data['umur'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Nonaktif" <?= $data['status'] == 'Nonaktif' ? 'selected' : '' ?>> Nonaktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                <option value="">-- Pilih Jabatan --</option>
                <?php while ($row = mysqli_fetch_assoc($jabatan)) { ?>
                    <option value="<?= $row['id'] ?>" <?= $data['id_jabatan'] == $row['id'] ? 'selected' : '' ?>>
                        <?= $row['nama_jabatan'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="id_rating" class="form-control" required>
                <option value="">-- Pilih Rating --</option>
                <?php while ($row = mysqli_fetch_assoc($rating)) { ?>
                    <option value="<?= $row['id'] ?>" <?= $data['id_rating'] == $row['id'] ? 'selected' : '' ?>>
                        <?= $row['nilai_rating'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Karyawan</button>
            <a href="karyawan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>

</div>

</body>
</html>
