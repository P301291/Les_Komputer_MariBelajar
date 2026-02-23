
<?php
session_start();

// Set the inactivity time of 15 minutes (900 seconds)
$inactivity_time = 10 * 20;

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
<!DOCTYPE html> 
<?php
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  $Tanggal = "";
  $name = "";
  $code = "";
  
  $queryCondition = "";
  if(!empty($_POST["search"])) {
    foreach($_POST["search"] as $k=>$v){
      if(!empty($v)) {

        $queryCases = array("id","Nama","Jenis_Kelamin");
        if(in_array($k,$queryCases)) {
          if(!empty($queryCondition)) {
            $queryCondition .= " AND ";
          } else {
            $queryCondition .= " WHERE ";
          }
        }
        switch($k) {
          case "id":
            $Tanggal = $v;
            $queryCondition .= "id LIKE '" . $v . "%'";
            break;
          case "Nama":
            $name = $v;
            $queryCondition .= "Nama LIKE '" . $v . "%'";
            break;
          case "Jenis_Kelamin":
            $code = $v;
            $queryCondition .= "Jenis_Kelamin LIKE '" . $v . "%'";
            break;

        }
      }
    }
  }
  $orderby = " ORDER BY id desc"; 
  $sql = "SELECT * FROM toy " . $queryCondition;
  $href = 'Data_Siwa.php';          
    
  $perPage = 12; 
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
    
    <style>
      .dropdown {
        margin:5px;
  position: relative; /* Mengatur posisi relatif pada kontainer */
  display: inline-block;
  float:right;
  
}
th{color:black}

.dropbtn {
  background-color:rgb(6, 28, 151);
  border: #F0F0F0 0px solid;
    padding: 2px 5px;
    color: #FFF;
    cursor: pointer;
    text-decoration: none;}

.dropdown-content {
  display: none; /* Sembunyikan menu secara default */
  position: absolute; /* Posisikan secara absolut */
  background-color: #f9f9f9;
  min-width: 160px;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 2px;
  font-size: 12px;
  padding: 0px 0px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #ddd;
}

.dropdown:hover .dropdown-content {
  display: block; /* Tampilkan menu saat tombol di-hover */
}

      </style>
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script>
  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
 </script>
<script>
function myFunction() {
  document.getElementById("myCheck").click();
}
</script>
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
     <div class="text" style="color:white">Siswa</div>
  <br>


     
    <div id="toys-grid">    
 
      <form name="frmSearch" method="post" action="Data_Siswa.php">
      
      <div class="search-box">
      <div class="dropdown">
  <button class="dropbtn" >Menu Tombol Eksekusi</button>
  <div class="dropdown-content">
 <a href="student-create2.php">Tambah</a>
   <a href="cetak.php">Cetak</a>
  <a href="excel.php">Ekspor Excel</a>
    <a href="import-excel/index6.php">Impor Excel</a>
  </div>
</div>
      <br>
      <p align="left"><input type="text" placeholder="code" name="search[id]" class="demoInputBox" value="<?php echo $Tanggal; ?>"/><input type="text" placeholder="Name" name="search[Nama]" class="demoInputBox" value="<?php echo $name; ?>" /> <input type="reset" class="btnSearch" value="Batal"><input type="submit" name="go" class="btnSearch" value="Cari"><!-- <button onclick="exportTableToCSV('Data.csv')" class="btnSearch2" >Expor Ke CSV File</button><br><br><a id="btnAddAction" href="student-create2.php">Tambah</a><a id="btnAddAction" href="import-excel/index6.php">Import Ke Excel/ CSV File</a><a id="btnAddAction" href="excel.php">Exspor Ke Excel</a>-->
        <!--<a href="cetak.php" id="btnAddAction"target="_blank">Cetak</a>--></p>
        <br>
      </div>
  


  
      <table class="scroll" cellpadding="1" cellspacing="2">
        <thead>
          <tr>
          
  
             <th><strong>Id&#160;</strong></th>
          <th><strong>Nama&#160;</strong></th>
          <th><strong>Jenis Kelamin &#160;</strong></th>          
          <th><strong>Kursus &#160;</strong></th>
          <th><strong>Alamat&#160;</strong></th>
          <th><strong>Tanggal&#160;</strong></th>
          <th><strong>No Whatsapp&#160;</strong></th>
          <th><strong>Aksi&#160;</strong></th>
          
          </tr>
        </thead>
        <tbody>
          <?php
          if(!empty($result)) {
            foreach($result as $k=>$v) {
              if(is_numeric($k)) {
          ?>
          <tr>
      <td>&nbsp;<?php echo $result[$k]["id"]; ?>&#160;</td>
          <td>&nbsp;<?php echo $result[$k]["Nama"]; ?>&#160;</td>
          <td>&nbsp;<?php echo $result[$k]["Jenis_Kelamin"]; ?>&#160;</td>
          <td>&nbsp;<?php echo $result[$k]["Kursus"]; ?>&#160;</td>
          <td>&nbsp;<?php echo $result[$k]["Alamat"]; ?>&#160;</td>
          <td>&nbsp;<?php echo $result[$k]["Date"]; ?>&#160;</td> 
          <td>&nbsp;<?php echo $result[$k]["No_Hp"]; ?>&#160;</td> 
          <td>
          &#160;<a class="btnEditAction" href="edit.php?id=<?php echo $result[$k]["id"]; ?>">Edit</a>  <a class="btnDeleteAction" href="delete.php?action=delete&id=<?php echo $result[$k]["id"]; ?>" onclick="javascript: return confirm('Anda yakin akan hapus data?')">Hapus</a> 

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
          <td colspan="6" align="right"> Previous<?php echo $result["perpage"]; ?>Next &nbsp;
          <?php
// Koneksi database
$koneksi = mysqli_connect("localhost", "root", "", "db_user");

// Query mengambil data
$sql = "SELECT * FROM toy";
$result = mysqli_query($koneksi, $sql);

// Menghitung jumlah data
$jumlah_data = mysqli_num_rows($result);

echo "Jumlah: " . $jumlah_data;
?>&nbsp;<?php
$conn = mysqli_connect("localhost", "root", "", "db_user");

// Hitung laki-laki
$query_l = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Laki-Laki'");
$jumlah_l = mysqli_num_rows($query_l);

// Hitung perempuan
$query_p = mysqli_query($conn, "SELECT id FROM toy WHERE Jenis_Kelamin = 'Perempuan'");
$jumlah_p = mysqli_num_rows($query_p);

echo "(&nbsp;L: " . $jumlah_l;
echo "&nbsp;)";
echo "(&nbsp;P:" . $jumlah_p;
echo "&nbsp;)&nbsp;";
?></td>
          </tr>
        <tbody>
          

      </table>
      </form> 
       
    </div>
    
    </center>
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

