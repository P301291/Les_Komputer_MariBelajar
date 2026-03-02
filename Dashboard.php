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
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/styles1.css">

    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --info: #3498db;
            --warning: #f39c12;
            --danger: #e74c3c;
            --dark: #1e293b;
            --light-bg: #f8fafc;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            color: #334155;
        }

        /* Loading Screen */
        #loading-screen {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: #fff; display: flex; justify-content: center; align-items: center;
            z-index: 9999; transition: 0.5s;
        }
        .spinner {
            width: 45px; height: 45px;
            border: 4px solid #f3f3f3; border-top: 4px solid var(--primary);
            border-radius: 50%; animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        .home_content {
            padding: 25px 35px;
            transition: var(--transition);
            min-height: 100vh;
        }

        /* Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--dark) 0%, #334155 100%);
            padding: 35px; border-radius: 20px; color: white; margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        /* Card Stats */
        .card-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px; margin-bottom: 30px;
        }
        .card {
            background: #fff; padding: 22px; border-radius: 18px;
            display: flex; align-items: center; gap: 18px;
            box-shadow: var(--card-shadow); transition: var(--transition);
        }
        .card:hover { transform: translateY(-5px); }
        .card-icon {
            width: 55px; height: 55px; border-radius: 14px;
            display: flex; justify-content: center; align-items: center; font-size: 22px;
        }
        .blue .card-icon { background: #e0e7ff; color: var(--primary); }
        .green .card-icon { background: #dcfce7; color: var(--success); }
        .orange .card-icon { background: #fef3c7; color: var(--warning); }
        .red .card-icon { background: #fee2e2; color: var(--danger); }

        /* Info Grid */
        .info-grid { display: grid; grid-template-columns: 1.8fr 1fr; gap: 25px; }
        .info-box {
            background: white; padding: 28px; border-radius: 20px;
            box-shadow: var(--card-shadow);
        }

        /* Progress Bar */
        .progress-item { margin-bottom: 25px; }
        .progress-label { display: flex; justify-content: space-between; margin-bottom: 10px; font-weight: 600; font-size: 14px; }
        .progress-container { background: #f1f5f9; height: 10px; border-radius: 10px; }
        .progress-fill {
            height: 100%; background: linear-gradient(90deg, var(--primary), #4cc9f0);
            border-radius: 10px; transition: 1.2s ease-in-out;
        }

        /* Chart */
        .donut-chart {
            width: 190px; height: 190px; border-radius: 50%; margin: 0 auto;
            background: conic-gradient(var(--info) 0% <?php echo $persenDiterima; ?>%, var(--danger) <?php echo $persenDiterima; ?>% 100%);
            display: flex; justify-content: center; align-items: center; position: relative;
        }
        .donut-chart::after { content: ""; width: 145px; height: 145px; background: white; border-radius: 50%; position: absolute; }
        .chart-center-text { position: absolute; z-index: 5; text-align: center; }
        
        .legend { margin-top: 25px; }
        .legend-item { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; font-size: 14px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; }

        /* FOOTER SECTION (Sesuai permintaan: tidak dihilangkan) */
        .footer {
            margin-top: 50px; background: var(--dark); color: white;
            padding: 45px 20px; border-radius: 24px 24px 0 0; text-align: center;
        }
        .footer b { color: #4cc9f0; }
        .footer-logo {
            margin-bottom: 20px; display: inline-block;
        }
        .footer-logo img {
            border-radius: 50%; background: #fff; padding: 6px;
            box-shadow: 0 0 15px rgba(255,255,255,0.2);
        }

        @media (max-width: 992px) { .info-grid { grid-template-columns: 1fr; } }
        .kontainer-scroll {
   
   overflow-y: scroll; /* Scroll vertikal */

}
    </style>
</head>
<body class="kontainer-scroll">

    <div id="loading-screen"><div class="spinner"></div></div>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-book-open' style="font-size: 26px; color: #4cc9f0;"></i>
                <div class="logo_name" style="margin-left: 10px;">Mari Belajar</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li><a href="Dashboard.php"><i class='bx bxs-grid-alt'></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="Data_Siswa.php"><i class='bx bxs-user-detail'></i><span class="links_name">Data Siswa</span></a></li>
            <li><a href="Ganti_Pas.php"><i class='bx bxs-cog'></i><span class="links_name">Admin</span></a></li>
            <li><a href="logout.php"><i class='bx bxs-log-out' style="color: #ff5e5e;"></i><span class="links_name" style="color: #ff5e5e;">Keluar</span></a></li>
        </ul>
    </div>

    <div class="home_content">
        <div class="welcome-banner">
            <div style="display: flex; align-items: center; gap: 20px;">
                <img src="gambar/mb21.png" width="85" style="background: white; border-radius: 18px; padding: 8px;">
                <div>
                    <h1 style="margin:0; font-size: 28px;">Halo, <?php echo $user_login; ?>!</h1>
                    <p style="margin:5px 0 0 0; opacity: 0.85; font-size: 15px;">Selamat datang kembali di panel administrasi Mari Belajar.</p>
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
                <div class="card-icon"><i class="fas fa-check-circle"></i></div>
                <div class="card-content">
                    <h3>Diterima</h3>
                    <h1><?php echo $totalDiterima; ?></h1>
                </div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3 style="margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-chart-bar" style="color: var(--primary);"></i> Progress Minat Kelas
                </h3>
                
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
                        <span><?php echo $label; ?> <small style="font-weight: 400; color: #64748b;">(8x: <?php echo $c1; ?>, 12x: <?php echo $c2; ?>)</small></span>
                        <span><?php echo round($persen, 1); ?>%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-fill" style="width: <?php echo $persen; ?>%;"></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="info-box" style="text-align: center;">
                <h3 style="margin-bottom: 20px;">Status Peserta</h3>
                <div class="donut-chart">
                    <div class="chart-center-text">
                        <b style="font-size: 28px;"><?php echo $totalSemua; ?></b>
                        <br><small style="color: #64748b;">Total</small>
                    </div>
                </div>
                <div class="legend" style="text-align: left; display: inline-block;">
                    <div class="legend-item">
                        <span class="dot" style="background: var(--info);"></span>
                        <span>Diterima: <b><?php echo $totalDiterima; ?></b></span>
                    </div>
                    <div class="legend-item">
                        <span class="dot" style="background: var(--danger);"></span>
                        <span>Masih Proses: <b><?php echo $totalProses; ?></b></span>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-logo">
                <img src="gambar/mb21.png" width="65">
            </div>
            <p style="font-size: 16px; margin-bottom: 10px;">&copy; 2025 <b>Mari Belajar</b> - Website Pendaftaran Online Les Komputer</p>
            <p style="opacity: 0.7; font-size: 13px; font-weight: 300; letter-spacing: 0.5px;">Designed by Candra Argadinata, S.Kom.</p>
        </footer>
    </div>

    <script>
        window.addEventListener('load', () => {
            const loader = document.getElementById('loading-screen');
            setTimeout(() => {
                loader.style.opacity = '0';
                setTimeout(() => loader.style.display = 'none', 500);
            }, 500);
        });

        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = function() {
            sidebar.classList.toggle("active");
        }
    </script>
</body>
</html>