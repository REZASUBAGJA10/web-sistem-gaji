<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nilai_rating = $_POST['nilai_rating'];
    $bonus_persen = $_POST['bonus_persen'];

    $query = mysqli_query($koneksi, "INSERT INTO rating (nilai_rating, bonus_persen) VALUES ('$nilai_rating', '$bonus_persen')");

    if ($query) {
        echo "<script>alert('Rating berhasil ditambahkan'); window.location='rating.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan rating'); window.location='tambah_rating.php';</script>";
    }
} else {
    header("Location: tambah_rating.php");
    exit;
}
