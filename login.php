<!DOCTYPE html> <!--Sudah pakai HTML 5-->
<?php
include('koneksi.php');
?>
<?php
$username_err = $password_err ="";
if($_SERVER['REQUEST_METHOD']=='POST'){

	if(empty(trim($_POST['username']))){
		$username_err = "Username tidak boleh kosong";
	}else{
		$username=trim($_POST['username']);
	}
	//
	if(empty(trim($_POST['password']))){
		$password_err = "Password tidak boleh kosong";
	}else{
		$password = trim($_POST['password']);
	}
	//cek sebelum melakukan select ke DB
	if(empty($username_err) && empty($password_err)){

		$sql = "SELECT id, username, password, nama,  level FROM tb_user WHERE username = ?";
		if($stmt = mysqli_prepare($koneksi, $sql)){
			mysqli_stmt_bind_param($stmt,"s",$param_username);
			$param_username = $username;
			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);
				if(mysqli_stmt_num_rows($stmt)==1){
					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $nama, $level);
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
							session_start();
							$_SESSION['id']=$id;
							$_SESSION['username']=$username;
							$_SESSION['nama']=$nama;
							$_SESSION['level']=$level;

							if($_SESSION['level']==1){
								header("location:Dashboard.php");
							}elseif($_SESSION['level']==2){	
								header("location:Data_Siswa.php");
							}

							//
						}else{
							$password_err = "Maaf password tidak cocok";
						}
					}
				}else{
					$username_err ="Maaf username tidak ditemukan";
				}
			}else{
				echo "Gagal melakukan login, coba lagi nanti";
			}
		}
		mysqli_stmt_close($stmt);


	}
	mysqli_close($koneksi);
}

?>
<script>
$(".reveal").on('click',function() {
    var $pwd = $(".pwd");
    if ($pwd.attr('type') === 'password') {
        $pwd.attr('type', 'text');
    } else {
        $pwd.attr('type', 'password');
    }
});
</script>

<html lang="id">
<head>
	<title>Login </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style_login.css"><!--CSS Eksternal-->
<style>
h2{color:brown};
	.error-form{
		color: red;
	}
		body{background-image: url("gambar/lo.jpg") ;
			 }
</style>
</head>
<body>

<br>
<br>

<center>
<div class="container">
<div class="col">
	<div class="col-md-4">
	<br>
	<br>
	<h2><b><p align="left"style="color: white;">LOGIN</p></b></h2>
	<h6><p align="left"style="color: white;">Selamat Datang Di Aplikasi Mari Belajar</p></h6>
		<hr/>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
	<div class="form-group">
	
		<input class="form-control" type="text" name="username" id="username" placeholder="Masukan username"  />
		<span class="error-form"><?php echo $username_err; ?></span>
	</div>
	
	<div class="form-group">
	
		<input class="form-control" type="password" name="password"  placeholder="Masukan password" />

	<span class="error-form"><?php echo $password_err; ?></span>

	</div>

	<div class="col-sm-12 pt-3 text-left"">

		<input class="btn-primary" type="submit" name="kirim" value="Login"/>
		 <input class="btn-primary" type="reset" value="Reset">
		
 
		
<div class="col-sm-15 pt-10 text-left"> 
	<br>
             <!--<p><b><font color="black">Lupa Password?</b> <a href="add_admin.php"><i><font color="white">Lupa Password</i></a></p>-->
              <p><b><font color="black">Perlu Bantuan?</b> <a href="https://wa.me/6285872079330"class="whatsapp_float" target="_blank" rel="noopener noreferrer"><i><font color="white">Chat Me</i></a></p>    
              	<p><b><font color="black">Kembali Ke :</b> <a href="Beranda.php"><i><font color="white">Halaman Beranda</i></a></p> 
          </div>
	</div>
</form>
</div>
</div>
</center>
</div>

	</body>

	</html>

