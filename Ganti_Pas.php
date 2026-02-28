<?php
  require_once("perpage.php");  
  require_once("dbcontroller.php");
  $db_handle = new DBController();
  $conn = $db_handle->connectDB();
  
  $username = "";
  $queryCondition = "";

  // --- 1. LOGIKA HAPUS TERPILIH (MULTI-DELETE) ---
  if (isset($_POST['btn_delete_selected']) && !empty($_POST['selected_id'])) {
      $ids = implode(',', array_map('intval', $_POST['selected_id']));
      $sql_multi_delete = "DELETE FROM tb_user WHERE id IN ($ids)";
      if (mysqli_query($conn, $sql_multi_delete)) {
          echo "<script>alert('Data terpilih berhasil dihapus!'); window.location.href='Ganti_Pas.php';</script>";
          exit;
      }
  }

  // --- 2. LOGIKA HAPUS SEMUA ---
  if (isset($_GET['action']) && $_GET['action'] == 'delete_all') {
      if (mysqli_query($conn, "TRUNCATE TABLE tb_user")) {
          echo "<script>alert('Semua data admin berhasil dihapus!'); window.location.href='Ganti_Pas.php';</script>";
          exit;
      }
  }

  // --- 3. LOGIKA PENCARIAN ---
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
    
  $show_all = isset($_GET['view']) && $_GET['view'] == 'all';
  $perPage = 5; 
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
            --danger: #e74c3c;
            --info: #3498db;
            --warning: #f1c40f;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #095814; color: #333; margin: 0; }
        .home_content { padding: 20px 40px; background: #0e7005; min-height: 130vh; }
        .admin-container { padding: 20px 10px; }
        
        .page-header {
            background: linear-gradient(135deg, #11101d 0%, #058010 100%);
            padding: 25px; border-radius: 15px; color: white; margin-bottom: 25px;
            display: flex; justify-content: space-between; align-items: center;
        }

        .main-card {
            background: #fff; border-radius: 15px; padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1); margin-bottom: 25px;
        }

        .toolbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px; flex-wrap: wrap; gap: 15px;
        }

        .btn-modern {
            padding: 10px 18px; border-radius: 8px; border: none; cursor: pointer;
            font-weight: 600; text-decoration: none; display: inline-flex; 
            align-items: center; gap: 8px; transition: 0.3s; font-size: 13px;
        }

        .btn-primary { background: var(--primary); color: white; }
        .btn-info { background: var(--info); color: white; }
        .btn-danger { background: var(--danger); color: white; }
        .btn-warning { background: var(--warning); color: #333; }
        .btn-outline { background: #fff; color: #555; border: 1px solid #ddd; }

        .table-scroll-container {
            max-height: 400px; 
            overflow: auto;
            border: 1px solid #eee;
            border-radius: 12px;
        }

        .modern-table { width: 100%; border-collapse: collapse; background: white; }
        .modern-table thead th { 
            background: #f8faf8; padding: 15px; text-align: left; font-size: 12px; 
            color: #777; border-bottom: 2px solid #eee; position: sticky; top: 0; z-index: 10;
        }
        .modern-table td { padding: 15px; border-bottom: 1px solid #f1f1f1; font-size: 14px; }
        
        .level-badge { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; background: #e8f5e9; color: var(--primary); }
        .btn-action { width: 35px; height: 35px; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-decoration: none; color: white; transition: 0.2s; }
        
        #btnDeleteSelected { display: none; background: var(--danger); color: white; border: none; padding: 10px 18px; border-radius: 8px; cursor: pointer; font-weight: 600; align-items: center; gap: 8px; }

        /* CSS PANDUAN */
        .guide-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }
        .guide-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #fdfdfd;
            border: 1px solid #f0f0f0;
            border-radius: 10px;
        }
        .guide-item i {
            font-size: 24px;
            color: var(--info);
        }
        .guide-text h4 { margin: 0 0 5px 0; font-size: 14px; color: #333; }
        .guide-text p { margin: 0; font-size: 12px; color: #777; line-height: 1.5; }
        .kontainer-scroll {
   
   overflow-y: scroll; /* Scroll vertikal */

}
    </style>
</head>
<body class="kontainer-scroll">

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo"><div class="logo_name">Mari Belajar</div></div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li><a href="Dashboard.php"><i class='bx bx-grid-alt'></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="Data_Siswa.php"><i class='bx bx-user'></i><span class="links_name">Data Siswa</span></a></li>
            <li><a href="Ganti_Pas.php"><i class='bx bx-cog'></i><span class="links_name">Admin</span></a></li>
            <li><a href="Input_Sidebar.php"><i class='bx bx-cog'></i><span class="links_name">Sidebar</span></a></li>
            <li><a href="Input_Header.php"><i class='bx bx-cog'></i><span class="links_name">Header</span></a></li>
            <li><a href="logout.php"><i class='bx bx-log-out'></i><span class="links_name">Keluar</span></a></li>
        </ul>
    </div>

    <div class="home_content">
        <div class="admin-container">
            <div class="page-header">
                <div>
                    <h2 style="margin:0;"><i class='bx bx-shield-quarter'></i> Panel Admin</h2>
                    <p style="margin:5px 0 0 0; opacity: 0.8;">Manajemen Akun & Keamanan</p>
                </div>
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <a href="update.php" class="btn-modern btn-warning"><i class='bx bx-key'></i> Ubah Password</a>
                    <a href="Ganti_Pas.php?action=delete_all" class="btn-modern btn-danger" onclick="return confirm('KOSONGKAN SELURUH DATA?')"><i class='bx bx-trash-alt'></i> Hapus Semua</a>
                    <a href="index3.php" class="btn-modern btn-primary"><i class='bx bx-plus'></i> Tambah Baru</a>
                </div>
            </div>

            <div class="main-card">
                <form id="multiDeleteForm" method="post" action="">
                    <div class="toolbar">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <button type="submit" name="btn_delete_selected" id="btnDeleteSelected">
                                <i class='bx bx-check-double'></i> Hapus Terpilih
                            </button>

                            <input type="text" placeholder="Cari username..." name="search[username]" class="input-modern" style="padding: 10px; border-radius: 8px; border: 1px solid #ddd;" value="<?php echo $username; ?>">
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

                    <div class="table-scroll-container">
                        <table class="modern-table">
                            <thead>
                                <tr>
                                    <th style="width: 40px;"><input type="checkbox" id="checkAll"></th>
                                    <th>Username</th>
                                    <th>Nama Lengkap</th>
                                    <th>Akses</th>
                                    <th style="text-align: center;">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($result)): ?>
                                    <?php foreach($result as $v): if(isset($v["id"])): ?>
                                    <tr>
                                        <td><input type="checkbox" name="selected_id[]" value="<?php echo $v['id']; ?>" class="itemCheckbox"></td>
                                        <td style="font-weight:600;"><?php echo $v["username"]; ?></td>
                                        <td><?php echo $v["nama"]; ?></td>
                                        <td><span class="level-badge">LEVEL <?php echo $v["level"]; ?></span></td>
                                        <td>
                                            <div style="display: flex; gap: 5px; justify-content: center;">
                                                <!--<a href="update.php?id=<?php echo $v["id"]; ?>" class="btn-action" style="background:var(--warning)" title="Ubah Password"><i class='bx bx-key'></i></a>-->
                                                <a href="delete1.php?id=<?php echo $v["id"]; ?>" class="btn-action" style="background:var(--danger)" onclick="return confirm('Hapus user ini?')" title="Hapus"><i class='bx bx-trash'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" style="text-align:center; padding:30px;">Data tidak ditemukan.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="footer-tools" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                        <div style="font-size: 13px; color: #666;">
                            Menampilkan <strong><?php echo count($result); ?></strong> dari <strong><?php echo $total_records; ?></strong> data.
                        </div>
                        <div class="pagination-links"><?php echo $pagination_html; ?></div>
                    </div>
                </form>
            </div>

            <div class="main-card">
                <h3 style="margin-top:0; color:var(--dark); display:flex; align-items:center; gap:10px;">
                    <i class='bx bx-info-circle' style="color:var(--info)"></i> Cara Penggunaan Aplikasi
                </h3>
                <hr border="0" style="border-top:1px solid #eee; margin-bottom:20px;">
                
                <div class="guide-section">
                    <div class="guide-item">
                        <i class='bx bx-search-alt'></i>
                        <div class="guide-text">
                            <h4>Pencarian Data</h4>
                            <p>Ketik username pada kolom cari dan tekan ikon lensa untuk memfilter admin tertentu.</p>
                        </div>
                    </div>
                    
                    <div class="guide-item">
                        <i class='bx bx-check-square'></i>
                        <div class="guide-text">
                            <h4>Hapus Terpilih</h4>
                            <p>Centang satu atau beberapa baris, lalu tombol "Hapus Terpilih" akan muncul otomatis di atas.</p>
                        </div>
                    </div>

                    <div class="guide-item">
                        <i class='bx bx-key'></i>
                        <div class="guide-text">
                            <h4>Manajemen Password</h4>
                            <p>Gunakan ikon kunci kuning di baris tabel untuk mengubah password user spesifik.</p>
                        </div>
                    </div>

                    <div class="guide-item">
                        <i class='bx bx-list-ol'></i>
                        <div class="guide-text">
                            <h4>Lihat Semua</h4>
                            <p>Gunakan tombol "Lihat Semua" untuk menonaktifkan halaman dan melihat seluruh data dalam satu scroll.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = () => sidebar.classList.toggle("active");

        const checkAll = document.getElementById('checkAll');
        const checkboxes = document.querySelectorAll('.itemCheckbox');
        const btnDeleteSelected = document.getElementById('btnDeleteSelected');

        function toggleDeleteButton() {
            const checkedCount = document.querySelectorAll('.itemCheckbox:checked').length;
            btnDeleteSelected.style.display = checkedCount > 0 ? 'inline-flex' : 'none';
        }

        checkAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            toggleDeleteButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleDeleteButton);
        });
    </script>
</body>
</html>