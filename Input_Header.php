<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>Mari Belajar - Pengaturan Header</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg,rgb(10, 131, 20) 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 50px;
        }
        .main-card {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
        }
        .header-title {
            font-weight: 600;
            color: #2d3436;
            margin-bottom: 25px;
            text-align: center;
        }
        #preview {
            max-height: 200px;
            border-radius: 10px;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .btn-custom {
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .table-container {
            border-radius: 15px;
            overflow: hidden;
        }
        .file { visibility: hidden; position: absolute; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="main-card">
                <h3 class="header-title">Upload Gambar Header</h3>
                
                <?php
                // Perbaikan Koneksi ke mysqli
                $kon = mysqli_connect("localhost", "root", "", "db_user");
                if (!$kon) { die("Koneksi gagal: " . mysqli_connect_error()); }

                // Alert Notifikasi
                if (isset($_GET['add'])) {
                    $type = ($_GET['add'] == 'berhasil') ? 'success' : 'danger';
                    $msg = ($_GET['add'] == 'berhasil') ? 'Gambar telah berhasil diupload!' : 'Gagal mengupload gambar!';
                    echo "<div class='alert alert-$type alert-dismissible fade show' role='alert'>
                            <strong>Info!</strong> $msg
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                          </div>";
                }
                ?>

                <form action="simpan3.php" method="post" enctype="multipart/form-data" class="text-center">
                    <div class="form-group">
                        <input type="file" name="gambar" class="file" id="inputGambar">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" disabled placeholder="Pilih file gambar..." id="fileNameDisplay" style="border-radius: 30px 0 0 30px;">
                            <div class="input-group-append">
                                <button type="button" id="pilih_gambar" class="btn btn-dark" style="border-radius: 0 30px 30px 0;">Cari Gambar</button>
                            </div>
                        </div>
                        <img src="gambar/80x80.png" id="preview" class="img-fluid mx-auto d-block">
                    </div>
                    
                    <div class="mt-4">
                        <button type="submit" name="btn_simpan" class="btn btn-success btn-custom mr-2">Simpan Header</button>
                        <a href="Dashboard.php" class="btn btn-outline-secondary btn-custom">Kembali</a>
                    </div>
                </form>
            </div>

            <div class="main-card">
                <h4 class="header-title">Daftar Gambar Terpasang</h4>
                <div class="table-responsive table-container">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="thead-dark text-center">
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
                                <td class="align-middle"><?php echo $no; ?></td>
                                <td class="align-middle">
                                    <img src="gambar/<?php echo $data['gambar'];?>" class="rounded shadow-sm" style="max-height: 80px; width: auto;">
                                </td>
                                <td class="align-middle">
                                    <a href="hapus3.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" 
                                       class="btn btn-danger btn-sm px-3" 
                                       onclick="return confirm('Anda yakin ingin menghapus gambar ini?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
    // Trigger klik input file rahasia
    $(document).on("click", "#pilih_gambar", function() {
        $("#inputGambar").trigger("click");
    });

    // Preview Gambar & Tampilkan Nama File
    $('#inputGambar').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#fileNameDisplay").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>

</body>
</html>