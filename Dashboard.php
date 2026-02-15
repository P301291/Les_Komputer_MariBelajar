
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

<?php

session_start();

if($_SESSION['level']!=1){
  header("location:login.php");
}
include('function.php');

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
             <div class="name">Mari Belajar</div>
             <div class="job">Bimbingan Belajar Komputer</div>
           </div>
         </div>
     
       </div>
     </div>
   </div>
   <div class="home_content">
    
   <div class="text" style="color:white">Dashboard   <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$ukuran = "100%"; // Ukuran sisi
$ukuran2 = "120px"; // Ukuran sisi
$warna = "blue";   // Warna persegi
$warna_text="white";
$mrgn="1px";
$pdg="right";
$brd="20px 10px 20px 0px";
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);
echo "<div style='width: $ukuran2; height: $ukuran; background-color: $warna; color: $warna_text; margin:$mrgn;border-radius:$brd;float:$pdg'> <h4> 👨‍💼👩‍💼 $jumlah_data</h4></div>" ;

?>
</div>  
   


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



            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" width='100%'cellspacing="0">
                        <thead>
                            
                              
                                <dd width='100%' height='12px'>
                              
                           
                        </thead>

                        <tbody>
                        	
                        <?php
                            // include database
                            include 'database.php';
                            // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                            $sql="select * from tb_header order by id_gambar desc";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        
                            	
                            <img src="gambar/<?php echo $data['gambar'];?>" class="rounded" width='100%'alt="Cinque Terre">    
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>

                        </tbody>
                    </table>
                            </form>
              
                </div>
     
                              
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
                            <hr width="97%">
                            <div class="container">
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

