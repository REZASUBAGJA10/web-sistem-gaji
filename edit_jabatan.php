<?php 
include 'config/koneksi.php';

$id = $_GET['id'] ?? null;


if ($id) {

    $query = mysqli_query($koneksi, "SELECT * FROM jabatan WHERE id = $id");

    
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
    } else {
        echo "<script>alert('Jabatan tidak ditemukan!'); window.location='jabatan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='jabatan.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Jabatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Jabatan</h2>

    <form method="POST" action="proses_edit_jabatan.php">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" value="<?= $data['nama_jabatan'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" value="<?= $data['gaji_pokok'] ?>" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="jabatan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
