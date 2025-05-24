<?php
include 'config/koneksi.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM rating WHERE id = $id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Rating</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="mt-5">
    <div class="container" style="max-width: 800px;">
        <h3 class="text-center mb-4">Detail Rating</h3>
        <table class="table table-bordered">
            <tr><th>Nilai Rating</th><td><?= $data['nilai_rating'] ?></td></tr>
            <tr><th>Bonus (%)</th><td><?= $data['bonus_persen'] ?>%</td></tr>
        </table>
        <a href="rating.php" class="btn btn-secondary">← Kembali ke Daftar Rating</a>
    </div>
</body>
</html>
