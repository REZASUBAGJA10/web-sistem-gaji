<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Rating</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5" style="max-width: 700px;">
    <h2 class="text-center mb-4">Tambah Rating</h2>

    <form method="POST" action="proses_tambah_rating.php">
        <div class="mb-3">
            <label class="form-label" for="nilai_rating">Nilai Rating</label>
            <select name="nilai_rating" class="form-control" required>
                <option value="1">1 ★</option>
                <option value="2">2 ★★</option>
                <option value="3">3 ★★★</option>
                <option value="4">4 ★★★★</option>
                <option value="5">5 ★★★★★</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="bonus_persen">Bonus (%)</label>
            <input type="number" name="bonus_persen" class="form-control" min="0" max="100" required>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan Rating</button>
            <a href="rating.php" class="btn btn-secondary">Kembali</a>
        </div>
    </form>

</body>
</html>
