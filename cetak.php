<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Siswa - Mari Belajar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        
        /* Header Laporan */
        .header-laporan {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header-laporan h2 {
            margin: 0;
            text-transform: uppercase;
            font-size: 22px;
        }
        .header-laporan h4 {
            margin: 5px 0 0 0;
            font-weight: normal;
            font-size: 16px;
        }

        /* Tabel Laporan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px; /* Ukuran standar laporan cetak */
        }
        
        table th {
            background-color: #f2f2f2;
            color: #000;
            padding: 10px;
            text-align: center;
            border: 1px solid #000;
            font-weight: bold;
        }
        
        table td {
            padding: 8px;
            border: 1px solid #000;
            vertical-align: middle;
        }

        /* Penomoran otomatis baris */
        tr:nth-child(even) {
            background-color: #fafafa;
        }

        /* Pengaturan saat cetak */
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
            table { page-break-inside: auto; }
            tr { page-break-inside: avoid; page-break-after: auto; }
            thead { display: table-header-group; }
        }
    </style>
</head>

<body>

    <?php include 'koneksi.php'; ?>

    <div class="header-laporan">
        <h2>Laporan Data Siswa</h2>
        <h4>Lembaga Kursus Mari Belajar</h4>
        <p style="font-size: 11px; margin-top: 5px;">Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">ID</th>
                <th width="20%">Nama Siswa</th>
                <th width="10%">Gender</th>
                <th width="20%">Kursus</th>
                <th width="20%">Alamat</th>
                <th width="15%">No. WhatsApp</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $sql = mysqli_query($koneksi, "SELECT * FROM toy ORDER BY id DESC");
            while($data = mysqli_fetch_array($sql)){
            ?>
            <tr>
                <td align="center"><?php echo $no++; ?></td>
                <td align="center"><?php echo $data['id']; ?></td>
                <td><?php echo $data['Nama']; ?></td>
                <td align="center"><?php echo $data['Jenis_Kelamin']; ?></td>
                <td><?php echo $data['Kursus']; ?></td>
                <td><?php echo $data['Alamat']; ?></td>
                <td align="center"><?php echo $data['No_Hp']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <div style="margin-top: 30px; float: right; text-align: center;" class="no-print">
        <p>Admin Mari Belajar,</p>
        <br><br><br>
        <p><b>( _________________ )</b></p>
    </div>

    <script>
        // Menunda print sejenak agar browser merender style dengan sempurna
        window.onload = function() {
            window.print();
        };
    </script>
 
</body>
</html>