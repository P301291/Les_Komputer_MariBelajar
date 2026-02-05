<?php 
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PAS', '');
define('DB_NAME', 'db_user');
$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PAS, DB_NAME);
if($koneksi==false){
	die("Gagal melakukan koneksi".mysqli_connect_error());
}

?>