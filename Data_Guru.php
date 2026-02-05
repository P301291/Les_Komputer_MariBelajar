
<!DOCTYPE html> 
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
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
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
       <li>
        <a href="Data_Guru.php">
        <i class='bx bxs-user-check'></i>
         <span class="links_name">Data Guru</span>
        </a>
        <span class="tooltip">Data Guru</span>
      </li>
      
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
           <img decoding="async" src="gambar/candra.png" alt="">
           <div class="name_job">
             <div class="name">Candra Argadinata</div>
             <div class="job">IT ( Information Technology)</div>
           </div>
         </div>
     
       </div>
     </div>
   </div>
   <div class="home_content">
     <div class="text">Data Guru</div>



</div>
<script src="js/js1.js"></script>
</body>
</html>

