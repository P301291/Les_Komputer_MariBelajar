<?php
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  
  $username = "";
  $queryCondition = "";

  // 1. Logika Pencarian
  if(!empty($_POST["search"])) {
    foreach($_POST["search"] as $k=>$v){
      if(!empty($v)) {
        if(!empty($queryCondition)) { $queryCondition .= " AND "; } else { $queryCondition .= " WHERE "; }
        if($k == "username") {
            $username = $v;
            $queryCondition .= "username LIKE '" . $v . "%'";
        }
      }
    }
  }

  $orderby = " ORDER BY id DESC"; 
  $base_sql = "SELECT * FROM tb_user " . $queryCondition;
  $href = 'Ganti_Pas.php';          
    
  // 2. Logika Fitur Per Halaman vs All Data
  $show_all = isset($_GET['view']) && $_GET['view'] == 'all';
  $perPage = 3; 
  $page = 1;

  if ($show_all) {
      $query = $base_sql . $orderby;
  } else {
      if(isset($_POST['page'])){ $page = $_POST['page']; }
      $start = ($page - 1) * $perPage;
      if($start < 0) $start = 0;
      $query = $base_sql . $orderby . " LIMIT " . $start . "," . $perPage; 
  }

  $result = $db_handle->runQuery($query);
  $total_records = $db_handle->numRows($base_sql);
  
  $pagination_html = "";
  if (!$show_all) {
      $pagination_html = showperpage($base_sql, $perPage, $href);
  }

  session_start();
  if($_SESSION['level'] != 1){
    header("location:login.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Admin | Mari Belajar</title>
    <link rel="stylesheet" href="css/styles1.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #2ecc71;
            --dark: #11101d;
            --light: #f4f7fe;
            --danger: #e74c3c;
            --info: #3498db;
            --warning: #f1c40f;
            --grey: #6c757d;
        }
        body { font-family: 'Poppins', sans-serif; background-color:rgb(9, 88, 20); color: #333; margin: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--secondary:rgb(5, 136, 60);); margin: 0; }
        .admin-container { padding: 20px 30px; }
        
        .page-header {
            background: linear-gradient(135deg, var(--dark) 0%,rgb(9, 114, 5) 100%);
            padding: 25px; border-radius: 15px; color: white; margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center;
        }

        .main-card {
            background: #fff; border-radius: 15px; padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 30px;
        }

        .toolbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px; flex-wrap: wrap; gap: 15px;
        }

        .btn-modern {
            padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer;
            font-weight: 600; text-decoration: none; display: inline-flex; 
            align-items: center; gap: 8px; transition: 0.3s; font-size: 14px;
        }
/* FITUR SCROLL & STICKY HEADER */
.table-scroll-container {
            max-height: 550px; /* Ketinggian maksimal sebelum scroll */
            overflow: auto;
            border: 1px solid #eee;
            border-radius: 12px;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-info { background: var(--info); color: white; }
        .btn-warning { background: var(--warning); color: #333; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-outline { background: #fff; color: #555; border: 1px solid #ddd; }

        .action-btns { display: flex; gap: 5px; justify-content: center; }
        .btn-action { width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s; }
        .btn-action:hover { transform: translateY(-2px); filter: brightness(1.1); }

        .input-modern { padding: 10px 15px; border: 1px solid #ddd; border-radius: 8px; outline: none; }

        .table-wrapper { border: 1px solid #eee; border-radius: 12px; overflow: hidden; }
        .modern-table { width: 100%; border-collapse: collapse; background: white; }
        .modern-table thead th { background:rgb(248, 250, 248); padding: 15px; text-align: left; font-size: 12px; color: #777; border-bottom: 2px solid #eee; }
        .modern-table td { padding: 15px; border-bottom: 1px solid #f1f1f1; font-size: 14px; }
        
        .level-badge { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; background: #e8f5e9; color: var(--primary); }

        .footer-tools { display: flex; justify-content: space-between; align-items: center; margin-top: 20px; }
    </style>
</head>
<body class="table-scroll-container">

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo"><div class="logo_name">Mari Belajar</div></div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li><a href="Dashboard.php"><i class='bx bx-grid-alt'></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="Data_Siswa.php"><i class='bx bx-user'></i><span class="links_name">Data Siswa</span></a></li>
            <li><a href="Ganti_Pas.php"><i class='bx bx-cog'></i><span class="links_name">Admin</span></a></li>
            <li><a href="Input_Sidebar.php"><i class='bx bx-cog'></i><span class="links_name">Input Sidebar</span></a></li>
            <li><a href="Input_Header.php"><i class='bx bx-cog'></i><span class="links_name">Input_Header</span></a></li>
            <li><a href="logout.php"><i class='bx bx-log-out'></i><span class="links_name">Keluar</span></a></li>
        </ul>
    </div>

    <div class="home_content">
        <div class="admin-container">
            <div class="page-header">
                <div>
                    <h2 style="margin:0;"><i class='bx bx-group'></i> Manajemen Akun</h2>
                    <p style="margin:5px 0 0 0; opacity: 0.8;">Kelola Password dan Hak Akses Administrator</p>
                </div>
               <a href="index3.php" class="btn-modern btn-primary"><i class='bx bx-user-plus'></i> Tambah Baru</a>
               <!-- <a href="update.php" class="btn-modern btn-primary"><i class='bx bx-user-plus'></i> Tambah Baru</a>-->
            </div>

            <div class="main-card">
                <form method="post" action="Ganti_Pas.php">
                    <div class="toolbar">
                        <div style="display: flex; gap: 10px;">
                            <input type="text" placeholder="Cari username..." name="search[username]" class="input-modern" value="<?php echo $username; ?>">
                            <button type="submit" class="btn-modern btn-info"><i class='bx bx-search'></i></button>
                            <a href="Ganti_Pas.php" class="btn-modern btn-outline">Reset</a>
                        </div>
                        <div>
                            <?php if($show_all): ?>
                                <a href="Ganti_Pas.php" class="btn-modern btn-outline">Mode Halaman</a>
                            <?php else: ?>
                                <a href="Ganti_Pas.php?view=all" class="btn-modern btn-outline"><i class='bx bx-list-ul'></i> Lihat Semua</a>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="table-wrapper">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Akses</th>
                                    <th style="text-align: center;">Opsi Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)): ?>
                                    <?php foreach($result as $v): if(isset($v["id"])): ?>
                                    <tr>
                                        <td style="font-weight:600;"><?php echo $v["username"]; ?></td>
                                        <td><?php echo $v["nama"]; ?></td>
                                        <td><span class="level-badge">LEVEL <?php echo $v["level"]; ?></span></td>
                                        <td>
                                           
                                                <a href="delete1.php?id=<?php echo $v["id"]; ?>" class="btn-action btn-danger" onclick="return confirm('Hapus admin ini?')" title="Hapus Akun">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" style="text-align:center; padding:30px;">Tidak ada data.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="footer-tools">
                        <div style="font-size: 13px; color: #666;">
                            Total: <strong><?php echo $total_records; ?></strong> Akun terdaftar
                        </div>
                        <div class="pagination-links">
                            <?php echo $pagination_html; ?>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="main-card" style="border-left: 5px solid var(--warning);">
                <h4 style="margin:0 0 10px 0;"><i class='bx bx-lock-open-alt'></i>  Ganti Password User 
                                                <a href="update.php?id=<?php echo $v["id"]; ?>" class="btn-action btn-warning" title="Ganti Password">
                                                    <i class='bx bx-key'></i>
                                                </a>
              </h4>
                
                <p style="font-size: 13px; color: #666; margin: 0;">Gunakan tombol <span style="color: #d4ac0d; font-weight: bold;">Kunci (Kuning)</span> untuk mereset atau mengganti password admin yang lupa. Disarankan menggunakan kombinasi huruf dan angka.</p>
      
        </div>
    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = () => sidebar.classList.toggle("active");
    </script>
</body>
</html>