<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["id"])) {
    $query = "DELETE FROM toy WHERE id=".$_GET["id"];
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:Data_Siswa.php");
	}
}
?>