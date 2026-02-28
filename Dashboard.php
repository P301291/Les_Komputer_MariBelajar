<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}
$user_login = $_SESSION['nama'];

// Koneksi & Statistik
$host = "localhost"; $user = "root"; $pass = ""; $db = "db_user";
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) { die("Koneksi gagal: " . mysqli_connect_error()); }

// Statistik Status
$totalDiterima = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM toy WHERE Setatus = 'Diterima'"))['total'];
$totalProses = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as total FROM toy WHERE Setatus = 'Masih Proses'"))['total'];
$totalSemua = $totalDiterima + $totalProses;
$persenDiterima = ($totalSemua > 0) ? ($totalDiterima / $totalSemua) * 100 : 0;

// Statistik Gender
$jumlah_l = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Laki-Laki'"));
$jumlah_p = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Perempuan'"));
$totalPendaftar = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM toy"));

// Fungsi Progress Kelas
function getCountKursus($conn, $nama_kursus) {
    return mysqli_num_rows(mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = '$nama_kursus'"));
}

// Session Timeout
$inactivity_time = 15 * 60;
if (isset($_SESSION['last_timestamp']) && (time() - $_SESSION['last_timestamp']) > $inactivity_time) {
    session_unset(); session_destroy(); header("Location: login.php"); exit();
}
$_SESSION['last_timestamp'] = time();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Mari Belajar</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="css/styles1.css">

    <style>
        :root {
            --primary: #2ecc71;
            --secondary: #27ae60;
            --dark: #11101d;
            --light: #f4f7fe;
            --blue: #3498db;
            --red: #e74c3c;
            --orange: #f39c12;
        }

        /* FITUR SCROLLBAR MODERN */
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
            border: 2px solid #f1f1f1;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--blue);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            margin: 0;
            overflow-x: hidden;
        }

        /* Loading Screen */
        #loading-screen {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: #fff; display: flex; justify-content: center; align-items: center;
            z-index: 9999; transition: 0.5s;
        }
        .spinner {
            width: 50px; height: 50px;
            border: 5px solid #f3f3f3; border-top: 5px solid var(--blue);
            border-radius: 50%; animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        /* Dashboard Layout */
        .home_content {
            padding: 20px 30px;
            transition: all 0.5s ease;
            min-height: 100vh;
            overflow-y: auto;
        }

        .welcome-banner {
            background: linear-gradient(45deg, var(--dark), var(--secondary));
            padding: 30px; border-radius: 15px; color: white; margin-bottom: 30px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* Stats Cards */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px; margin-bottom: 30px;
        }
        .card {
            background: #fff; padding: 20px; border-radius: 15px;
            display: flex; align-items: center; gap: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s; border-bottom: 4px solid transparent;
        }
        .card:hover { transform: translateY(-5px); }
        .card.blue { border-color: var(--blue); }
        .card.green { border-color: var(--primary); }
        .card.orange { border-color: var(--orange); }
        .card.red { border-color: var(--red); }
        
        .card-icon {
            width: 60px; height: 60px; border-radius: 12px;
            display: flex; justify-content: center; align-items: center; font-size: 24px;
        }
        .blue .card-icon { background: rgba(52, 152, 219, 0.1); color: var(--blue); }
        .green .card-icon { background: rgba(46, 204, 113, 0.1); color: var(--primary); }
        .orange .card-icon { background: rgba(243, 156, 18, 0.1); color: var(--orange); }
        .red .card-icon { background: rgba(231, 76, 60, 0.1); color: var(--red); }

        .card-content h3 { margin: 0; font-size: 14px; color: #7f8c8d; }
        .card-content h1 { margin: 5px 0; font-size: 28px; color: var(--dark); }

        /* Main Info Sections */
        .info-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .info-box {
            background: white; padding: 25px; border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            max-height: 600px; /* Batas tinggi box sebelum scroll internal muncul */
            overflow-y: auto;
        }

        /* Progress Bar Modern */
        .progress-item { margin-bottom: 25px; }
        .progress-label { display: flex; justify-content: space-between; margin-bottom: 10px; font-weight: 500; }
        .progress-container {
            background: #eee; height: 12px; border-radius: 10px; overflow: hidden;
        }
        .progress-fill {
            height: 100%; background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 10px; transition: 1s ease-in-out;
        }

        /* Donut Chart Modern */
        .chart-wrapper {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }
        .donut-chart {
            width: 200px; height: 200px; border-radius: 50%;
            background: conic-gradient(
                var(--blue) 0% <?php echo $persenDiterima; ?>%, 
                var(--red) <?php echo $persenDiterima; ?>% 100%
            );
            display: flex; justify-content: center; align-items: center;
            position: relative; box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .donut-chart::after {
            content: ""; width: 140px; height: 140px; background: white;
            border-radius: 50%; position: absolute;
        }
        .chart-center-text {
            position: absolute; z-index: 5; text-align: center;
        }
        .chart-center-text b { font-size: 24px; display: block; }

        .legend { margin-top: 20px; width: 100%; }
        .legend-item { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; font-size: 14px; }
        .dot { width: 12px; height: 12px; border-radius: 3px; }

        /* Footer */
        .footer {
            margin-top: 50px; background: var(--dark); color: white;
            padding: 40px; border-radius: 20px 20px 0 0; text-align: center;
        }

        @media (max-width: 992px) {
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div id="loading-screen"><div class="spinner"></div></div>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxl-codepen'></i>
                <div class="logo_name">Mari Belajar</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li><a href="Dashboard.php"><i class='bx bx-grid-alt'></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="Data_Siswa.php"><i class='bx bx-user'></i><span class="links_name">Data Siswa</span></a></li>
            <li><a href="Ganti_Pas.php"><i class='bx bx-cog'></i><span class="links_name">Admin</span></a></li>
            <li><a href="logout.php"><i class='bx bx-log-out'></i><span class="links_name">Keluar</span></a></li>
        </ul>
    </div>

    <div class="home_content">
        <div class="welcome-banner">
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="gambar/mb21.png" width="80" style="background: white; border-radius: 50%; padding: 5px;">
                <div>
                    <h1 style="margin:0;">Halo, <?php echo $user_login; ?>!</h1>
                    <p style="margin:5px 0 0 0; opacity: 0.8;">Selamat datang kembali di panel administrasi Mari Belajar.</p>
                </div>
            </div>
        </div>

        <div class="card-grid">
            <div class="card blue">
                <div class="card-icon"><i class="fas fa-users"></i></div>
                <div class="card-content">
                    <h3>Total Pendaftar</h3>
                    <h1><?php echo $totalPendaftar; ?></h1>
                </div>
            </div>
            <div class="card green">
                <div class="card-icon"><i class="fas fa-mars"></i></div>
                <div class="card-content">
                    <h3>Laki-Laki</h3>
                    <h1><?php echo $jumlah_l; ?></h1>
                </div>
            </div>
            <div class="card orange">
                <div class="card-icon"><i class="fas fa-venus"></i></div>
                <div class="card-content">
                    <h3>Perempuan</h3>
                    <h1><?php echo $jumlah_p; ?></h1>
                </div>
            </div>
            <div class="card red">
                <div class="card-icon"><i class="fas fa-user-check"></i></div>
                <div class="card-content">
                    <h3>Diterima</h3>
                    <h1><?php echo $totalDiterima; ?></h1>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3 style="margin-bottom: 25px;"><i class="fas fa-tasks" style="color: var(--primary);"></i> Progress Minat Kelas</h3>
                
                <?php
                $kursus_list = [
                    "Kelas 1" => ["Komputer Kls 1 (8 x P)", "Komputer Kls 1 (12 x P)"],
                    "Kelas 2" => ["Komputer Kls 2 (8 x P)", "Komputer Kls 2 (12 x P)"],
                    "Kelas 3" => ["Komputer Kls 3 (8 x P)", "Komputer Kls 3 (12 x P)"]
                ];

                foreach($kursus_list as $label => $krs) :
                    $c1 = getCountKursus($conn, $krs[0]);
                    $c2 = getCountKursus($conn, $krs[1]);
                    $total_k = $c1 + $c2;
                    $persen = ($totalPendaftar > 0) ? ($total_k / $totalPendaftar) * 100 : 0;
                ?>
                <div class="progress-item">
                    <div class="progress-label">
                        <span><?php echo $label; ?> (8xP: <?php echo $c1; ?>, 12xP: <?php echo $c2; ?>)</span>
                        <span><?php echo round($persen, 1); ?>%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-fill" style="width: <?php echo $persen; ?>%;"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="info-box chart-wrapper">
                <h3 style="margin-bottom: 20px;">Status Peserta</h3>
                <div class="donut-chart">
                    <div class="chart-center-text">
                        <b><?php echo $totalSemua; ?></b>
                        <small>Total</small>
                    </div>
                </div>
                <div class="legend">
                    <div class="legend-item">
                        <span class="dot" style="background: var(--blue);"></span>
                        <span>Diterima: <b><?php echo $totalDiterima; ?></b></span>
                    </div>
                    <div class="legend-item">
                        <span class="dot" style="background: var(--red);"></span>
                        <span>Masih Proses: <b><?php echo $totalProses; ?></b></span>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div style="margin-bottom: 20px;">
                <img src="gambar/mb21.png" width="60" style="border-radius: 50%; background: #fff; padding: 5px;">
            </div>
            <p>&copy; 2026 <b>Mari Belajar</b> - Website Pendaftaran Online Les Komputer</p>
            <p style="opacity: 0.6; font-size: 13px;">Designed by Candra Argadinata, S.Kom.</p>
        </footer>
    </div>

    <button onclick="window.scrollTo(0, 0)" style="position: fixed; bottom: 20px; right: 20px; background: var(--blue); color: white; border: none; border-radius: 50%; width: 45px; height: 45px; cursor: pointer; z-index: 1000; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: flex; justify-content: center; align-items: center;">
        <i class='bx bx-up-arrow-alt' style="font-size: 24px;"></i>
    </button>

    <script>
        // Loading Screen Handler
        window.addEventListener('load', () => {
            const loader = document.getElementById('loading-screen');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.style.display = 'none', 500);
            }, 500);
        });

        // Sidebar Toggle
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>