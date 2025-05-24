<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    $query = mysqli_query($koneksi, "INSERT INTO rating (nilai_rating, bonus_persen) VALUES ('$nilai_rating', '$bonus_persen')");

    if ($query) {
        echo "<script>alert('Rating berhasil ditambahkan'); window.location='rating.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan rating');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Tambah Rating</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="nilai_rating">Nilai Rating</label>
            <input type="text" name="nilai_rating" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="bonus_persen">Bonus (%)</label>
            <input type="number" name="bonus_persen" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan rating</button>
        <a href="rating.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
