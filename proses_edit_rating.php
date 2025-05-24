<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    $query = mysqli_query($koneksi, "UPDATE rating SET nilai_rating='$nilai_rating', bonus_persen='$bonus_persen' WHERE id=$id");

    if ($query) {
        echo "<script>alert('Data rating berhasil diperbarui'); window.location='rating.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); history.back();</script>";
    }
} else {
    header("Location: rating.php");
    exit;
}
?>
