<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Rating</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin-top: 8%;
            margin-bottom: 80px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 20px;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .card-rating {
            margin-bottom: 15px;
        }

        .card-rating .card-body p {
            margin: 2px 0;
        }


        .star {
            color: #FFD700; 
            font-size: 20px; 
        }

        @media (max-width: 768px) {
            table {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Daftar Rating</h2>

    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nilai Rating</th>
                    <th>Bonus</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $rating = mysqli_query($koneksi, "SELECT * FROM rating");
                while ($row = mysqli_fetch_assoc($rating)) {
                    $nilai_rating = $row['nilai_rating']; 

                   
                    $fullStars = $nilai_rating;
                    $emptyStars = 5 - $fullStars; 

                    
                    $stars = '';
                    $fullStar = '★'; 
                    $emptyStar = '☆'; 

                  
                    $stars .= str_repeat('<span class="star">' . $fullStar . '</span>', $fullStars);
            
                    $stars .= str_repeat('<span class="star">' . $emptyStar . '</span>', $emptyStars);
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $stars ?></td> 
                    <td><?= $row['bonus_persen'] ?>%</td> 
                    <td>
                        <div class="d-flex justify-content-center gap-1 flex-wrap">
                            <a href="edit_rating.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus_rating.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                            <a href="detail_rating.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="d-md-none">
        <?php
        mysqli_data_seek($rating, 0); 
        $no = 1;
        while ($row = mysqli_fetch_assoc($rating)) {
            $nilai_rating = $row['nilai_rating']; 

            
            $fullStars = $nilai_rating;
            $emptyStars = 5 - $fullStars; 

          
            $stars = '';
            $fullStar = '★';
            $emptyStar = '☆'; 

         
            $stars .= str_repeat('<span class="star">' . $fullStar . '</span>', $fullStars);
       
            $stars .= str_repeat('<span class="star">' . $emptyStar . '</span>', $emptyStars);
        ?>
        <div class="card card-rating shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?= $no++ ?>. Rating <?= $row['nilai_rating'] ?></h5>
                <p><strong>Bonus:</strong> <?= $stars ?></p>
                <div class="d-flex justify-content-center gap-2 mt-2 flex-wrap">
                    <a href="edit_rating.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_rating.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    <a href="detail_rating.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <div class="d-flex flex-wrap gap-2 mb-3 mt-3 justify-content-center">
        <a href="index.php" class="btn btn-secondary btn-sm">← Kembali ke Dashboard</a>
        <a href="tambah_rating.php" class="btn btn-primary btn-sm">+ Tambah Rating</a>
    </div>
</div>

<footer class="w-100 px-4 py-2 text-end shadow-sm"
        style="position: fixed; bottom: 0; left: 0; right: 0; background-color: #f8f9fa; z-index: 1040;">
    <small>© 2025 Sistem Gaji — by Reza</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
