<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if ($id) {
    // Mode Kartu / Detail Tunggal
    $res = $db_handle->runQuery("SELECT * FROM tb_user WHERE id = '$id'");
    $data = $res[0];
    $title = "Cetak_Akun_" . $data['username'];
} else {
    // Mode Laporan Tabel
    $result = $db_handle->runQuery("SELECT * FROM tb_user ORDER BY id DESC");
    $title = "Laporan_Data_Admin";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --primary: #095814;
            --secondary: #2ecc71;
            --text-dark: #2c3e50;
        }
        
        body { 
            font-family: 'Inter', sans-serif; 
            padding: 40px; 
            color: var(--text-dark); 
            background-color: #f4f7f6;
            margin: 0;
        }

        /* Toolbar Action - Tidak Ikut Dicetak */
        .toolbar {
            max-width: 900px;
            margin: 0 auto 30px auto;
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .btn-back { background: #fff; color: #555; border: 1px solid #ddd; }
        .btn-print { background: var(--secondary); color: white; box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3); }
        .btn:hover { transform: translateY(-2px); opacity: 0.9; }

        /* Container Dokumen */
        .paper {
            background: white;
            max-width: 900px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            border-radius: 5px;
            min-height: 800px;
        }

        /* Kop Surat */
        .header-kop {
            text-align: center;
            border-bottom: 3px solid var(--primary);
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header-kop h1 { margin: 0; color: var(--primary); letter-spacing: 2px; }
        .header-kop p { margin: 5px 0 0 0; color: #777; font-size: 14px; }

        /* Tampilan Tabel */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f8f9fa; color: #555; padding: 12px; border: 1px solid #dee2e6; text-transform: uppercase; font-size: 12px; }
        td { padding: 12px; border: 1px solid #dee2e6; font-size: 14px; }
        tr:nth-child(even) { background: #fafafa; }

        /* Tampilan Kartu */
        .kartu-modern {
            width: 400px;
            margin: 50px auto;
            border: 1px solid #eee;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .kartu-header { background: var(--primary); color: white; padding: 20px; text-align: center; }
        .kartu-body { padding: 30px; background: white; }
        .info-row { margin-bottom: 15px; border-bottom: 1px solid #f1f1f1; padding-bottom: 8px; }
        .info-label { font-size: 11px; color: #999; text-transform: uppercase; font-weight: bold; }
        .info-value { font-size: 16px; color: #333; font-weight: 600; }

        .footer-note { margin-top: 50px; font-size: 12px; color: #999; text-align: center; }

        /* Pengaturan Cetak */
        @media print {
            body { background: white; padding: 0; }
            .toolbar { display: none; }
            .paper { box-shadow: none; padding: 0; width: 100%; max-width: 100%; }
            .kartu-modern { box-shadow: none; border: 1px solid #ddd; margin-top: 0; }
        }
    </style>
</head>
<body>

    <div class="toolbar">
        <a href="Ganti_Pas.php" class="btn btn-back">
            <i class='bx bx-left-arrow-alt'></i> Kembali ke Panel
        </a>
        <button class="btn btn-print" onclick="window.print()">
            <i class='bx bx-printer'></i> Cetak ke PDF
        </button>
    </div>

    <div class="paper">
        <?php if ($id): ?>
            <div class="kartu-modern">
                <div class="kartu-header">
                    <h3 style="margin:0;">MARI BELAJAR</h3>
                    <span style="font-size:12px; opacity:0.8;">ID CARD ADMINISTRATOR</span>
                </div>
                <div class="kartu-body">
                    <div class="info-row">
                        <div class="info-label">Nama Lengkap</div>
                        <div class="info-value"><?php echo $data['nama']; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?php echo $data['username']; ?></div>
                    </div>
                    <div class="info-row">
                        <div class="info-label">Hak Akses</div>
                        <div class="info-value">Level <?php echo $data['level']; ?></div>
                    </div>
                    <div class="info-row" style="border:none;">
                        <div class="info-label">Password Hash</div>
                        <div class="info-value" style="font-size: 10px; color:#aaa; word-break: break-all;">
                            <?php echo $data['password']; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-note">Kartu ini diterbitkan otomatis oleh sistem pada <?php echo date('d/m/Y H:i'); ?></div>

        <?php else: ?>
            <div class="header-kop">
                <h1>MARI BELAJAR</h1>
                <p>Alamat Instansi Bapak / Website Resmi Manajemen Admin</p>
                <p>Laporan Data Akun Administrator Sistem</p>
            </div>

            <h3 style="text-align: center; text-transform: uppercase;">Daftar Seluruh Pengguna</h3>
            
            <table>
                <thead>
                    <tr>
                        <th style="width: 30px;">No</th>
                        <th>Nama Administrator</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Keamanan (Password Hash)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=1; foreach($result as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $n++; ?></td>
                        <td><strong><?php echo strtoupper($r['nama']); ?></strong></td>
                        <td><?php echo $r['username']; ?></td>
                        <td style="text-align:center;">Level <?php echo $r['level']; ?></td>
                        <td style="font-size: 10px; color: #999;"><?php echo $r['password']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="margin-top: 50px; display: flex; justify-content: flex-end;">
                <div style="text-align: center; width: 200px;">
                    <p>Dicetak pada: <?php echo date('d F Y'); ?></p>
                    <br><br><br>
                    <p><strong>( ________________ )</strong></p>
                    <p>Super Admin</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>