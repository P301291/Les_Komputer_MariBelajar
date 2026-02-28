<?php
require_once("dbcontroller.php");
$db_handle = new DBController();

if(!empty($_POST["submit"])) {
    // Gunakan prepared statements di dunia nyata untuk menghindari SQL Injection!
    $query = "UPDATE toy set Nama = '".$_POST["Nama"]."', Jenis_Kelamin = '".$_POST["Jenis_Kelamin"]."', Kursus = '".$_POST["Kursus"]."', Alamat = '".$_POST["Alamat"]."', Date = '".$_POST["Date"]."', Setatus = '".$_POST["Setatus"]."' WHERE id=".$_GET["id"];
    $result = $db_handle->executeQuery($query);
    if(!$result){
        $message = "Problem in Editing! Please Retry!";
    } else {
        header("Location:Data_Siswa.php");
    }
}
$result = $db_handle->runQuery("SELECT * FROM toy WHERE id='" . $_GET["id"] . "'");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Verifikasi Data Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            color: #333;
            text-align: center;
            font-size: 24px;
            margin-bottom: 25px;
            font-weight: 600;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #555;
            margin-bottom: 5px;
        }
        .demoInputBox {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
            transition: border-color 0.3s;
            background-color: #f9f9f9;
        }
        .demoInputBox[readonly] {
            background-color: #eee;
            color: #777;
            cursor: not-allowed;
        }
        .demoInputBox:focus {
            border-color: #4A90E2;
            outline: none;
            background-color: #fff;
        }
        select.demoInputBox {
            cursor: pointer;
            background-color: #fff;
        }
        .button-group {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }
        .btnEditAction {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-submit {
            background-color: #4A90E2;
            color: white;
        }
        .btn-submit:hover {
            background-color: #357ABD;
        }
        .btn-back {
            background-color: #e0e0e0;
            color: #333;
        }
        .btn-back:hover {
            background-color: #d0d0d0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Verifikasi Data</h1>
    
    <form name="frmToy" method="post" action="">
        
        <div class="form-group">
            <label>ID Siswa</label>
            <input type="text" name="id" class="demoInputBox" value="<?php echo $result[0]["id"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="Nama" class="demoInputBox" value="<?php echo $result[0]["Nama"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label>
            <input type="text" name="Jenis_Kelamin" class="demoInputBox" value="<?php echo $result[0]["Jenis_Kelamin"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Kursus yang Diambil</label>
            <input type="text" name="Kursus" class="demoInputBox" value="<?php echo $result[0]["Kursus"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="Alamat" class="demoInputBox" value="<?php echo $result[0]["Alamat"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Tanggal Daftar</label>
            <input type="text" name="Date" class="demoInputBox" value="<?php echo $result[0]["Date"]; ?>" readonly>
        </div>

        <div class="form-group">
            <label>Status Verifikasi</label>
            <select name="Setatus" class="demoInputBox" required>
                <option value="" disabled>-- Pilih Status --</option>
                <option value="Diterima" <?php if($result[0]["Setatus"]=="Diterima") echo "selected"; ?>>Diterima</option>
                <option value="Masih Proses" <?php if($result[0]["Setatus"]=="Masih Proses") echo "selected"; ?>>Masih Proses</option>
            </select>
        </div>

        <div class="button-group">
            <input type="submit" name="submit" class="btnEditAction btn-submit" value="Simpan Perubahan" />
            <a href="Data_Siswa.php" class="btnEditAction btn-back">Kembali</a>
        </div>
    </form>
</div>

</body>
</html>