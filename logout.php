<?php
session_start();
unset($_SESSION['level']);
session_destroy();
header("location:login.php");
?>