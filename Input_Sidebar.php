<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gambar | Mari Belajar</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <link rel="stylesheet" href="css/styles1.css">

    <style>
        :root {
            --primary: #4361ee;
            --dark: #1e293b;
            --light-bg: #f8fafc;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
        }

        .home_content {
            padding: 25px 40px;
            transition: var(--transition);
            min-height: 100vh;
        }

        /* Banner */
        .welcome-banner {
            background: linear-gradient(135deg, var(--dark) 0%, #334155 100%);
            padding: 35px; border-radius: 20px; color: white; margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }

        /* Layout Grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
        }

        .info-box {
            background: white; padding: 28px; border-radius: 20px;
            box-shadow: var(--card-shadow);
        }

        /* Form Styling */
        .file { visibility: hidden; position: absolute; }
        .custom-input-group { display: flex; margin-bottom: 15px; }
        .form-control-custom {
            flex: 1; border: 1px solid #e2e8f0; padding: 10px 15px;
            border-radius: 12px 0 0 12px; background: #f8fafc;
        }
        .btn-browse {
            background: var(--dark); color: white; border: none;
            padding: 0 20px; border-radius: 0 12px 12px 0; cursor: pointer;
        }
        .preview-img {
            width: 100%; height: 150px; object-fit: cover;
            border-radius: 15px; margin-top: 15px; border: 2px dashed #cbd5e1;
        }
        .btn-simpan {
            width: 100%; background: linear-gradient(90deg, var(--primary), #4cc9f0);
            color: white; border: none; padding: 12px; border-radius: 12px;
            font-weight: 700; cursor: pointer; margin-top: 15px;
        }

        /* Table Styling */
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .img-thumb { width: 100px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        .btn-hapus {
            background: #fee2e2; color: #dc2626; padding: 6px 12px;
            border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600;
        }

        /* PETUNJUK PENGGUNAAN (Pengganti Footer) */
        .guide-footer {
            margin-top: 50px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            border-left: 5px solid var(--primary);
        }
        .guide-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 20px;
        }
        .guide-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .guide-item {
            display: flex;
            gap: 15px;
        }
        .guide-icon {
            background: #e0e7ff;
            color: var(--primary);
            width: 35px;
            height: 35px;
            min-width: 35px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
        }
        .guide-text h4 { margin: 0 0 5px 0; font-size: 14px; color: var(--dark); }
        .guide-text p { margin: 0; font-size: 12px; color: #64748b; line-height: 1.5; }
        .kontainer-scroll {
   
   overflow-y: scroll; /* Scroll vertikal */

}
    </style>
</head>
<body class="kontainer-scroll">

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <i class='bx bxs-book-open' style="font-size: 26px; color: #4cc9f0;"></i>
                <div class="logo_name" style="margin-left: 10px;">Mari Belajar</div>
            </div>
            <i class='bx bx-menu' id="btn"></i>
        </div>
        <ul class="nav_list">
            <li><a href="Dashboard.php"><i class='bx bxs-grid-alt'></i><span class="links_name">Dashboard</span></a></li>
            <li><a href="Data_Siswa.php"><i class='bx bxs-user-detail'></i><span class="links_name">Data Siswa</span></a></li>
            <li><a href="Ganti_Pas.php"><i class='bx bxs-cog'></i><span class="links_name">Admin</span></a></li>
            <li><a href="logout.php"><i class='bx bxs-log-out' style="color: #ff5e5e;"></i><span class="links_name" style="color: #ff5e5e;">Keluar</span></a></li>
        </ul>
    </div>

    <div class="home_content">
        <div class="welcome-banner">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="background: rgba(255,255,255,0.2); padding: 15px; border-radius: 15px;">
                    <i class='bx bxs-image-add' style="font-size: 35px;"></i>
                </div>
                <div>
                    <h1 style="margin:0; font-size: 26px;">Pengaturan Gambar Informasi</h1>
                    <p style="margin:5px 0 0 0; opacity: 0.8;">Kelola tampilan visual navigasi utama Anda.</p>
                </div>
            </div>
        </div>

        <?php
        $kon = mysqli_connect("localhost", "root", "", "db_user");
        if (isset($_GET['add'])) {
            $msg = ($_GET['add'] == 'berhasil') ? 'Gambar berhasil ditambahkan!' : 'Gagal mengupload gambar.';
            $color = ($_GET['add'] == 'berhasil') ? '#dcfce7' : '#fee2e2';
            echo "<div style='padding:15px; background:$color; border-radius:12px; margin-bottom:20px; text-align:center; font-weight:600;'>$msg</div>";
        }
        ?>

        <div class="info-grid">
            <div class="info-box">
                <h3 style="font-size: 18px; margin-bottom: 20px;">Upload File</h3>
                <form action="simpan1.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="gambar" class="file" id="real-file" accept="image/*">
                    <div class="custom-input-group">
                        <input type="text" class="form-control-custom" placeholder="Belum ada file..." id="file-name" readonly>
                        <button type="button" class="btn-browse" onclick="document.getElementById('real-file').click()">Pilih</button>
                    </div>
                    <img src="https://via.placeholder.com/300x150?text=Pratinjau+Gambar" id="preview" class="preview-img">
                    <button type="submit" name="btn_simpan" class="btn-simpan">Simpan ke Database</button>
                </form>
            </div>

            <div class="info-box">
                <h3 style="font-size: 18px; margin-bottom: 20px;">Galeri Tersimpan</h3>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th>Preview</th>
                                <th width="100px">Tindakan</th>
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
                                <td><?php echo $no; ?></td>
                                <td><img src="gambar/<?php echo $data['gambar'];?>" class="img-thumb"></td>
                                <td>
                                    <a href="hapus1.php?id_gambar=<?php echo $data['id_gambar'];?>&gambar=<?php echo $data['gambar'];?>" 
                                       class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="guide-footer">
            <div class="guide-title">
                <i class='bx bxs-help-circle' style="color: var(--primary); font-size: 24px;"></i>
                <span>Petunjuk Penggunaan Fitur</span>
            </div>
            <div class="guide-grid">
                <div class="guide-item">
                    <div class="guide-icon">1</div>
                    <div class="guide-text">
                        <h4>Pilih Gambar</h4>
                        <p>Klik tombol <b>"Pilih"</b> dan cari file gambar (JPG/PNG) dari komputer Anda.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <div class="guide-icon">2</div>
                    <div class="guide-text">
                        <h4>Cek Pratinjau</h4>
                        <p>Pastikan gambar muncul di kotak pratinjau sebelum menekan tombol simpan.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <div class="guide-icon">3</div>
                    <div class="guide-text">
                        <h4>Simpan Data</h4>
                        <p>Klik <b>"Simpan ke Database"</b> untuk menerapkan perubahan pada sidebar.</p>
                    </div>
                </div>
                <div class="guide-item">
                    <div class="guide-icon">4</div>
                    <div class="guide-text">
                        <h4>Hapus Aset</h4>
                        <p>Gunakan tombol <b>"Hapus"</b> di tabel jika ingin membersihkan gambar lama.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        btn.onclick = function() { sidebar.classList.toggle("active"); }

        document.getElementById('real-file').onchange = function(e) {
            document.getElementById('file-name').value = this.files[0].name;
            let reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('preview').src = event.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        };
    </script>
</body>
</html>