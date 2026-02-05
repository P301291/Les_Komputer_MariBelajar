<?php

session_start();

if($_SESSION['level']!=1){
	header("location:index5.php");
}
include('function.php');

?>
<html>
<head>
	<title>Admin - Multi Level Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>
<body>
<div class="container">
	<h2>Login Multi Level - Refresh Session Without Relogin</h2>
	<table border=1>
	<tr>
		<th>Nama</th>
		<th>Username</th>
		<th>Level</th>
	</tr>
	<tr>
		<td><?php echo $_SESSION['nama']; ?></td>
		<td><?php echo $_SESSION['username']; ?></td>
		<td><?php echo $_SESSION['level']; ?></td>
	</tr>


	</table>
		<a href='../logout.php'>Keluar</a> | <a href='update.php'>Update</a>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>