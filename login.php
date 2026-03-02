<?php
// Simulasi loading lambat (opsional)
sleep(1);
include('koneksi.php');

$username_err = $password_err = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty(trim($_POST['username']))) {
        $username_err = "Username tidak boleh kosong";
    } else {
        $username = trim($_POST['username']);
    }

    if (empty(trim($_POST['password']))) {
        $password_err = "Password tidak boleh kosong";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password, nama, level FROM tb_user WHERE username = ?";
        if ($stmt = mysqli_prepare($koneksi, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $nama, $level);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            $_SESSION['nama'] = $nama;
                            $_SESSION['level'] = $level;
                            header("location:Dashboard.php");
                        } else {
                            $password_err = "Maaf, password tidak cocok.";
                        }
                    }
                } else {
                    $username_err = "Maaf, username tidak ditemukan.";
                }
            } else {
                echo "Gagal melakukan login, coba lagi nanti.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Mari Belajar</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <style>
        :root {
            --primary: #4361ee;
            --dark: #1e293b;
            --light-bg: #f8fafc;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(rgba(30, 41, 59, 0.8), rgba(30, 41, 59, 0.8)), url("gambar/lo.jpg");
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        /* Loading Screen */
        #loading-screen {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: white; display: flex; justify-content: center; align-items: center;
            z-index: 9999; transition: 0.5s;
        }
        .spinner {
            width: 50px; height: 50px; border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary); border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* Container untuk Logo di atas Form */
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 900px;
        }

        .top-logo-container {
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            margin-bottom: -50px; /* Membuat logo mengapung di atas */
            z-index: 10;
            overflow: hidden;
            border: 4px solid white;
        }

        .top-logo-container img {
            width: 80%; /* Menjamin logo tidak memenuhi lingkaran agar rapi */
            height: auto;
            object-fit: contain;
        }

        /* Login Container */
        .login-wrapper {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            background: white;
            width: 95%;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding-top: 40px; /* Ruang untuk logo */
        }

        .login-form-side { padding: 50px; }

        .form-group label { font-size: 14px; font-weight: 600; color: #64748b; }
        .form-control {
            border-radius: 12px; padding: 12px 15px; border: 1px solid #e2e8f0;
            background: #f8fafc; transition: 0.3s;
        }
        .form-control:focus { box-shadow: 0 0 0 4px rgba(67, 97, 238, 0.1); border-color: var(--primary); }

        .btn-login {
            background: var(--primary); color: white; border: none;
            width: 100%; padding: 12px; border-radius: 12px;
            font-weight: 700; margin-top: 20px; transition: 0.3s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 10px 15px rgba(67, 97, 238, 0.3); color: white; }

        .guide-side {
            background: var(--dark); padding: 50px; color: white;
            display: flex; flex-direction: column; justify-content: center;
        }

        .guide-item { display: flex; gap: 15px; margin-bottom: 25px; }
        .guide-icon {
            background: rgba(255,255,255,0.1); width: 35px; height: 35px; min-width: 35px;
            border-radius: 10px; display: flex; justify-content: center; align-items: center; color: #4cc9f0;
        }

        .guide-text h5 { font-size: 15px; margin-bottom: 5px; font-weight: 600; }
        .guide-text p { font-size: 13px; opacity: 0.7; margin: 0; line-height: 1.4; }
        .error-form { font-size: 12px; color: #ef4444; margin-top: 5px; display: block; }

        @media (max-width: 768px) {
            .login-wrapper { grid-template-columns: 1fr; }
            .guide-side { display: none; }
        }
    </style>
</head>
<body>

    <div id="loading-screen">
        <div class="spinner"></div>
    </div>

    <div class="main-container">
        <div class="top-logo-container">
            <img src="gambar/logo.png" onerror="this.src='https://cdn-icons-png.flaticon.com/512/3413/3413535.png'" alt="Logo">
        </div>

        <div class="login-wrapper">
            <div class="login-form-side">
                <h3 style="font-weight: 800; color: var(--dark);">Masuk Aplikasi</h3>
                <p style="color: #64748b; margin-bottom: 30px;">Selamat Datang Di Aplikasi Mari Belajar</p>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Contoh: admin@gmail.com">
                        <span class="error-form"><?php echo $username_err; ?></span>
                    </div>

                    <div class="form-group mt-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                        <span class="error-form"><?php echo $password_err; ?></span>
                    </div>

                    <button type="submit" class="btn-login">Masuk Sekarang</button>
                </form>

                <div style="margin-top: 30px; border-top: 1px solid #f1f5f9; padding-top: 20px; font-size: 13px;">
                    <p style="color: #94a3b8;">Bantuan & Navigasi:</p>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a href="Beranda.php" style="color: var(--primary); font-weight: 600; text-decoration:none;"><i class='bx bx-left-arrow-alt'></i> Kembali Ke Beranda</a>
                        <a href="https://wa.me/6285872079330" target="_blank" style="color: #25d366; font-weight: 600; text-decoration:none;"><i class='bx bxl-whatsapp'></i> Perlu Bantuan? Chat Me</a>
                    </div>
                </div>
            </div>

            <div class="guide-side">
                <h4 style="font-weight: 700; margin-bottom: 30px;">Petunjuk Login</h4>
                <div class="guide-item">
                    <div class="guide-icon"><i class='bx bx-user'></i></div>
                    <div class="guide-text">
                        <h5>Akun Terdaftar</h5>
                        <p>Gunakan username dan password yang diberikan oleh admin sekolah.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <div class="guide-icon"><i class='bx bx-shield-quarter'></i></div>
                    <div class="guide-text">
                        <h5>Keamanan Akun</h5>
                        <p>Jangan berikan password Anda kepada siapapun untuk menjaga keamanan data.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <div class="guide-icon"><i class='bx bx-key'></i></div>
                    <div class="guide-text">
                        <h5>Lupa Password?</h5>
                        <p>Jika lupa, silakan hubungi nomor bantuan yang tertera di bagian bawah form.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                document.getElementById('loading-screen').style.opacity = '0';
                setTimeout(function() {
                    document.getElementById('loading-screen').style.display = 'none';
                }, 500);
            }, 600);
        });
    </script>
</body>
</html>