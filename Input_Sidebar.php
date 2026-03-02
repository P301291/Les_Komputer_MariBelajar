<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>www.Mari Belajar.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <style>
        body {
            background-color: #f4f7f6; /* Warna background lebih soft */
            font-family: 'Inter', sans-serif;
        }
        
        /* Header Banner Style */
        .page-header {
            background: linear-gradient(135deg, #0a8314, #14a41f);
            padding: 40px 0;
            color: white;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            margin-bottom: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .container {
            margin-top: -20px;
        }

        /* Card Style */
        .custom-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            padding: 25px;
            margin-bottom: 30px;
        }

        .preview-img {
            max-width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-top: 15px;
            border: 2px dashed #ddd;
        }

        /* Input Styling */
        .file {
            visibility: hidden;
            position: absolute;
        }

        .btn-upload {
            background-color: #0a8314;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-upload:hover {
            background-color: #086910;
            transform: translateY(-2px);
        }

        /* Table Styling */
        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
            border: none;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
        }

        .table td {
            vertical-align: middle !important;
        }

        .img-table {
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .img-table:hover {
            transform: scale(1.1);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="page-header text-center">
    <h2 class="font-weight-bold">Panel Pengelolaan Gambar</h2>
    <p class="opacity-75">Upload dan atur gambar untuk sidebar website Anda</p>
</div>

<div class="container">
    <?php
    $kon = mysqli_connect("localhost", "root", "", "db_user");
    if (!$kon) { die("Koneksi Gagal: " . mysqli_connect_error()); }

    if (isset($_GET['add'])) {
        $msgClass = ($_GET['add'] == 'berhasil') ? 'alert-success' : 'alert-danger';
        $msgText = ($_GET['add'] == 'berhasil') ? '✨ <strong>Berhasil!</strong> Gambar telah diupload ke server.' : '❌ <strong>Gagal!</strong> Periksa kembali format file Anda.';
        echo "<div class='alert $msgClass alert-dismissible fade show text-center' role='alert'>
                $msgText
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
              </div>";
    }
    ?>

    <div class="row">
        <div class="col-lg-4">
            <div class="custom-card">
                <h5 class="font-weight-bold mb-4">Upload Baru</h5>
                <form action="simpan1.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="gambar" class="file">
                        <div class="input-group">
                            <input type="text" class="form-control" disabled placeholder="Pilih file..." id="file" style="border-radius: 8px 0 0 8px;">
                            <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="browse btn btn-dark" style="border-radius: 0 8px 8px 0;">Cari...</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <img src="https://via.placeholder.com/300x150?text=Pratinjau+Gambar" id="preview" class="preview-img">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" name="btn_simpan" class="btn btn-upload btn-primary btn-block py-2">Simpan Gambar</button>
                        <a href="Dashboard.php" class="btn btn-light btn-block mt-2 text-muted">Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="custom-card table-responsive p-0">
                <div class="p-4 border-bottom bg-light">
                    <h5 class="font-weight-bold m-0">Daftar Gambar Terupload</h5>
                </div>
                <table class="table table-hover m-0">
                    <thead class="text-center">
                        <tr>
                            <th width="10%">No</th>
                            <th width="60%">Pratinjau Gambar</th>
                            <th width="30%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM tb_sidebar ORDER BY id_gambar DESC";
                        $hasil = mysqli_query($kon, $sql);
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        <tr>
                            <td class="text-center font-weight-bold text-muted"><?php echo $no; ?></td>
                            <td class="text-center">
                                <img src="gambar/<?php echo $data['gambar'];?>" class="img-table" style="max-height: 80px;" alt="Image">
                            </td>
                            <td class="text-center">
                                <a href="hapus1.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" 
                                   class="btn btn-outline-danger btn-sm px-3" 
                                   style="border-radius: 20px;"
                                   onclick="return confirm('Yakin ingin menghapus?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <?php if ($no == 0): ?>
                    <div class="text-center p-5">
                        <p class="text-muted">Belum ada gambar yang diupload.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", "#pilih_gambar", function() {
        $(".file").trigger("click");
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
            $(document.getElementById("preview")).css("border", "none");
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>

</body>
</html>