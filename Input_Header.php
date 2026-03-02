<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Mari Belajar - Pengaturan Header</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f7f6; /* Senada dengan dashboard sebelumnya */
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding-bottom: 50px;
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

        .header-card-title {
            font-weight: 700;
            font-size: 1.1rem;
            color: #2d3436;
            margin-bottom: 20px;
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 10px;
        }

        /* Preview Image */
        .preview-img-container {
            background: #f8f9fa;
            border: 2px dashed #ddd;
            border-radius: 12px;
            padding: 15px;
            margin-top: 15px;
        }

        #preview {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }

        /* Input Styling */
        .file {
            visibility: hidden;
            position: absolute;
        }

        .btn-success-custom {
            background-color: #0a8314;
            border: none;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-success-custom:hover {
            background-color: #086910;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 131, 20, 0.3);
        }

        /* Table Styling */
        .table-container {
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead th {
            background-color: #343a40;
            color: white;
            border: none;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
            padding: 15px;
        }

        .img-table {
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            max-height: 60px;
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
    <h2 class="font-weight-bold">Pengaturan Header</h2>
    <p class="opacity-75">Sesuaikan tampilan gambar header utama website Anda</p>
</div>

<div class="container">
    <?php
    $kon = mysqli_connect("localhost", "root", "", "db_user");
    if (!$kon) { die("Koneksi gagal: " . mysqli_connect_error()); }

    if (isset($_GET['add'])) {
        $type = ($_GET['add'] == 'berhasil') ? 'success' : 'danger';
        $icon = ($_GET['add'] == 'berhasil') ? '✨' : '❌';
        $msg = ($_GET['add'] == 'berhasil') ? 'Gambar header berhasil diperbarui!' : 'Gagal mengupload gambar header.';
        echo "<div class='alert alert-$type alert-dismissible fade show text-center' role='alert'>
                $icon <strong>Info!</strong> $msg
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
              </div>";
    }
    ?>

    <div class="row">
        <div class="col-lg-4">
            <div class="custom-card">
                <h5 class="header-card-title">Upload Header</h5>
                <form action="simpan3.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="file" name="gambar" class="file" id="inputGambar">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" disabled placeholder="Pilih file..." id="fileNameDisplay" style="border-radius: 8px 0 0 8px;">
                            <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="btn btn-dark" style="border-radius: 0 8px 8px 0;">Cari</button>
                            </div>
                        </div>
                        
                        <div class="preview-img-container text-center">
                            <small class="text-muted d-block mb-2">Pratinjau:</small>
                            <img src="gambar/80x80.png" id="preview" alt="Preview">
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" name="btn_simpan" class="btn btn-success-custom btn-block py-2 text-white">Simpan Header</button>
                        <a href="Dashboard.php" class="btn btn-light btn-block mt-2 text-muted" style="border-radius: 8px;">Kembali</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="custom-card p-0 overflow-hidden">
                <div class="p-4 bg-light border-bottom">
                    <h5 class="font-weight-bold m-0" style="font-size: 1rem;">Header Terpasang</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="text-center">
                            <tr>
                                <th width="10%">No</th>
                                <th width="65%">Preview</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $sql = "SELECT * FROM tb_header ORDER BY id_gambar DESC";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            while ($data = mysqli_fetch_array($hasil)):
                                $no++;
                            ?>
                            <tr>
                                <td class="align-middle font-weight-bold text-muted"><?php echo $no; ?></td>
                                <td class="align-middle">
                                    <img src="gambar/<?php echo $data['gambar'];?>" class="img-table" alt="Header">
                                </td>
                                <td class="align-middle">
                                    <a href="hapus3.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" 
                                       class="btn btn-outline-danger btn-sm px-3" 
                                       style="border-radius: 20px;"
                                       onclick="return confirm('Hapus gambar header ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                            <?php if ($no == 0): ?>
                            <tr>
                                <td colspan="3" class="p-5 text-muted">Belum ada header yang diupload.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Trigger klik input file
    $(document).on("click", "#pilih_gambar", function() {
        $("#inputGambar").trigger("click");
    });

    // Preview Gambar
    $('#inputGambar').change(function(e) {
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            $("#fileNameDisplay").val(fileName);

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("preview").src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

</body>
</html>