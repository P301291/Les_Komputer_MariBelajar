<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$conn = $db_handle->connectDB();

// Ambil ID jika mencetak per siswa, jika tidak ada maka cetak semua
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if ($id) {
    // Mode Kartu / Detail Siswa Tunggal
    $res = $db_handle->runQuery("SELECT * FROM toy WHERE id = '$id'");
    if($res) {
        $data = $res[0];
        $title = "Detail_Siswa_" . $data['Nama'];
    }
} else {
    // Mode Laporan Seluruh Siswa
    $result = $db_handle->runQuery("SELECT * FROM toy ORDER BY id DESC");
    $title = "Laporan_Data_Siswa_Masuk";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1e3a8a;
            --secondary: #64748b;
            --accent: #2563eb;
            --success: #059669;
            --light: #f8fafc;
            --dark: #1e293b;
        }

        * { box-sizing: border-box; }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #e2e8f0; 
            margin: 0; 
            padding: 40px; 
            color: var(--dark); 
        }

        /* Toolbar Action */
        .toolbar {
            max-width: 900px;
            margin: 0 auto 20px auto;
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: 0.2s;
            font-size: 14px;
        }

        .btn-print { background: var(--primary); color: white; }
        .btn-print:hover { background: var(--accent); }
        .btn-back { background: #fff; color: var(--dark); border: 1px solid #cbd5e1; }
        .btn-back:hover { background: #f1f5f9; }

        /* Container Utama */
        .paper {
            background: white;
            max-width: 900px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-radius: 4px;
            min-height: 1100px;
        }

        /* Header Laporan */
        .header-laporan { 
            text-align: center; 
            border-bottom: 2px solid var(--primary); 
            padding-bottom: 20px; 
            margin-bottom: 30px; 
        }
        .header-laporan h1 { margin: 0; color: var(--primary); letter-spacing: 1px; }
        .header-laporan p { margin: 5px 0; color: var(--secondary); font-size: 14px; }

        /* Tabel Modern */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { 
            background: var(--primary); 
            color: white; 
            padding: 12px 15px; 
            text-align: left; 
            font-size: 12px; 
            text-transform: uppercase; 
        }
        td { 
            padding: 12px 15px; 
            border-bottom: 1px solid #e2e8f0; 
            font-size: 13px; 
        }
        tr:nth-child(even) { background-color: var(--light); }

        /* Gaya Kartu Detail (Single) */
        .kartu-detail { 
            max-width: 600px; 
            margin: 0 auto; 
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }
        .kartu-header {
            background: var(--primary);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .kartu-body { padding: 30px; }
        .row-info { 
            display: flex; 
            padding: 10px 0; 
            border-bottom: 1px solid #f1f5f9;
        }
        .label { font-weight: 700; width: 150px; color: var(--secondary); font-size: 13px; }
        .value { flex: 1; font-weight: 500; font-size: 14px; }

        .status-badge {
            background: #dcfce7;
            color: #166534;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 700;
        }

        /* Footer Cetak */
        .footer-print {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--secondary);
        }

        @media print { 
            .toolbar { display: none; } 
            body { background: white; padding: 0; }
            .paper { box-shadow: none; width: 100%; max-width: 100%; padding: 0; min-height: auto; }
        }
    </style>
</head>
<body>

    <div class="toolbar">
        <a href="Data_Siswa.php" class="btn btn-back">⬅ KEMBALI</a>
        <button class="btn btn-print" onclick="window.print()">🖨️ CETAK DOKUMEN</button>
    </div>

    <div class="paper">
    <br>
    <br>
        <?php if ($id && isset($data)): ?>
            <div class="kartu-detail">
                <div class="kartu-header">
                    <h2 style="margin:0;">MARI BELAJAR</h2>
                    <p style="margin:5px 0 0 0; opacity: 0.8; font-size: 12px;">BUKTI PENDAFTARAN SISWA</p>
                </div>
                <div class="kartu-body">
                    <div class="row-info">
                        <div class="label">ID DAFTAR</div>
                        <div class="value">: #<?php echo $data['id']; ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">NAMA LENGKAP</div>
                        <div class="value">: <?php echo strtoupper($data['Nama']); ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">GENDER</div>
                        <div class="value">: <?php echo $data['Jenis_Kelamin']; ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">KURSUS</div>
                        <div class="value">: <?php echo $data['Kursus']; ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">WHATSAPP</div>
                        <div class="value">: <?php echo $data['No_Hp']; ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">ALAMAT</div>
                        <div class="value">: <?php echo $data['Alamat']; ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">TGL DAFTAR</div>
                        <div class="value">: <?php echo date('d F Y', strtotime($data['Date'])); ?></div>
                    </div>
                    <div class="row-info">
                        <div class="label">STATUS</div>
                        <div class="value">: <span class="status-badge"><?php echo $data['Setatus']; ?></span></div>
                    </div>

                    
                    </div>
                </div>
            </div>

        <?php elseif(!$id && !empty($result)): ?>
            <div class="header-laporan">
                <h1>LAPORAN DATA SISWA</h1>
                <p>Lembaga Pendidikan Mari Belajar • Jalan Raya Pendidikan No. 123</p>
                <p>Periode Laporan: <?php echo date('F Y'); ?></p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th>Tanggal</th>
                        <th>Nama Lengkap</th>
                        <th>Kursus</th>
                        <th>Kontak</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $n=1; foreach($result as $r): ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $n++; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($r['Date'])); ?></td>
                        <td><strong><?php echo strtoupper($r['Nama']); ?></strong></td>
                        <td><?php echo $r['Kursus']; ?></td>
                        <td><?php echo $r['No_Hp']; ?></td>
                        <td><span class="status-badge"><?php echo $r['Setatus']; ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="footer-print">
                <div>Dicetak pada: <?php echo date('d/m/Y H:i'); ?></div>
                <div style="text-align: center;">
                    Mengetahui,<br><br><br><br>
                    <strong>( Admin Mari Belajar )</strong>
                </div>
            </div>

        <?php else: ?>
            <div style="text-align: center; padding: 50px;">
                <p>Data tidak ditemukan dalam database.</p>
                <a href="Data_Siswa.php" class="btn btn-back">Kembali</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>