<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config/koneksi.php';

if (
    isset($_POST['id'], $_POST['id_karyawan'], $_POST['id_jabatan'], 
          $_POST['periode_gaji'], $_POST['bonus'], 
          $_POST['tunjangan'], $_POST['jam_lembur'])
) {
   
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $id_karyawan = mysqli_real_escape_string($koneksi, $_POST['id_karyawan']);
    $id_jabatan = mysqli_real_escape_string($koneksi, $_POST['id_jabatan']);
    $periode_gaji = mysqli_real_escape_string($koneksi, $_POST['periode_gaji']);
    $bonus = mysqli_real_escape_string($koneksi, $_POST['bonus']);
    $tunjangan = mysqli_real_escape_string($koneksi, $_POST['tunjangan']);
    $jam_lembur = mysqli_real_escape_string($koneksi, $_POST['jam_lembur']);

   
    $tarif_lembur_query = mysqli_query($koneksi, "SELECT tarif FROM lembur WHERE id_jabatan = '$id_jabatan'");
    $tarif_lembur_row = mysqli_fetch_assoc($tarif_lembur_query);
    $tarif = $tarif_lembur_row['tarif'] ?? 0;

  
    $total_lembur = $tarif * (int)$jam_lembur;
    $total_gaji = (float)$bonus + (float)$tunjangan + $total_lembur;

 
    $query = mysqli_query($koneksi,  
        "UPDATE gaji SET 
            id_karyawan = '$id_karyawan', 
            id_jabatan = '$id_jabatan', 
            periode_gaji = '$periode_gaji', 
            bonus = '$bonus', 
            tunjangan = '$tunjangan', 
            jam_lembur = '$jam_lembur', 
            total_lembur = '$total_lembur', 
            total_gaji = '$total_gaji' 
         WHERE id = '$id'"
    );

    if ($query) {
        echo "<script>alert('Gaji karyawan berhasil diperbarui'); window.location='gaji.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate gaji: " . mysqli_error($koneksi) . "'); history.back();</script>";
    }
} else {
    echo "<script>alert('Data tidak lengkap.'); history.back();</script>";
}
?>
