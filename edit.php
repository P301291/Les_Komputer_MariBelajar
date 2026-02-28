<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
    // Tetap menggunakan query asli Anda
    $query = "UPDATE toy set Nama = '".$_POST["Nama"]."', Jenis_Kelamin = '".$_POST["Jenis_Kelamin"]."', Kursus = '".$_POST["Kursus"]."', Alamat = '".$_POST["Alamat"]."', Date = '".$_POST["Date"]."', No_Hp = '".$_POST["No_Hp"]."' WHERE id=".$_GET["id"];
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
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Ubah Data Siswa</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 40px 0;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            background: #ffc107; /* Warna Kuning/Emas untuk tanda "Edit" */
            color: #333;
            padding: 25px;
            border: none;
            text-align: center;
        }
        .card-header h4 {
            margin: 0;
            font-weight: 700;
        }
        .card-body {
            padding: 40px;
            background: #fff;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.15);
            border-color: #ffc107;
        }
        .readonly-field {
            background-color: #e9ecef !important;
            cursor: not-allowed;
        }
        .btn-update {
            background-color: #ffc107;
            border: none;
            color: #333;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 10px;
            transition: 0.3s;
        }
        .btn-update:hover {
            background-color: #e0a800;
            transform: translateY(-2px);
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            transition: 0.3s;
        }
        .btn-back:hover {
            background-color: #5a6268;
            color: white;
        }
        .input-group-text {
            background: #f8f9fa;
            border-radius: 10px 0 0 10px;
            border-right: none;
        }
        .has-icon .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <div class="card">
                <div class="card-header">
                    <h4><i class="bi bi-pencil-square me-2"></i>Ubah Data Siswa</h4>
                </div>
                
                <div class="card-body">
                    <?php if(isset($message)) { echo "<div class='alert alert-danger'>$message</div>"; } ?>
                    
                    <form name="frmToy" method="post" action="">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">ID Siswa</label>
                                <input type="text" name="id" class="form-control readonly-field" value="<?php echo $result[0]["id"]; ?>" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Input</label>
                                <input type="text" name="Date" class="form-control readonly-field" value="<?php echo $result[0]["Date"]; ?>" readonly>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <div class="input-group has-icon">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="Nama" class="form-control" value="<?php echo $result[0]["Nama"]; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="Jenis_Kelamin" class="form-select" style="border-radius: 10px; padding: 12px;">
                                    <option value="Laki-Laki" <?php if($result[0]["Jenis_Kelamin"]=="Laki-Laki") echo "selected"; ?>>Laki-Laki</option>
                                    <option value="Perempuan" <?php if($result[0]["Jenis_Kelamin"]=="Perempuan") echo "selected"; ?>>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. WhatsApp</label>
                                <div class="input-group has-icon">
                                    <span class="input-group-text"><i class="bi bi-whatsapp"></i></span>
                                    <input type="text" name="No_Hp" class="form-control" value="<?php echo $result[0]["No_Hp"]; ?>" required>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Kursus</label>
                                <input type="text" name="Kursus" class="form-control" value="<?php echo $result[0]["Kursus"]; ?>" required>
                            </div>

                            <div class="col-12 mb-4">
                                <label class="form-label">Alamat</label>
                                <textarea name="Alamat" class="form-control" rows="3" required><?php echo $result[0]["Alamat"]; ?></textarea>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="Data_Siswa.php" class="btn-back">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" name="submit" value="Ubah" class="btn-update">
                                Simpan Perubahan <i class="bi bi-check-circle ms-1"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>