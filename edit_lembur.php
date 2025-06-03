<?php
include 'config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT * FROM lembur WHERE id = $id");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Data tidak ditemukan'); window.location='lembur.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='lembur.php';</script>";
    exit;
}

$jabatan = mysqli_query($koneksi, "SELECT * FROM jabatan");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tarif Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Tarif Lembur</h2>

    <form method="POST" action="proses_edit_lembur.php">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Jabatan</label>
            <select name="id_jabatan" class="form-select" required>
                <option value="">Pilih Jabatan</option>
                <?php while ($j = mysqli_fetch_assoc($jabatan)) { ?>
                    <option value="<?= $j['id'] ?>" <?= $j['id'] == $data['id_jabatan'] ? 'selected' : '' ?>>
                        <?= $j['nama_jabatan'] ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="tarif">Tarif Lembur (Rp)</label>
            <input type="number" name="tarif" id="tarif" class="form-control" value="<?= $data['tarif'] ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="lembur.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
    
</body>
</html>
