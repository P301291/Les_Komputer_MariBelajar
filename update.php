<!DOCTYPE html> <!--Sudah pakai HTML 5-->
<html lang="id">
<?php
session_start();
$username_err= $password_err = $nama_err="";
if($_SESSION['level']!=1){
	header("location:login.php");
}
include('koneksi.php');
include('function.php');
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	if(empty(trim($_POST['id']))){
		die('id tidak boleh kosong');
	}else{
		$id=trim($_POST['id']);
	}
	//cek username
	if(empty(trim($_POST['username']))){
		$username_err = "Maaf username tidak boleh kosong";
	}else{
	
		$username = test_input($_POST['username']);
		$username = mysqli_real_escape_string($koneksi, $username);
	
	}
	//cek password
	if(empty(trim($_POST['password']))){
		$password_err = "Maaf password tidak boleh kosong";

	}else{
		$password = test_input($_POST['password']);
		$password = mysqli_real_escape_string($koneksi, $password);
	}
	
	//nama
	if(empty(trim($_POST['nama']))){
		$nama_err = "Maaf nama tidak boleh kosong";
	}else{
		$nama = test_input($_POST['nama']);
		$nama = mysqli_real_escape_string($koneksi, $nama);
	}
	if(empty($username_err)&&empty($password_err) && empty($password_err)){
		if(UpdateData($username, $password, $nama, $id)){

			echo 'Data berhasil di update';
			$_SESSION['id']=$id;
							$_SESSION['username']=$username;
							$_SESSION['nama']=$nama;
							
		}else{
			echo 'Data gagal di update';
		}
	}
}


?>
<html>
<head>
	
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style type="text/css">

	h2{color:white};
	.error-form{
		color: red;
	}
	body{background-color: green;}
</style>
</head>
<body>
<br>
<br>
<br>
<br>
<br>
<center>
<div class="container">
<div class="col">
	<div class="col-md-4">
		
		<h2><font color="white"><b>Silahkan Rubah Password Anda</b></h2>
		<hr/>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<div class="form-group">
		<input class="form-control" type="text" name="username" id="username" placeholder="Masukan username" value="<?php echo $_SESSION['username']; ?>"  />
		<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
		<span class="error-form"><?php echo $username_err; ?></span>
	</div>
	<div class="form-group">
		<input class="form-control" type="text" name="nama" id="nama" placeholder="Masukan nama" value="<?php echo $_SESSION['nama']; ?>"  />
		<span class="error-form"><?php echo $nama_err; ?></span>
	</div>
	
	<div class="form-group">
		<input class="form-control" type="password" name="password"  placeholder="Masukan password" />
	<span class="error-form"><?php echo $password_err; ?></span>
	</div>
	<div class="form-group">
		<input class="btn btn-primary" type="submit" name="kirim" value="Update" />
		  <input type="button" value="Go Back" onclick="history.back(1)" />
	</div>
</form>
</div>
</div>
</center>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	</body>
	</html>