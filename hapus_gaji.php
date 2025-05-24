<?php 
include 'config/koneksi.php';


$id = $_GET['id'] ?? null;


if ($id) {

    $query = mysqli_query($koneksi, "DELETE FROM gaji WHERE id = $id");

    if ($query) {
       
        echo "<script>alert('Gaji karyawan berhasil dihapus'); window.location='gaji.php';</script>";
    } else {
    
        echo "<script>alert('Gagal menghapus gaji karyawan'); window.location='gaji.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak valid!'); window.location='gaji.php';</script>";
}
?>
