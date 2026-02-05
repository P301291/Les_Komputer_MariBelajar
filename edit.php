<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"><!--Code Responsipe-->
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
    $query = "UPDATE toy set Nama = '".$_POST["Nama"]."', Jenis_Kelamin = '".$_POST["Jenis_Kelamin"]."', Kursus = '".$_POST["Kursus"]."', Kursus = '".$_POST["Kursus"]."', Alamat = '".$_POST["Alamat"]."', Date = '".$_POST["Date"]."' WHERE  id=".$_GET["id"];
    $result = $db_handle->executeQuery($query);
	if(!$result){
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:Data_Siswa.php");
	}
}
$result = $db_handle->runQuery("SELECT * FROM toy WHERE id='" . $_GET["id"] . "'");
?>
<link href="css/style_add.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

	<br>
<p><form name="frmToy" method="post" action="" class="frmToy" onClick="return validate();">
	<br>

<div id="mail-status"></div>
<center>
<div class="text" style="color:white"><h1>Ubah Data</h1></div>
</center>
<br>
<div>

<label style="padding-top:20px;">Id</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="id" id="id" class="demoInputBox" value="<?php echo $result[0]["id"]; ?>"class="field left" readonly>
</div>
<div>
<label style="padding-top:20px;">Nama</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="Nama" id="Nama" class="demoInputBox" value="<?php echo $result[0]["Nama"]; ?>">
</div>
<div>
<label>Jenis Kelamin</label>
<span id="code-info" class="info"></span><br/>
<input type="text" autofocus="autofocus" name="Jenis_Kelamin" id="Jenis_Kelamin" class="demoInputBox" value="<?php echo $result[0]["Jenis_Kelamin"]; ?>">
</div>
<div>
<label>Kursus</label> 
<span id="category-info" class="info"></span><br/>
<input type="text" name="Kursus" id="Kursus" class="demoInputBox" value="<?php echo $result[0]["Kursus"]; ?>">
</div>
<div>
<label>Alamat</label> 
<span id="pay-info" class="info"></span><br/>
<input type="text" name="Alamat" id="Alamat" class="demoInputBox" value="<?php echo $result[0]["Alamat"]; ?>">
</div>
<div>
<label>Date</label> 
<span id="Date-info" class="info"></span><br/>
<input type="text" name="Date" id="Date" class="demoInputBox" value="<?php echo $result[0]["Date"]; ?>"class="field left" readonly>
</div>
<div>
	<br>
<input type="submit" name="submit" class="btnEditAction" value="Ubah" />
<input type="button" value="Kembali" id="btnAddAction"onclick="history.back(-1)" />
</div>

</div>