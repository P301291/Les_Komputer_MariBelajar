<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <title>www.Mari Belajar.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <style>
        /* CSS Tambahan untuk Merapikan */
        body {
            background-color:rgb(10, 131, 20);
        }
        .container {
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .preview-img {
            max-width: 200px;
            margin-top: 10px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        /* Memperbaiki Scroll Tabel agar tidak merusak layout */
        .table-container {
            overflow-x: auto;
            width: 100%;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .file {
            visibility: hidden;
            position: absolute;
        }
        h2,p{color:white;}
    </style>
</head>
<body>
<div class="container">
    <div class="text-center mb-4">
        <h2>Panel Pengelolaan Gambar</h2>
    </div>
    <?php
    // Koneksi Database (Gunakan mysqli agar konsisten)
    $kon = mysqli_connect("localhost", "root", "", "db_user");
    if (!$kon) { die("Koneksi Gagal: " . mysqli_connect_error()); }

    // Notifikasi (Alert)
    if (isset($_GET['add'])) {
        $msgClass = ($_GET['add'] == 'berhasil') ? 'alert-success' : 'alert-danger';
        $msgText = ($_GET['add'] == 'berhasil') ? 'Berhasil! Gambar telah diupload.' : 'Gagal! Gambar gagal diupload.';
        echo "<div class='alert $msgClass text-center'>$msgText</div>";
    }
    ?>

    <div class="row justify-content-center mb-5">
        <div class="col-md-6 border p-4 bg-white shadow-sm rounded">
            <form action="simpan1.php" method="post" enctype="multipart/form-data">
                <div class="form-group text-center">
                    <input type="file" name="gambar" class="file">
                    <div class="input-group my-3">
                        <input type="text" class="form-control" disabled placeholder="Pilih file..." id="file">
                        <div class="input-group-append">
                            <button type="button" id="pilih_gambar" class="browse btn btn-dark">Cari...</button>
                        </div>
                    </div>
                    <img src="https://via.placeholder.com/150" id="preview" class="img-thumbnail preview-img">
                </div>
                <div class="text-center">
                    <button type="submit" name="btn_simpan" class="btn btn-primary px-4">Simpan Gambar</button>
                    <a href="Dashboard.php" class="btn btn-secondary px-4">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="table-container">
                <h4 class="mb-3">Daftar Gambar Terupload</h4>
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="70%">Pratinjau Gambar</th>
                            <th width="25%">Aksi</th>
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
                            <td class="text-center align-middle"><?php echo $no; ?></td>
                            <td class="text-center">
                                <img src="gambar/<?php echo $data['gambar'];?>" class="rounded" style="max-height: 100px;" alt="Image">
                            </td>
                            <td class="text-center align-middle">
                                <a href="hapus1.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Script Pilih Gambar
    $(document).on("click", "#pilih_gambar", function() {
        $(".file").trigger("click");
    });

    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>

</body>
</html>