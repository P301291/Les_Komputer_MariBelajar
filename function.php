<?php
function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
function Add_User($username, $password, $nama, $level){
global $koneksi;
$sql="INSERT INTO tb_user(username, password, nama, level) VALUES (?,?,?,?)";
	if($stmt=mysqli_prepare($koneksi, $sql)){
		//set parameter
		mysqli_stmt_bind_param($stmt,"ssss",$param_username, $param_password, $param_nama, $param_level);
		$param_username = $username;
		$param_password = password_hash($password, PASSWORD_DEFAULT);
		$param_nama = $nama;
		$param_level = $level;
		if(mysqli_execute($stmt)){
			return true;
		}else{
			return false;
		}
	}
	mysqli_stmt_close($stmt);
}
function Cek_User($username){
	global $koneksi;
	$sql="SELECT id FROM tb_user WHERE username=?";
	if($stmt=mysqli_prepare($koneksi, $sql)){
		//set parameter
		mysqli_stmt_bind_param($stmt,"s",$param_username);
			$param_username = $username;
		if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_store_result($stmt);
			if(mysqli_stmt_num_rows($stmt)==1){
				return true;
			}else{
				return false;
			}
		}
	}
	mysqli_stmt_close($stmt);

}
function SessionActive(){
	global $array;
	$array=array(
		$_SESSION['id'],
		$_SESSION['username'],
		$_SESSION['nama'],
		$_SESSION['level']

	);
}
function UpdateData($username, $password, $nama, $id){
	global $koneksi;
	$sql="UPDATE tb_user SET username=?, password=?, nama=? WHERE id=?";
	if($stmt=mysqli_prepare($koneksi, $sql)){

		mysqli_stmt_bind_param($stmt,"sssi",$param_username, $param_password, $param_nama, $param_id);

		//set parameter
		$param_username=$username;
		$param_password=password_hash($password, PASSWORD_DEFAULT);
		$param_nama=$nama;		
		$param_id=$id;
		if(mysqli_stmt_execute($stmt)){
			return true;
		}else{
			return false;
		}
	}
	mysqli_stmt_close($stmt);
}
?>