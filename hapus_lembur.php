<?php
include 'config/koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($koneksi, "DELETE FROM lembur WHERE id = $id");

if ($query) {
    echo "<script>alert('Data berhasil dihapus'); window.location='lembur.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus data'); history.back();</script>";
}
?>