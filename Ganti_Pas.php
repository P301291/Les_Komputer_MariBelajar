
<!DOCTYPE html> <!--Sudah pakai HTML 5-->
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
    
  $perPage = 3; 
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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
       <!--<li>
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
        <span class="tooltip">Admin </span>
      </li>
      
      <li>
        <a href="Input_Header.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Set Dashboard</span>
        </a>
        <span class="tooltip">Set Dashboard</span>
      </li>
     <!-- <li>
        <a href="Input_Header.php">
         <i class='bx bx-cog'></i>
         <span class="links_name">Setting Header</span>
        </a>
        <span class="tooltip">Setting Header</span>
      </li>-->
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
             <div class="name"> <?php echo $_SESSION['nama']; ?></div>
             <div class="job">Admin Mari Belajar</div>
           </div>
         </div>
     
       </div>
     </div>
   </div>
   <div class="home_content">
     <div class="text" style="color:white">Admin</div>
<center>
<?php
   $host = "localhost"; // Menyiapkan variabel 'host' untuk mendefinisikan nama server
   $user = "root"; // Menyiapkan variabel 'user' untuk mendefinisikan nama user database MySQL
   $password = ""; // Menyiapkan variabel 'password' untuk mendefinisikan password database MySQL
   $database = "db_user"; // Menyiapkan variabel 'database' untuk mendefinisikan nama database MySQL
  
   $connect = mysql_connect($host,$user,$password); // Melakukan koneksi
   $selectdb = mysql_select_db($database,$connect); // Memilih database yang sudah didefinisikan dengan perintah 'mysql_select_db'
 
   if($connect){
      echo "";
   }else{
      echo "Koneksi host database gagal.<br/>";
   }
 
   if($selectdb){
      echo "";
   }else{
      echo "Koneksi database gagal.";
   }
?>

<br>
<br>

    <div id="toys-grid">  

      <form name="frmSearch" method="post" action="Ganti_Pas.php">
      <div class="search-box">
      <p align="left"><input type="text" placeholder="Username" name="search[username]" class="demoInputBox" value="<?php echo $username; ?>" /><input type="reset" class="btnSearch" value="Reset"><input type="submit" name="go" class="btnSearch" value="Search"> </p>

      </div>
  
      <table class="scroll" cellpadding="4" cellspacing="1">
        <thead>
          <tr>  
          <th><strong>&#160 Username &#160</strong></th>
          <th><strong>&#160 Nama &#160</strong></th>          
          <th><strong>&#160 level &#160</strong></th>
          <th><strong>&#160 Action &#160</strong></th>
          
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($result)) {
            foreach($result as $k=>$v) {
              if(is_numeric($k)) {
          ?>
          <tr>
          <td>&nbsp;<?php echo $result[$k]["username"]; ?>&#160</td>
          <td>&nbsp;<?php echo $result[$k]["nama"]; ?>&#160</td>
          <td>&nbsp;<?php echo $result[$k]["level"]; ?>&#160</td>
          <td>
          <a class="btnDeleteAction" href="delete1.php?action=delete&id=<?php echo $result[$k]["id"]; ?>" onclick="javascript: return confirm('Anda yakin akan hapus data?')">Hapus</a> <a href='update.php'class="btnDeleteAction2">Ubah</a>&nbsp;<a href='index3.php'class="btnDeleteAction3">Tambah</a> 
                    </td>
          </tr>
          <?php
              }
             }
                    }
          if(isset($result["perpage"])) {
          ?>
         
          <?php } ?>
          <tr>
          <td colspan="6" align="right"> Previous&nbsp;<?php echo $result["perpage"]; ?>Next &nbsp; <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$sql = "SELECT * FROM tb_user";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);

echo "Admin: " . $jumlah_data;
?>&nbsp;</td></td>
          </tr>
        <tbody>
      </table>
      </form> 
           
    </div>
    </center>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>






<div class="Bagian_Bawah">
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
                        &copy; <a class="border-bottom" href="#"style="color:white">Mari Belajar</a>, Website Pendaftaran Online Les Komputer.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="#"style="color:white">Candra Argadinata, S.Kom.</a><br>
                        Distributed By <a class="border-bottom" href="#"style="color:white">Mari Belajar</a>
                    </div>
                   
        </div>
</div>
          </div>
    </div>  



<script src="js/js1.js"></script>
</body>
</html>

