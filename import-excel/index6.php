<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Import Data Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 30;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .import-card {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 480px;
            text-align: center;
        }

        .icon-box {
            width: 69px;
            height: 64px;
            background: #eef2ff;
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 24px;
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0 0 8px;
        }

        p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        /* Modern File Input */
        .file-drop-area {
            position: relative;
            display: flex;
            align-items: center;
            width: 90%;
            padding: 20px;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            transition: 0.3s;
            cursor: pointer;
            margin-bottom: 25px;
        }

        .file-drop-area:hover {
            border-color: var(--primary-color);
            background: #f5f7ff;
        }

        input[type="file"] {
            position: absolute;
            left: 0; top: 0; bottom: 0; right: 0;
            width: 90%; height: 90%;
            opacity: 0;
            cursor: pointer;
        }

        .file-msg {
            font-size: 0.85rem;
            color: var(--text-muted);
            pointer-events: none;
        }

        /* Button Styling */
        .btn-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        button, input[type="submit"] {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-import {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-import:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-back {
            background-color: transparent;
            color: var(--text-muted);
            border: 1px solid #e2e8f0;
        }

        .btn-back:hover {
            background-color: #f1f5f9;
            color: var(--text-main);
        }

        /* Feedback Alerts */
        .status-msg {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.85rem;
        }
        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }
    </style>
    
    <?php include 'koneksi.php'; ?>
</head>
<body>

<div class="import-card">
    <div class="icon-box">
        <i class="fas fa-file-excel"></i>
    </div>
    <h1>Import Data Siswa</h1>
    <p>Silakan unggah file Excel Anda untuk memperbarui database otomatis.</p>

    <form method="post" enctype="multipart/form-data">
        <div class="file-drop-area">
            <i class="fas fa-cloud-upload-alt" style="margin-right: 15px; color: #94a3b8;"></i>
            <span class="file-msg">Klik atau seret file ke sini...</span>
            <input name="filemhsw" type="file" required onchange="updateFileName(this)">
        </div>
        
        <div class="btn-stack">
            <input name="upload" type="submit" class="btn-import" value="Mulai Import">
            <button type="button" class="btn-back" onclick="history.back()">Kembali</button>
        </div>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        require('spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
        require('spreadsheet-reader-master/SpreadsheetReader.php');

        $target_dir = "uploads/".basename($_FILES['filemhsw']['name']);
        
        if(move_uploaded_file($_FILES['filemhsw']['tmp_name'], $target_dir)) {
            $Reader = new SpreadsheetReader($target_dir);
            $total = 0;

            foreach ($Reader as $Key => $Row) {
                if ($Key < 1) continue; 
                $q = mysql_query("INSERT INTO toy VALUES ('".$Row[0]."', '".$Row[1]."','".$Row[2]."','".$Row[3]."','".$Row[4]."','".$Row[5]."','".$Row[6]."','".$Row[7]."')");
                if($q) $total++;
            }
            echo "<div class='status-msg success'><i class='fas fa-check-circle'></i> Berhasil! $total data diimport.</div>";
        } else {
            echo "<div class='status-msg error'><i class='fas fa-exclamation-triangle'></i> Gagal mengunggah file.</div>";
        }
    }
    ?>
</div>

<script>
    // Script sederhana untuk menampilkan nama file yang dipilih
    function updateFileName(input) {
        let fileName = input.files[0].name;
        document.querySelector('.file-msg').innerText = fileName;
        document.querySelector('.file-drop-area').style.borderColor = 'var(--primary-color)';
    }
</script>

</body>
</html>