<?php
session_start();
if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}
$user_login = $_SESSION['nama'];

// Session Timeout Logic
$inactivity_time = 1200; 
if (isset($_SESSION['last_timestamp']) && (time() - $_SESSION['last_timestamp']) > $inactivity_time) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    session_regenerate_id(true);
    $_SESSION['last_timestamp'] = time();
}

require_once("dbcontroller.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

// --- LOGIKA HAPUS TERPILIH (MULTI-DELETE) ---
if (isset($_POST['btn_delete_selected']) && !empty($_POST['selected_id'])) {
    $ids = implode(',', array_map('intval', $_POST['selected_id']));
    $sql_multi_delete = "DELETE FROM toy WHERE id IN ($ids)";
    if (mysqli_query($conn, $sql_multi_delete)) {
        echo "<script>alert('Data terpilih berhasil dihapus!'); window.location.href='Data_Siswa.php';</script>";
        exit;
    }
}

// --- LOGIKA HAPUS SEMUA ---
if (isset($_GET['action']) && $_GET['action'] == 'delete_all') {
    $sql_truncate = "TRUNCATE TABLE toy";
    if (mysqli_query($conn, $sql_truncate)) {
        echo "<script>alert('Semua data berhasil dihapus!'); window.location.href='Data_Siswa.php';</script>";
        exit;
    }
}

// Fitur Pencarian
$queryCondition = "";
if(!empty($_POST["search"])) {
    $conditions = [];
    foreach($_POST["search"] as $k => $v){
        if(!empty($v)) {
            $conditions[] = "$k LIKE '$v%'";
        }
    }
    if(!empty($conditions)) {
        $queryCondition = " WHERE " . implode(" AND ", $conditions);
    }
}

// Logic All Data vs Pagination
$showAll = isset($_GET['show']) && $_GET['show'] == 'all';
$perPage = 6; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page <= 0) $page = 1;
$start = ($page - 1) * $perPage;

$orderby = " ORDER BY id DESC"; 
$sql_base = "SELECT * FROM toy " . $queryCondition;
$total_records = $db_handle->numRows($sql_base);
$total_pages = ceil($total_records / $perPage);

if ($showAll) {
    $query = $sql_base . $orderby; 
} else {
    $query = $sql_base . $orderby . " LIMIT $start, $perPage"; 
}
$result = $db_handle->runQuery($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Data Siswa | Mari Belajar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/styles1.css"> 
    <style>
        :root {
            --primary-color: #11101d;
            --success: #2ecc71;
            --danger: #e74c3c;
            --info: #3498db;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #095814; color: #333; margin: 0; }
        .home_content { padding: 20px 40px; background: #0e7005; min-height: 140vh; }
        .header-main {
            background: linear-gradient(135deg, #11101d 0%, #058010 100%);
            padding: 30px; border-radius: 15px; color: white; margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .data-card { background: #fff; border-radius: 15px; padding: 25px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); margin-bottom: 25px; }

        .table-scroll-container {
            max-height: 550px; overflow: auto; border: 1px solid #eee; border-radius: 12px;
        }

        .modern-table { width: 100%; border-collapse: separate; border-spacing: 0; background: white; }
        .modern-table thead th {
            position: sticky; top: 0; background: #f8f9fa; z-index: 10;
            box-shadow: 0 2px 2px -1px rgba(0,0,0,0.1);
            color: #777; font-size: 12px; padding: 15px; text-align: left; text-transform: uppercase;
        }
        .modern-table td { padding: 15px; border-bottom: 1px solid #eee; font-size: 14px; }
        
        /* Dropdown & Buttons Styles ... (Keep your original styles) */
        .dropdown-modern { position: relative; display: inline-block; }
        .dropbtn-modern { background: var(--primary-color); color: white; padding: 12px 24px; border-radius: 10px; border: none; cursor: pointer; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .dropdown-content { display: none; position: absolute; right: 0; background-color: #fff; min-width: 220px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 12px; z-index: 999; border: 1px solid #eee; overflow: hidden; }
        .dropdown-content a { color: #444; padding: 12px 20px; text-decoration: none; display: flex; align-items: center; gap: 12px; font-size: 14px; transition: 0.1s; }
        .dropdown-content a:hover { background: #f8f9fa; color: var(--info); }
        .dropdown-modern:hover .dropdown-content { display: block; }
        .btn-act { padding: 8px; border-radius: 8px; text-decoration: none; color: white; margin: 2px; display: inline-flex; transition: 0.3s; }
        .btn-edit { background: var(--info); }
        .btn-delete { background: var(--danger); }
        .btn-verif { background: var(--success); }
        .btn-delete-multi { background: var(--danger); color: white; border: none; padding: 12px 20px; border-radius: 10px; cursor: pointer; font-weight: 600; display: none; margin-right: 10px; }
        .badge { padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-verif { background: #d4edda; color: #155724; }
        .badge-pending { background: #fff3cd; color: #856404; }
        .pagination-wrapper { display: flex; justify-content: center; align-items: center; margin-top: 30px; gap: 10px; flex-wrap: wrap; }
        .page-link { padding: 10px 18px; border-radius: 10px; background: white; color: var(--primary-color); text-decoration: none; border: 1px solid #ddd; transition: 0.3s; }
        .page-link:hover, .page-link.active { background: var(--primary-color); color: white; }
        .btn-all-data { padding: 10px 20px; border-radius: 10px; background: #fff; color: var(--info); border: 2px solid var(--info); text-decoration: none; font-weight: 500; transition: 0.3s; }
        .btn-all-data:hover { background: var(--info); color: #fff; }
        .stats-footer { margin-top: 25px; padding: 15px; background: #f8f9fa; border-radius: 12px; display: flex; justify-content: space-between; font-size: 11px; color: #666; }

        /* --- STYLE BARU UNTUK PANDUAN --- */
        .guide-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 20px; }
        .guide-item { display: flex; gap: 15px; padding: 15px; border: 1px solid #f0f0f0; border-radius: 12px; transition: 0.3s; }
        .guide-item:hover { border-color: var(--info); background: #fbfcfe; }
        .guide-item i { font-size: 28px; color: var(--info); }
        .guide-item h4 { margin: 0 0 5px 0; font-size: 15px; color: #333; }
        .guide-item p { margin: 0; font-size: 12px; color: #777; line-height: 1.6; }
        .kontainer-scroll {
   
   overflow-y: scroll; /* Scroll vertikal */

}
    </style>
</head>
<body class="kontainer-scroll">
    <div class="sidebar">
        <div class="logo_content">
            <div class="logo"><i class='bx bxl-codepen'></i><div class="logo_name">Mari Belajar</div></div>
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
        <div class="header-main">
            <h2 style="font-weight: 600; margin: 0;">Manajemen Data Siswa</h2>
            <p style="margin: 5px 0 0 0; opacity: 0.9;">User Terhubung: <b><?php echo $user_login; ?></b></p>
        </div>

        <div class="data-card">
            <form id="mainForm" method="POST" action="">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <button type="submit" name="btn_delete_selected" id="multiDeleteBtn" class="btn-delete-multi" onclick="return confirm('Hapus data terpilih?')">
                            <i class='bx bx-trash'></i> Hapus Terpilih
                        </button>
                        <div style="display: flex; gap: 5px;">
                            <input type="text" placeholder="ID..." name="search[id]" style="padding: 12px; border: 1px solid #ddd; border-radius: 10px; width: 80px; outline:none;">
                            <input type="text" placeholder="Cari Nama..." name="search[Nama]" style="padding: 12px; border: 1px solid #ddd; border-radius: 10px; outline:none;">
                            <button type="submit" style="background: var(--info); color:white; border:none; padding:12px 20px; border-radius:10px; cursor:pointer;">Cari</button>
                            <?php if($showAll || !empty($_POST["search"])) echo '<a href="Data_Siswa.php" style="padding:12px; color:#999;"><i class="bx bx-refresh" style="font-size:24px;"></i></a>'; ?>
                        </div>
                    </div>

                    <div class="dropdown-modern">
                        <button type="button" class="dropbtn-modern"><i class='bx bx-customize'></i> Menu Eksekusi <i class='bx bx-chevron-down'></i></button>
                        <div class="dropdown-content">
                            <a href="student-create2.php"><i class='bx bx-user-plus'></i> Tambah Siswa</a>
                            <a href="cetak.php" target="_blank"><i class='bx bx-printer'></i> Cetak PDF</a>
                            <a href="excel.php"><i class='bx bx-file'></i> Ekspor Excel</a>
                            <a href="import-excel/index6.php"><i class='bx bx-file-blank'></i> Impor Excel</a>
                            <hr style="border:0; border-top:1px solid #eee; margin:0;">
                            <a href="?action=delete_all" style="color: var(--danger);" onclick="return confirm('HAPUS SELURUH ISI TABEL?')">
                                <i class='bx bx-bomb'></i> Kosongkan Tabel
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-scroll-container">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;"><input type="checkbox" id="selectAll"></th>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>L/P</th>
                                <th>Kursus</th>
                                <th>Alamat</th>
                                <th>Tanggal</th>
                                <th>Whatsapp</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($result)): ?>
                                <?php foreach($result as $row): ?>
                                <tr>
                                    <td><input type="checkbox" name="selected_id[]" value="<?php echo $row['id']; ?>" class="rowCheckbox"></td>
                                    <td>#<?php echo $row["id"]; ?></td>
                                    <td style="font-weight: 500; color: var(--primary-color);"><?php echo $row["Nama"]; ?></td>
                                    <td><?php echo ($row["Jenis_Kelamin"] == 'Laki-Laki') ? 'L' : 'P'; ?></td>
                                    <td><span class="badge badge-pending"><?php echo $row["Kursus"]; ?></span></td>
                                    <td><?php echo $row["Alamat"]; ?></td>
                                    <td><?php echo $row["Date"]; ?></td>
                                    <td><?php echo $row["No_Hp"]; ?></td>
                                    <td><span class="badge badge-verif"><?php echo $row["Setatus"]; ?></span></td>
                                    <td>
                                        <div style="display:flex;">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-act btn-edit" title="Edit"><i class='bx bx-edit-alt'></i></a>
                                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-act btn-delete" onclick="return confirm('Hapus?')" title="Hapus"><i class='bx bx-trash'></i></a>
                                            <a href="Verifikasi.php?id=<?php echo $row['id']; ?>" class="btn-act btn-verif" title="Verifikasi"><i class='bx bx-check-shield'></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="10" style="text-align:center; padding:30px;">Data tidak ditemukan.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </form>

            <div class="pagination-wrapper">
                <?php if (!$showAll): ?>
                    <a href="?page=<?php echo ($page > 1) ? $page - 1 : 1; ?>" class="page-link">&laquo; Prev</a>
                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?page=<?php echo $i; ?>" class="page-link <?php echo ($page == $i) ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <a href="?page=<?php echo ($page < $total_pages) ? $page + 1 : $total_pages; ?>" class="page-link">Next &raquo;</a>
                    <a href="?show=all" class="btn-all-data">Lihat Semua Data (All)</a>
                <?php else: ?>
                    <a href="Data_Siswa.php" class="btn-all-data"><i class='bx bx-list-ul'></i> Kembali ke Pagination</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="data-card">
            <h3 style="margin-top: 0; display: flex; align-items: center; gap: 10px;">
                <i class='bx bx-book-open' style="color: var(--info);"></i> 
                Panduan Penggunaan Menu Data Siswa
            </h3>
            <div class="guide-container">
                <div class="guide-item">
                    <i class='bx bx-check-double'></i>
                    <div>
                        <h4>Hapus Terpilih</h4>
                        <p>Centang kotak di sisi kiri tabel, lalu tombol merah <b>"Hapus Terpilih"</b> akan muncul otomatis di atas untuk menghapus banyak data sekaligus.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <i class='bx bx-search-alt'></i>
                    <div>
                        <h4>Pencarian Cepat</h4>
                        <p>Gunakan filter ID atau Nama di atas tabel. Tekan ikon <b>Refresh</b> di samping tombol cari untuk membatalkan filter dan melihat data semula.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <i class='bx bx-cloud-download'></i>
                    <div>
                        <h4>Ekspor & Impor</h4>
                        <p>Klik menu <b>"Menu Eksekusi"</b> untuk mencetak PDF, mengunduh file Excel, atau mengunggah data siswa baru dari file Excel.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <i class='bx bx-mouse-alt'></i>
                    <div>
                        <h4>Fitur Scroll</h4>
                        <p>Gunakan fitur scroll di dalam tabel untuk melihat data lebih banyak tanpa perlu berpindah halaman jika memilih mode <b>"Lihat Semua Data"</b>.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = function() { sidebar.classList.toggle("active"); }

        const selectAll = document.getElementById('selectAll');
        const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
        const multiDeleteBtn = document.getElementById('multiDeleteBtn');

        function updateButtonVisibility() {
            const checkedCount = document.querySelectorAll('.rowCheckbox:checked').length;
            multiDeleteBtn.style.display = checkedCount > 0 ? 'block' : 'none';
        }

        selectAll.addEventListener('click', function() {
            rowCheckboxes.forEach(checkbox => { checkbox.checked = selectAll.checked; });
            updateButtonVisibility();
        });

        rowCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonVisibility);
        });
    </script>
</body>
</html>