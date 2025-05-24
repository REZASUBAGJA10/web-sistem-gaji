<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <h2>Tambah Rating</h2>

    <form method="POST" action="proses_tambah_rating.php">
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
