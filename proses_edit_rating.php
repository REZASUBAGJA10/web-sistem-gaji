<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    
    $query = "UPDATE rating SET nilai_rating = '$nilai_rating', bonus_persen = '$bonus_persen' WHERE id = $id";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: rating.php"); 
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
