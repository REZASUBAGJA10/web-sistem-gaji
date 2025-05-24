<?php 
include 'config/koneksi.php';

if (isset($_POST['id'], $_POST['nama_jabatan'], $_POST['gaji_pokok'])) {
    $id = $_POST['id'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $gaji_pokok = $_POST['gaji_pokok'];

  
    $query = mysqli_query($koneksi, "UPDATE jabatan SET nama_jabatan = '$nama_jabatan', gaji_pokok = '$gaji_pokok' WHERE id = $id");

    if ($query) {
        echo "<script>alert('Data jabatan berhasil diperbarui'); window.location='jabatan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data'); history.back();</script>";
    }
}
?>
