<?php
include 'config/koneksi.php';


if (isset($_GET['id'])) {
  
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

   
    $cek = mysqli_query($koneksi, "SELECT * FROM gaji WHERE id_jabatan = '$id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>
            alert('Jabatan tidak bisa dihapus karena sedang digunakan dalam data gaji!');
            window.location.href = 'jabatan.php';
        </script>";
    } else {
      
        $hapus = mysqli_query($koneksi, "DELETE FROM jabatan WHERE id='$id'");
        if ($hapus) {
            echo "<script>
                alert('Data jabatan berhasil dihapus!');
                window.location.href = 'jabatan.php';
            </script>";
        } else {
            echo "<script>
                alert('Gagal menghapus jabatan!');
                window.location.href = 'jabatan.php';
            </script>";
        }
    }
} else {
    echo "<script>
        alert('ID jabatan tidak ditemukan!');
        window.location.href = 'jabatan.php';
    </script>";
}
?>
