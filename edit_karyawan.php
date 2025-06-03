<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM karyawan WHERE id = $id"));
$jabatan_query = mysqli_query($koneksi, "SELECT * FROM jabatan");
$rating_query = mysqli_query($koneksi, "SELECT * FROM rating");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Karyawan</h2>
    <form method="POST" action="proses_edit_karyawan.php" enctype="multipart/form-data">
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
            <label class="form-label">Divisi</label>
            <select name="divisi" class="form-select" required>
                <option value="">Pilih Divisi</option>
                <?php
                $divisi = ['IT', 'Marketing', 'Finance', 'HRD'];
                foreach ($divisi as $d) {
                    $selected = ($data['divisi'] == $d) ? 'selected' : '';
                    echo "<option value='$d' $selected>$d</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Umur</label>
            <input type="number" name="umur" class="form-control" value="<?= $data['umur'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih Status</option>
                <option value="Aktif" <?= $data['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="NonAktif" <?= $data['status'] == 'NonAktif' ? 'selected' : '' ?>>NonAktif</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-control" required>
                <option value="">Pilih Jabatan</option>
                <?php while ($jabatan = mysqli_fetch_assoc($jabatan_query)) { ?>
                    <option value="<?= $jabatan['id'] ?>" <?= $data['id_jabatan'] == $jabatan['id'] ? 'selected' : '' ?>>
                        <?= $jabatan['nama_jabatan'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        

        <div class="mb-3">
            <label class="form-label">Rating</label>
            <select name="id_rating" class="form-control" required>
                <option value="">Pilih Rating</option>
                <?php while ($rating = mysqli_fetch_assoc($rating_query)) { ?>
                    <option value="<?= $rating['id'] ?>" <?= $data['id_rating'] == $rating['id'] ? 'selected' : '' ?>>
                        <?= $rating['nilai_rating'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto (jika ingin ganti)</label>
            <input type="file" name="foto" class="form-control">
            <div class="mt-2">
                <small>Foto sekarang:</small><br>
                <img src="uploads/<?= $data['foto'] ?>" alt="Foto" width="100">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="karyawan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
