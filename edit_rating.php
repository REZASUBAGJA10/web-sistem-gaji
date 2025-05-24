<?php
include 'config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM rating WHERE id = $id");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Rating</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<div class="container">
    <h2>Edit Rating</h2>

    <form action="proses_edit_rating.php" method="POST">
   
        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <div class="mb-3">
            <label for="nilai_rating">Nilai Rating</label>
            <input type="text" name="nilai_rating" class="form-control" value="<?= $data['nilai_rating'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="bonus_persen">Bonus (%)</label>
            <input type="number" name="bonus_persen" class="form-control" value="<?= $data['bonus_persen'] ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan rating</button>
            <a href="rating.php" class="btn btn-secondary">Kembali</a>
        </form>
</div>
</body>
</html>
