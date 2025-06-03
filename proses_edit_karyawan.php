<?php
include 'config/koneksi.php';

$id = $_POST['id'];
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$divisi = mysqli_real_escape_string($koneksi, $_POST['divisi']);
$umur = (int)$_POST['umur'];
$jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$id_jabatan = (int)$_POST['id_jabatan'];
$id_rating = (int)$_POST['id_rating'];


$result = mysqli_query($koneksi, "SELECT foto FROM karyawan WHERE id = $id");
$row = mysqli_fetch_assoc($result);
$foto_lama = $row['foto']; 


$foto = $foto_lama; 

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    $nama_file = $_FILES['foto']['name'];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);
    $nama_baru = uniqid() . '.' . $ekstensi;

    $folder_tujuan = 'uploads/';
    if (!is_dir($folder_tujuan)) {
        mkdir($folder_tujuan, 0777, true);
    }

    move_uploaded_file($tmp_file, $folder_tujuan . $nama_baru);
    $foto = $nama_baru;
}


$query = "UPDATE karyawan SET 
            nama = '$nama',
            alamat = '$alamat',
            divisi = '$divisi',
            umur = $umur,
            jenis_kelamin = '$jenis_kelamin',
            status = '$status',
            id_jabatan = $id_jabatan,
            id_rating = $id_rating,
            foto = '$foto' 
          WHERE id = $id";

$update = mysqli_query($koneksi, $query);

if ($update) {
    header("Location: karyawan.php?status=update_sukses");
} else {
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
?>
