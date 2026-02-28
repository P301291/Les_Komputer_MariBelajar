<?php
// 1. Session HARUS di paling atas sebelum ada output HTML apapun
session_start();

// 2. Cek login
if (!isset($_SESSION['level']) || $_SESSION['level'] != 1) {
    header("location:login.php");
    exit(); // Selalu gunakan exit setelah header location
}

include('koneksi.php');
include('function.php');

// Inisialisasi variabel agar tidak "Undefined Variable"
$username_err = $password_err = $nama_err = "";
$status_msg = "";

// 3. Logika Post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Cek ID
    if (empty(trim($_POST['id']))) {
        die('ID tidak boleh kosong');
    } else {
        $id = $_POST['id'];
    }

    // Validasi Username
    if (empty(trim($_POST['username']))) {
        $username_err = "Maaf username tidak boleh kosong";
    } else {
        $username = mysqli_real_escape_string($koneksi, test_input($_POST['username']));
    }

    // Validasi Nama
    if (empty(trim($_POST['nama']))) {
        $nama_err = "Maaf nama tidak boleh kosong";
    } else {
        $nama = mysqli_real_escape_string($koneksi, test_input($_POST['nama']));
    }

    // Validasi Password
    if (empty(trim($_POST['password']))) {
        $password_err = "Maaf password tidak boleh kosong";
    } else {
        $password = mysqli_real_escape_string($koneksi, test_input($_POST['password']));
    }

    // Jika tidak ada error, eksekusi Update
    if (empty($username_err) && empty($password_err) && empty($nama_err)) {
        if (UpdateData($username, $password, $nama, $id)) {
            $status_msg = '<div class="alert alert-success">Data berhasil di-update!</div>';
            // Update session agar tampilan di form ikut berubah
            $_SESSION['username'] = $username;
            $_SESSION['nama'] = $nama;
        } else {
            $status_msg = '<div class="alert alert-danger">Data gagal di-update ke database.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profil</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        body { background-color: #2ecc71; font-family: sans-serif; }
        .card-container { margin-top: 100px; }
        .card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        .error-form { color: red; font-size: 0.8em; font-style: italic; }
    </style>
</head>
<body>

<div class="container card-container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h3 class="text-center mb-4">Ubah Password & Profil</h3>
                <hr>
                
                <?php echo $status_msg; ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                        <span class="error-form"><?php echo $username_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['nama']; ?>">
                        <span class="error-form"><?php echo $nama_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Isi password baru">
                        <span class="error-form"><?php echo $password_err; ?></span>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-block">Update Sekarang</button>
                        <button type="button" class="btn btn-outline-secondary btn-block" onclick="history.back()">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>