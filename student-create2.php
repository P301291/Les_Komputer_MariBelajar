<?php
session_start();
include "koneksi1.php";

// Logika Auto-ID (Gunakan mysqli karena mysql_query sudah usang/deprecated)
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_user";
$koneksi = mysqli_connect($servername, $username, $password, $db);

$query = "SELECT max(id) as id FROM toy";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$kode = $data['id'];
$noUrut = (int) substr($kode, 1, 3);
$noUrut++;
$auto_kode = "1" . sprintf("%03s", $noUrut);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Kursus Modern</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg,rgb(24, 172, 73) 0%,rgb(9, 112, 22) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .card-header {
            background: #4e73df;
            color: white;
            padding: 25px;
            border: none;
            text-align: center;
        }
        .card-header h4 {
            margin: 0;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .card-body {
            padding: 40px;
            background-color: #ffffff;
        }
        .form-label {
            font-weight: 600;
            color: #444;
            margin-bottom: 8px;
        }
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            background-color: #f8f9fa;
            transition: all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            border-color: #4e73df;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .btn-primary {
            background: #4e73df;
            border: none;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
        }
        .btn-outline-secondary {
            border-radius: 10px;
            padding: 12px 20px;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-radius: 10px 0 0 10px;
            border-right: none;
        }
        .has-icon .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .back-link {
            text-decoration: none;
            color: rgba(255,255,255,0.8);
            font-size: 0.9rem;
            transition: 0.3s;
        }
        .back-link:hover {
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header position-relative">
                    <a href="Data_Siswa.php" class="back-link position-absolute start-0 ms-4 mt-1">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <h4><i class="bi bi-person-plus-fill me-2"></i>FORM PENDAFTARAN</h4>
                </div>
                
                <div class="card-body">
                    <form action="code.php" method="POST" class="row g-3">
                        
                        <div class="col-md-6">
                            <label class="form-label">Kode Pendaftaran</label>
                            <input type="text" name="id" value="<?php echo $auto_kode;?>" class="form-control" readonly>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Tanggal</label>
                            <input type="text" name="Date" class="form-control" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('l, d/m/Y'); ?>" readonly>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Nama Lengkap</label>
                            <div class="input-group has-icon">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" name="Nama" class="form-control" placeholder="Masukkan nama lengkap sesuai identitas" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="Jenis_Kelamin" class="form-select" required>
                                <option value="" selected disabled>Pilih Kelamin</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">WhatsApp</label>
                            <div class="input-group has-icon">
                                <span class="input-group-text"><i class="bi bi-whatsapp text-success"></i></span>
                                <input type="number" name="No_Hp" class="form-control" placeholder="08123456789" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Pilihan Kursus</label>
                            <select name="Kursus" class="form-select" required>
                                <option value="" selected disabled>-- Pilih Program Kursus --</option>
                                <optgroup label="Komputer Kelas 1">
                                    <option value="Komputer Kls 1 (8 x P)">8 x Pertemuan</option>
                                    <option value="Komputer Kls 1 (12 x P)">12 x Pertemuan</option>
                                </optgroup>
                                <optgroup label="Komputer Kelas 2">
                                    <option value="Komputer Kls 2 (8 x P)">8 x Pertemuan</option>
                                    <option value="Komputer Kls 2 (12 x P)">12 x Pertemuan</option>
                                </optgroup>
                                <optgroup label="Komputer Kelas 3">
                                    <option value="Komputer Kls 3 (8 x P)">8 x Pertemuan</option>
                                    <option value="Komputer Kls 3 (12 x P)">12 x Pertemuan</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Alamat Domisili</label>
                            <textarea name="Alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
                        </div>

                        <input type="hidden" name="Setatus" value="Masih Proses">

                        <div class="col-12 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="reset" class="btn btn-outline-secondary px-4">Reset</button>
                                <button type="submit" name="save_student" class="btn btn-primary px-5">
                                    Daftar Sekarang <i class="bi bi-send-fill ms-2"></i>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            
            <p class="text-center mt-4 text-muted small">
                &copy; <?php echo date('Y'); ?> Sistem Informasi Kursus. All rights reserved.
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>