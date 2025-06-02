<?php
include 'config/koneksi.php';

$nama          = $_POST['nama'];
$alamat        = $_POST['alamat'];
$divisi        = $_POST['divisi'];
$umur          = $_POST['umur'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status        = $_POST['status']; // Pastikan status diambil
$id_jabatan    = $_POST['id_jabatan'];
$id_rating     = $_POST['id_rating'];

// Proses upload foto (foto default jika tidak diupload)
$foto = 'default.png'; // default

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $nama_file   = $_FILES['foto']['name'];
    $tmp_file    = $_FILES['foto']['tmp_name'];
    $ekstensi    = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru   = uniqid() . '.' . $ekstensi;

    $folder_tujuan = 'uploads/';
    if (!is_dir($folder_tujuan)) {
        mkdir($folder_tujuan, 0777, true);
    }

    move_uploaded_file($tmp_file, $folder_tujuan . $nama_baru);
    $foto = $nama_baru;
}

// Query untuk insert data karyawan
$query = "INSERT INTO karyawan 
    (nama, alamat, divisi, umur, jenis_kelamin, status, id_jabatan, id_rating, foto) 
    VALUES 
    ('$nama', '$alamat', '$divisi', '$umur', '$jenis_kelamin', '$status', '$id_jabatan', '$id_rating', '$foto')";

if (mysqli_query($koneksi, $query)) {
    header("Location: karyawan.php?status=sukses");
} else {
    echo "Gagal menambahkan karyawan: " . mysqli_error($koneksi);
}
?>
