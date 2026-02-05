<?php
session_start();
/*
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("location:../login.php");
}
*/
if($_SESSION['level']!=2){
	header("location:../login.php");
}
?>
<html>
<head>
	<title>user - Multi Level Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<div class="container">
	<h2>Hai Anda masuk sebagai <?php echo htmlspecialchars($_SESSION['username']); ?><br>
		Level Anda adalah : <?php echo htmlspecialchars($_SESSION['level']); ?> </h2>
		<a href='../logout.php'>Keluar</a>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>