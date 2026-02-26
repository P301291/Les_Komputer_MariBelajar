<?php
session_start(); // Wajib di paling atas

// Pengecekan: Apakah user sudah login?
if (!isset($_SESSION['nama'])) {
    // Jika tidak ada session, lempar kembali ke halaman login
    header("Location: login.php");
    exit;
}

// Ambil data dari session
$user_login = $_SESSION['nama'];
?>

<?php
// 1. Koneksi ke Database
$host = "localhost";
$user = "root"; // sesuaikan
$pass = ""; // sesuaikan
$db   = "db_user"; // sesuaikan

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. Hitung Jumlah Laki-laki dan Perempuan
$queryL = mysqli_query($conn, "SELECT count(*) as total FROM toy WHERE Setatus = 'Diterima'");
$dataL = mysqli_fetch_assoc($queryL);
$totalL = $dataL['total'];

$queryP = mysqli_query($conn, "SELECT count(*) as total FROM toy WHERE Setatus = 'Masih Proses'");
$dataP = mysqli_fetch_assoc($queryP);
$totalP = $dataP['total'];

$totalSemua = $totalL + $totalP;

// Hindari pembagian dengan nol jika data kosong
$persenL = ($totalSemua > 0) ? ($totalL / $totalSemua) * 100 : 0;
$persenP = ($totalSemua > 0) ? ($totalP / $totalSemua) * 100 : 0;
?>
<?php
// Simulasi loading lambat selama 3 detik
// Hapus atau komentari baris ini jika digunakan di produksi ganti lahgi ini (session_start();)
sleep(2);
?>
<?php


// Set the inactivity time of 15 minutes (900 seconds)
$inactivity_time = 15 * 25;

// Check if the last_timestamp is set
// and last_timestamp is greater then 15 minutes or 9000 seconds
// then unset $_SESSION variable & destroy session data
if (isset($_SESSION['last_timestamp']) && (time() - $_SESSION['last_timestamp']) > $inactivity_time) {
    session_unset();
    session_destroy();

    //Redirect user to login page
    header("Location: login.php");
    exit();
  }else{
    // Regenerate new session id and delete old one to prevent session fixation attack
    session_regenerate_id(true);

    // Update the last timestamp
    $_SESSION['last_timestamp'] = time();
  }
?>
<!DOCTYPE html> <!--Sudah pakai HTML 5 Pakai teknologi terbaru-->
<html lang="id">
<?php
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  
  $username = "";
  $password = "";
  
  $queryCondition = "";
  if(!empty($_POST["search"])) {
    foreach($_POST["search"] as $k=>$v){
      if(!empty($v)) {

        $queryCases = array("username","nama");
        if(in_array($k,$queryCases)) {
          if(!empty($queryCondition)) {
            $queryCondition .= " AND ";
          } else {
            $queryCondition .= " WHERE ";
          }
        }
        switch($k) {
          case "username":
            $name = $v;
            $queryCondition .= "username LIKE '" . $v . "%'";
            break;
          case "nama":
            $password = $v;
            $queryCondition .= "nama LIKE '" . $v . "%'";
            break;
        }
      }
    }
  }
  $orderby = " ORDER BY id desc"; 
  $sql = "SELECT * FROM tb_user " . $queryCondition;
  $href = 'Hal_utama.php';          
    
  $perPage = 5; 
  $page = 1;
  if(isset($_POST['page'])){
    $page = $_POST['page'];
  }
  $start = ($page-1)*$perPage;
  if($start < 0) $start = 0;
    
  $query =  $sql . $orderby .  " limit " . $start . "," . $perPage; 
  $result = $db_handle->runQuery($query);
  
  if(!empty($result)) {
    $result["perpage"] = showperpage($sql, $perPage, $href);
  }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>www.Mari Belajar.php </title>
    <link rel="stylesheet" href="css/styles1.css">
    <link rel="stylesheet" href="css/styles_dasboard.css" />
    <!-- Boxicons CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <style>
        /* 1. CSS untuk Overlay Loading */
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff; /* Warna background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999; /* Pastikan paling atas */
            transition: opacity 0.5s ease;
        }

        /* 2. CSS untuk Spinner/Animasi */
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db; /* Warna spinner */
            border-radius: 50%;
            animation: spin 2s linear infinite;
        }

        /* 3. Animasi Putar */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(390deg); }
        }

        /* Konten Utama (Disembunyikan saat loading) */
     
    </style>
    <style>
      * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body {
    background-color: #f0f2f5;
}

.main-wrapper {
    display: flex;
    min-height: 20vh;
   
}

/* Styling Kartu - Kiri */
.info-card {
    width: 70%;
    background-color: #fff;
    padding: 10px;
    border-right: 5px solid green;
            border-left: 5px solid green;
            border-bottom: 2px solid #5ddd21;
            border-top: 2px solid #5ddd21;
            border-radius: 10px; /* Sudut tumpul */
    top: 0;
    height: 79vh;
    transition: all 0.3s ease;
    display: flex;
    word-break: break-word;
    flex-direction: column;
}

.card-header h3 {
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

.card-body {
    text-align: center;
}

.card-img {
    width: 10px;
    height: 40px;
    border-radius: 50%;
    margin-bottom: 15px;
}

button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Styling Konten Utama */
.content2 {
    flex: 1;
    padding: 30px;
}

/* Responsif: Mobile (Layar kecil) */
@media screen and (max-width: 768px) {
    .main-wrapper {
        flex-direction: column;
    }

    .info-card {
        width: 100%;
        height: auto;
        position: relative; /* Tidak sticky lagi di mobile */
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .content {
        padding: 20px;
        
    }
}

      </style>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; }
        
        /* Container Grafik */
        .chart-container {
          
            position: relative;
            width: 225px;
            height: 225px;
            border-radius: 50%;
            /* Warna Laki-laki (biru) dan Perempuan (merah muda) */
            background: conic-gradient(
                #3498db 0% <?php echo $persenL; ?>%, 
                #e74c3c <?php echo $persenL; ?>% 100%
            );
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            word-break: break-word;
        }

        /* Membuat efek donat (tengah bolong) */
        .chart-container::before {
            content: "";
           
            word-break: break-word;
            position: absolute;
            width: 120px;
            height: 120px;
            background-color: white;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Legenda dan Keterangan */
        .legend { margin-top: 20px; text-align: left; }
        .legend-item { display: inline-block; margin: 0 10px; }
        .color-box { width: 15px; height: 15px; display: inline-block; margin-right: 5px; }
        .l-color { background-color: #3498db; }
        .p-color { background-color: #e74c3c; }
        .total-text { margin-top: 10px; font-weight: bold; }
    </style>
     <style>
        .fieldset{background-color: #4CAF50; /* Warna hijau */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px; /* Sudut tumpul */
 
}


/* css progres */
.course-container {
    background-color: white;
    padding: 18px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    width: 100%;
    border-right: 5px solid green;
            border-left: 5px solid green;
            border-bottom: 2px solid #5ddd21;
            border-top: 2px solid #5ddd21;

}

h5 {
    margin-top: 0;
    word-break: break-word; 
    color: #333;
    float:left;
    text-align: left;
}

.stats {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.progress-wrapper {
    background-color:rgb(201, 194, 194);
    border-radius: 20px;
    padding: 3px; /* Jarak antara background dan fill */
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.2);
}

.progress-bar {
    border-radius: 20px;
    overflow: hidden; /* Memastikan isian tidak keluar dari border radius */
}

.progress-fill {
    background: linear-gradient(40deg, #4CAF50, #8BC34A); /* Warna hijau */
    height: 25px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: flex-end; /* Posisi teks persentase di kanan */
    color: white;
    font-size: 12px;
    font-weight: bold;
    padding-right: 10px;
    box-sizing: border-box;
    
    /* Animasi saat loading */
    animation: loadProgress 1.5s ease-in-out;
}

.status-text {
    margin-top: 15px;
    font-size: 13px;
    color: #4CAF50;
    font-weight: bold;
}

/* Animasi progress bar */
@keyframes loadProgress {
    from { width: 0%; }
    to { width: 35%; } /* Sesuaikan dengan width di HTML */
}

      </style>
   </head>
<body class="scroll">
   <div class="sidebar">
     <div class="logo_content">
       <div class="logo">
         <div class="logo_name">Mari Belajar</div>
       </div>
       <i class='bx bx-menu' id="btn"></i>
     </div>
     <ul class="nav_list">
       
       <li>
        <a href="Dashboard.php">
         <i class='bx bx-grid-alt'></i>
         <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
       <li>
         <a href="Data_Siswa.php">
          <i class='bx bx-user'></i>
          <span class="links_name">Data Siswa</span>
         </a>
         <span class="tooltip">Data Siswa</span>
       </li>
      <!-- <li>
        <a href="Data_Guru.php">
        <i class='bx bxs-user-check'></i>
         <span class="links_name">Data Guru</span>
        </a>
        <span class="tooltip">Data Guru</span>
      </li>-->
      
      <li>
        <a href="Ganti_Pas.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Admin</span>
        </a>
        <span class="tooltip">Admin</span>
      </li>
      
      <li>
        <a href="Input_Header.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Set Dashboard</span>
        </a>
        <span class="tooltip">Set Dashboard</span>
      </li>
     <li>
        <a href="Input_Sidebar.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Set Info</span>
        </a>
        <span class="tooltip">Set Info</span>
      </li>
      <!--<li>
        <a href="Input_Notif.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Setting Notif</span>
        </a>
        <span class="tooltip">Setting Notif</span>
      </li>-->
       <li>
        <a href="logout.php">
         <i class='bx bx-log-out' ></i>
         <span class="links_name">Log-out</span>
        </a>
        <span class="tooltip">Log-out</span>
      </li>
     </ul>
     <div class="content">
       <div class="user">
         <div class="user_details">
           <img decoding="async" src="gambar/mb21.png" alt="">
           <div class="name_job">
             <div class="name"><h4><?php echo $user_login; ?></h4></div>
             <div class="job">Admin Mari Belajar</div>
           </div>
         </div>
     
       </div>
     </div>
   </div>
   <div class="home_content">
    
   <div class="text" style="color:white">Dashboard   
</div>  
   <!-- Menampilkan nama akun -->

<div id="loading-screen">
        <div class="spinner"></div>
    </div>

    <!-- Konten Utama -->
    <div id="main-content">
     
    </div>
    <script>
        // 4. JavaScript untuk menyembunyikan loading setelah konten dimuat
        window.addEventListener('load', function() {
            var loadingScreen = document.getElementById('loading-screen');
            var mainContent = document.getElementById('main-content');
            
            // Beri sedikit delay agar transisi mulus
            setTimeout(function() {
                loadingScreen.style.opacity = '0';
                setTimeout(function() {
                    loadingScreen.style.display = 'none';
                    mainContent.style.display = 'block';
                }, 500); // Waktu transisi opacity
            }, 500);
        });
    </script>

  <!-- <section class="main">
      <div class="main-top">
     </div>
      <section class="main-course">
        <div class="course-box">
          <ul> 
          </ul>
          <div class="course">
            <div class="box">
              <h3>Kelas 1</h3>
              <br>
              <i class="fab fa-windows " padding="10" style='font-size:360%' height="auto"></i>
              <p>Dasar-dasar komputer</p>
              <p>Microsoft Office</p>
              <p>Internet</p>
             
            </div>
            <div class="box">
              <h3>Kelas 2</h3>
              <br>
              <i class="fas fa-swatchbook" adding="10" style='font-size:360%'height="auto"></i>
              <p>Desain Grafis</p>
              <p>Editing Video</p>
              <p>UI/UX Design</p>
              
              
            </div>
            <div class="box">
              <h3>Kelas 3</h3>
              <br>
              <i class="fas fa-laptop-house" adding="10" style='font-size:360%'height="auto"></i>
              <p>Web Developer</p>
              <p>Desktop Developer</p>
              <p>Diagram UML</p>
  
              
            </div>
          </div>
        </div>-->
        
      </section>
    </section>
    <br>
   <div class="row">

   <div class="container">
 
    
    <div class="card-grid">
        <!-- Card 1 -->
        <div class="card blue">
            <div class="card-icon"><i class="fas fa-users"></i></div>
            <div class="card-content">
                <h3>Total Pendaftar</h3>
                <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$ukuran = "100%"; // Ukuran sisi
$ukuran2 = "120px"; // Ukuran sisi
$warna = "blue";   // Warna persegi
$warna_text="black";
$mrgn="1px";
$pdg="right";
$brd="20px 10px 20px 0px";
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);
echo "<div style='width: $ukuran2; height: $ukuran; color: $warna_text; margin:$mrgn;border-radius:$brd'> <h1> $jumlah_data</h1></div>" ;

?>

                <p class="desc">Sukses Terdaftar</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card green">
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <div class="card-content">
                <h3>Laki-Laki</h3>
                <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);


$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Laki-Laki'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Perempuan'");
$jumlah_p = mysqli_num_rows($query_p);

echo "<h1> " . $jumlah_l, "</h1>";


?>

                <p class="desc">Sukses</p>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card orange">
            <div class="card-icon"><i class="fas fa-user"></i></div>
            <div class="card-content">
                <h3>Perempuan</h3>
                <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);


$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Laki-Laki'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Perempuan'");
$jumlah_p = mysqli_num_rows($query_p);

echo "<h1>" . $jumlah_p,"</h1>";
?>

                <p class="desc">Sukses</p>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="card red">
            <div class="card-icon"><i class="fas fa-user-check"></i></div>
            <div class="card-content">
                <h3>Diterima</h3>
                <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);


$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki


// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Setatus = 'Diterima'");
$jumlah_D = mysqli_num_rows($query_p);

echo "<h1>" . $jumlah_D,"</h1>";
?>
                <p class="desc">Sukses</p>
            </div>
        </div>
    </div>
</div>
<br>
    <div class="main-wrapper">
        <!-- Kartu Info Kiri -->
        <div class="info-card" id="myCard">
            <div class="card-header">
                <h3>Informasi</h3>
            </div>
            <div class="card-body">   
            <div class="course-container">
        <h5>1. Progress Kelas 1</h5>
        <br>
        <p class="stats"></p>
        
        <div class="progress-wrapper">
            <div class="progress-bar">
                <!-- Ubah width di style inline ini untuk menyesuaikan persentase -->
                <div class="progress-fill" style="width: 75%;">
                    <span class="progress-percentage"><?php
$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 1 (8 x P)'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 1 (12 x P)'");
$jumlah_p = mysqli_num_rows($query_p);

echo "&nbsp;(8 X P: " . $jumlah_l;
echo "&nbsp;)";
echo "&nbsp;(12 x P: " . $jumlah_p;
echo "&nbsp;)&nbsp;";


?></span>
                </div>
                
            </div>
        </div>
    </div>
      <br>                        
    <div class="course-container">
        <h5>2. Progress Kelas 2</h5>
        <br>
        <p class="stats"></p>
        
        <div class="progress-wrapper">
            <div class="progress-bar">
                <!-- Ubah width di style inline ini untuk menyesuaikan persentase -->
                <div class="progress-fill" style="width: 75%;">
                    <span class="progress-percentage"><?php
$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 2 (8 x P)'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 2 (12 x P)'");
$jumlah_p = mysqli_num_rows($query_p);

echo "&nbsp;(8 X P: " . $jumlah_l;
echo "&nbsp;)";
echo "&nbsp;(12 x P:" . $jumlah_p;
echo "&nbsp;)&nbsp;";


?></span>
                </div>
                
            </div>
        </div>
    </div>
    <br> 
    <div class="course-container">
        <h5>3.Progress Kelas 3</h5>
        <br>
        <p class="stats"></p>
        
        <div class="progress-wrapper">
            <div class="progress-bar">
                <!-- Ubah width di style inline ini untuk menyesuaikan persentase -->
                <div class="progress-fill" style="width: 75%;">
                    <span class="progress-percentage"><?php
$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 3 (8 x P)'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Kursus = 'Komputer Kls 3 (12 x P)'");
$jumlah_p = mysqli_num_rows($query_p);

echo "&nbsp;(8 X P: " . $jumlah_l;
echo "&nbsp;)";
echo "&nbsp;(12 x P:" . $jumlah_p;
echo "&nbsp;)&nbsp;";


?></span>
                </div>
                
            </div>
        </div>
    </div>
  <br>
            </div>
        </div>
        &#160;
        <!-- Konten Utama -->
        <div class="info-card" id="myCard">
        <div class="content2">
          <center>
       <dd> <h4>Status Peserta</h4></dd>
    <br>
    <div class="chart-container"></div>

    <div class="legend">
        <div class="legend-item">
         <center>   <span class="color-box l-color"></span> Diterima: <?php echo $totalL; ?>
        </div>
        <div class="legend-item">
            <span class="color-box p-color"></span> Masih Proses: <?php echo $totalP; ?>
        </div>
        <div class="total-text">Total: <?php echo $totalSemua; ?></div>
      </center>
    </div>
    </div>
      </div>
      </div>
      <br>


    <div class="Bagian_Bawah2">
    <br>
                      
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                              <br>
                             
                     
                            
                              <br>
                            <hr width="97%">
                            <div class="container">
<br>
 <br>
                          
                            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#"style="color:white">&#160;Mari Belajar</a>, Website Pendaftaran Online Les Komputer.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        &#160;Designed By <a class="border-bottom" href="#"style="color:white">Candra Argadinata, S.Kom.</a><br>
                        Distributed By <a class="border-bottom" href="#"style="color:white">Mari Belajar</a>
                    </div>
                   
        </div>
</div>
          </div>


<script src="js/js1.js"></script>
</body>
<style>
.Bagian_Bawah2{  
  padding:5px;
  width:100%;
  height:600px;
  background-color:rgb(7, 95, 7);
  font-size: 12px;
 
   border-bottom: 2px solid #46f340;
  box-shadow: 2px 2px 9px hwb(106 6% 15%);
  border-top: 2px solid #70da2a;
  font-style: italic;
  color:white;


     
}

  
  </style>
  
</html>

