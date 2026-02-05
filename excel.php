<?php 
    // Pastikan tidak ada spasi atau karakter apapun sebelum tag <?php
    
    // Header untuk Excel versi lama tapi dengan proteksi karakter
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=mari_belajar.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Tambahkan perintah ini agar karakter spesial (seperti simbol atau aksen) terbaca benar
    echo "\xef\xbb\xbf"; 
     
    // Pastikan data.php berisi tabel HTML murni (<table>...</table>)
    include 'data.php';
    
    exit;
?>