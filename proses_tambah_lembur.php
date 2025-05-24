<?php
include 'config/koneksi.php';

$id_jabatan = $_POST['id_jabatan'];
$tarif = $_POST['tarif'];

mysqli_query($koneksi, "INSERT INTO lembur (id_jabatan, tarif) VALUES ('$id_jabatan', '$tarif')");

echo "<script>alert('Data lembur berhasil ditambahkan'); window.location='lembur.php';</script>";
?>
