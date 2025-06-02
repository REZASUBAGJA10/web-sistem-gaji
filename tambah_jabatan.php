<?php 
include 'config/koneksi.php';

if (isset($_POST['nama_jabatan'], $_POST['gaji_pokok'])) {
    $nama_jabatan = $_POST['nama_jabatan'];
    $gaji_pokok = $_POST['gaji_pokok'];

    $query = mysqli_query($koneksi, "INSERT INTO jabatan (nama_jabatan, gaji_pokok) VALUES ('$nama_jabatan', '$gaji_pokok')");

    if ($query) {
        echo "<script>alert('Jabatan berhasil ditambahkan'); window.location='jabatan.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah jabatan'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jabatan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Tambah Jabatan</h2>

    <form method="POST">
        <div class="mb-3">
            <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="nama_jabatan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
            <input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Jabatan</button>
            <a href="jabatan.php" class="btn btn-secondary">← Kembali</a>
        </div>
    </form>
</body>
</html>
