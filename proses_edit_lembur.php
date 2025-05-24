<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'], $_POST['id_jabatan'], $_POST['tarif'])) {
    
        $id = (int)$_POST['id'];
        $id_jabatan = (int)$_POST['id_jabatan'];
        $tarif = mysqli_real_escape_string($koneksi, $_POST['tarif']);

       
        $query = mysqli_query($koneksi, "UPDATE lembur SET id_jabatan = $id_jabatan, tarif = '$tarif' WHERE id = $id");

        if ($query) {
            echo "<script>alert('Tarif lembur berhasil diperbarui'); window.location='lembur.php';</script>";
        } else {
            echo "<script>alert('Gagal memperbarui tarif lembur: ".mysqli_error($koneksi)."'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Data tidak lengkap.'); history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak diizinkan.'); history.back();</script>";
}
?>
</content>
</create_file>
