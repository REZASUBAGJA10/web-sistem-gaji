<?php
include 'config/koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM rating WHERE id = $id");

if ($query) {
    echo "<script>alert('Data berhasil dihapus'); window.location='rating.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); history.back();</script>";
}
?>
