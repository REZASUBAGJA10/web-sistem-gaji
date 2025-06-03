<?php 
include 'config/koneksi.php'; 

$id = $_GET['id']; 
$query = "SELECT * FROM rating WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Rating</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Edit Rating</h2>

    <form method="POST" action="proses_edit_rating.php">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label class="form-label" for="nilai_rating">Nilai Rating</label>
            <select name="nilai_rating" class="form-control" required>
                <option value="1" <?= $row['nilai_rating'] == 1 ? 'selected' : '' ?>>1 ★</option>
                <option value="2" <?= $row['nilai_rating'] == 2 ? 'selected' : '' ?>>2 ★★</option>
                <option value="3" <?= $row['nilai_rating'] == 3 ? 'selected' : '' ?>>3 ★★★</option>
                <option value="4" <?= $row['nilai_rating'] == 4 ? 'selected' : '' ?>>4 ★★★★</option>
                <option value="5" <?= $row['nilai_rating'] == 5 ? 'selected' : '' ?>>5 ★★★★★</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bonus_persen">Bonus (%)</label>
            <input type="number" name="bonus_persen" class="form-control" value="<?= $row['bonus_persen'] ?>" min="0" max="100" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Update Rating</button>
            <a href="rating.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</body>
</html>
