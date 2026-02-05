<?php
    include 'database.php';

    $id_gambar=$_GET["id_gambar"];
    $gambar=$_GET["gambar"];
    $sql="delete from tb_Header where id_gambar=$id_gambar";
    $hapus_bank=mysqli_query($kon,$sql);

    //Menghapus file gambar
    unlink("gambar/".$gambar);

    if ($hapus_bank) {
        header("Location:Input_Header.php?hapus=berhasil");
    }
    else {
        header("Location:Input_Header.php?hapus=gagal");

    }
?>