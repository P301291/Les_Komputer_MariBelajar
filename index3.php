<?php
include('koneksi.php');
include('function.php');

$username_err = $password_err = $nama_err = $level_err = $konfir_password_err = "";
$username = $password = $nama = $level = $konfir_password = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    // ... (Logika PHP Anda tetap sama karena sudah benar) ...
    if(empty(trim($_POST['username']))){
        $username_err = "Maaf username tidak boleh kosong";
    }else{
        if(Cek_User($_POST['username'])){
            $username_err = "Maaf username sudah ada";
        }else{
            $username = test_input($_POST['username']);
            $username = mysqli_real_escape_string($koneksi, $username);
        }
    }
    if(empty(trim($_POST['password']))){
        $password_err = "Maaf password tidak boleh kosong";
    }else{
        $password = test_input($_POST['password']);
        $password = mysqli_real_escape_string($koneksi, $password);
    }
    if(empty(trim($_POST['konfir_password']))){
        $konfir_password_err = "Maaf konfirmasi password tidak boleh kosong";
    }else{
        $konfir_password = trim($_POST['konfir_password']);
        if($password != $konfir_password){
            $konfir_password_err = "Maaf password tidak cocok";
        }
    }
    if(empty(trim($_POST['nama']))){
        $nama_err = "Maaf nama tidak boleh kosong";
    }else{
        $nama = test_input($_POST['nama']);
        $nama = mysqli_real_escape_string($koneksi, $nama);
    }
    if(empty(trim($_POST['level']))){
        $level_err = "Maaf level tidak boleh kosong";
    }else{
        $level = test_input($_POST['level']);
        $level = mysqli_real_escape_string($koneksi, $level);
    }

    if(empty($username_err) && empty($password_err) && empty($nama_err) && empty($level_err) && empty($konfir_password_err)){
        if(Add_User($username, $password, $nama, $level)){
            echo "<script>alert('Data berhasil disimpan!'); window.location.href='Ganti_Pas.php';</script>";
        }else{
            echo "<script>alert('Data gagal disimpan!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User Baru</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
    <style>
        body {
            background: linear-gradient(135deg, #11101d 0%, #2c3e50 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.4);
            width: 100%;
            max-width: 450px;
            backdrop-filter: blur(10px);
        }

        .register-card h2 {
            color: #11101d;
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .register-card p {
            text-align: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 15px 12px 45px;
            border: 1px solid #ddd;
            height: auto;
            transition: all 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 10px rgba(19, 6, 133, 0.1);
            border-color: #130685;
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 14px;
            font-size: 20px;
            color: #130685;
        }

        .error-form {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            font-weight: 500;
        }

        .btn-register {
            background-color: #130685;
            color: white;
            border: none;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-register:hover {
            background-color: #0c045a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(19, 6, 133, 0.3);
            color: white;
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #666;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-back:hover {
            color: #130685;
            text-decoration: underline;
        }

        hr {
            border-top: 2px solid #130685;
            width: 50px;
            margin: 0 auto 20px auto;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Tambah User</h2>
    <hr>
    <p>Silakan lengkapi data di bawah ini untuk mendaftarkan pengguna baru.</p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        
        <div class="form-group">
            <i class='bx bxs-user-circle'></i>
            <input class="form-control" type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" />
            <span class="error-form"><?php echo $username_err; ?></span>
        </div>
        
        <div class="form-group">
            <i class='bx bxs-id-card'></i>
            <input class="form-control" type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo $nama; ?>" />
            <span class="error-form"><?php echo $nama_err; ?></span>
        </div>

        <div class="form-group">
            <i class='bx bxs-badge-check'></i>
            <input class="form-control" type="text" name="level" placeholder="Level (Admin/User)" value="<?php echo $level; ?>" />
            <span class="error-form"><?php echo $level_err; ?></span>
        </div>

        <div class="form-group">
            <i class='bx bxs-lock-alt'></i>
            <input class="form-control" type="password" name="password" placeholder="Password" />
            <span class="error-form"><?php echo $password_err; ?></span>
        </div>

        <div class="form-group">
            <i class='bx bxs-shield-quarter'></i>
            <input class="form-control" type="password" name="konfir_password" placeholder="Konfirmasi Password" />
            <span class="error-form"><?php echo $konfir_password_err; ?></span>
        </div>

        <button type="submit" name="kirim" class="btn-register">
            <i class='bx bx-user-plus'></i> DAFTAR SEKARANG
        </button>

        <a href="Ganti_Pas.php" class="btn-back">
            <i class='bx bx-arrow-back'></i> Kembali ke Halaman Sebelumnya
        </a>
    </form>
</div>

</body>
</html>