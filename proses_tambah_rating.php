<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    // Menyimpan rating dan bonus ke database
    $query = "INSERT INTO rating (nilai_rating, bonus_persen) VALUES ('$nilai_rating', '$bonus_persen')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: rating.php"); // Redirect ke halaman daftar rating setelah berhasil
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
