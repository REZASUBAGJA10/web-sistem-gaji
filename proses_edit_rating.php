<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    // Update rating dan bonus di database
    $query = "UPDATE rating SET nilai_rating = '$nilai_rating', bonus_persen = '$bonus_persen' WHERE id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: rating.php"); // Redirect ke halaman daftar rating setelah berhasil
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
