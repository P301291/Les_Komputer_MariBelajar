<?php
// Data Aplikasi yang Dipelajari (bisa dipindahkan ke database nantinya)
$apps = [
    [
        "nama" => "Design Grafis",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "🌍",
        "teknologi" => ["CorelDRAW", "Affinity", "Photoshop"]
    ],
    [
        "nama" => "UI/UX Design",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "👤",
        "teknologi" => ["Figma", "Canva"]
    ],
    [
        "nama" => "Microsoft Office",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "🚀",
        "teknologi" => ["Ms. Word", "Ms. Excel", "Ms. Power Point","Rumus Excel"]
    ],
    [
        "nama" => "Web Developer",
        "deskripsi" => "Teknologi yang akan dipelajari..",
        "icon" => "🖥️",
        "teknologi" => ["HTML","CSS","JavaScript","PHP","Bootstrap","MySQL"]
    ],
    [
        "nama" => "Dekstop Developer",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "💻",
        "teknologi" => ["Visual Basic","VB.Net", "MySQL"]
    ],
    [
        "nama" => "Editor Video",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "🎬",
        "teknologi" => ["Capcut","Adobe Premier Pro"]
    ],
    [
        "nama" => "Cloud Computing",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "📚",
        "teknologi" => ["Google Drive", "TeraBox"]
    ],
    [
        "nama" => "Website Builder",
        "deskripsi" => "Teknologi yang akan dipelajari.",
        "icon" => "📝",
        "teknologi" => ["Blogspot", "WordPress"]
    ]
  
];
?>
<?php
// Nama file untuk menyimpan jumlah pengunjung
$file_counter = 'counter1.txt';

// Baca nilai saat ini dari file
$counter = file_get_contents($file_counter);

// Tambah 1 ke hitungan jika file berhasil dibaca
if ($counter !== false) {
    $counter++;
    // Simpan kembali nilai baru ke file
    file_put_contents($file_counter, $counter);
} else {
    // Jika file tidak bisa dibaca, inisialisasi dengan 1
    $counter = 1;
    file_put_contents($file_counter, $counter);
}
?>

<!DOCTYPE html> <!--Sudah pakai HTML 5-->
<html lang="id">
    <head>
    <title>Mari Belajar Komputer</title>
	<?php
	include 'koneksi.php';
	?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no"><!--Code Responsipe-->
    
        <link rel="stylesheet" href="css/style_beranda.css"><!--CSS Eksternal-->
        <link rel="stylesheet" href="css/style_login.css"><!--CSS Eksternal-->
        
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css'><!--css Media sosial-->
      
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">  <!-- css whatsapp -->
    <style>
 .counter-box { border: 1px solid #ccc; padding: 4px; display: inline-block; border-radius: 5px;color:white; height:50px; }

        .container {
            max-width: 100%;
            margin: 0 auto;
        }

     
        .app-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px 0;
        }

        .app-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(71, 71, 71, 0.1);
            transition: transform 0.2s;
            border-right: 5px solid green;
            border-left: 5px solid green;
            border-bottom: 2px solid #5ddd21;
            border-top: 2px solid #5ddd21;

border-top: 2px solidrgb(85, 150, 12);
        }

        .app-card:hover {
            transform: translateY(-5px);
        }

        .app-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .app-name {
            font-size: 1.25rem;
            color:rgb(2, 4, 7);
            margin: 0 0 10px 0;
        }

        .app-desc {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            height: 45px; /* Mengatur tinggi konstan */
            overflow: hidden;
        }

        .tech-tag {
            background-color:rgb(228, 236, 243);
            color:rgb(11, 12, 1);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            margin-right: 5px;
            display: inline-block;
            margin-bottom: 5px;
        }
    </style>
     <style>
        

.container {
    margin:20px;
    padding: 4px;
  
    
}
.Tombol {
    
    padding: 10px 20px;
    font-size: 16px;
    background-color:rgb(5, 133, 26);
    color: white;
    border: none;
    border-radius: 5px;
    transition: 0.3s;
}
.Tombol:hover{transform: scale(1.1);
               Background:blue;}
               
button#open-popup-btn {
    
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color:rgb(19, 6, 133);
    color: white;
    border: none;
    border-radius: 5px;
    transition: 0.3s;
}
button#open-popup-btn:hover{transform: scale(1.1);
    Background:maroon;}
/* Gaya Pop-up Modal */
.popup-modal {
    display: none; /* Sembunyikan secara default */
    position: fixed; /* Tetap di posisi yang sama */
    z-index: 120; /* Di atas konten lain */
    left: 0;
    top: 0;
    width: 45%;
    justify-content: center;
    align-items: center;
}

.popup-content {
   
    margin: 4% auto; /* 15% dari atas dan tengah */
    z-index: 5; /* Di atas konten lain */
    padding: 9px;
    border: 0px solid #888;
    width: 80%; /* Lebar pop-up */
    max-width: 600px; /* Lebar maksimum */
    position: relative;
    border-radius: 5px;
    color:white;
    
}

.close-btn {
    color: white;
    float: right;
    font-size: 30px;
    font-weight: bold;
    cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
    color: white;
    text-decoration: none;
    cursor: pointer;
}

/* Gaya Formulir */
form {
    display: flex;
    flex-direction: column;
}

label {
    margin-top: 10px;
    text-align: left;
}

input, select, form button {
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

form button {
    margin-top: 20px;
    background-color:rgb(24, 8, 114);
    color: white;
    border: none;
    cursor: pointer;
}

#response-message {
    margin-top: 15px;
    padding: 10px;
    border-radius: 5px;
}

        </style>
        <!--CSS UJi Coba-->
        <style>
/* Gaya dasar */


/* Gaya untuk tombol */
#open-button {
   
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    background-color:rgb(19, 6, 133);
    color: white;
    border: none;
    float:right;
    border-radius: 5px;
    transition: 0.3s;
}

button#open-button:hover{transform: scale(1.1);
    Background:maroon;}

/* Gaya untuk pop-up modal */
.popup {
    display: none; /* Sembunyikan popup secara default */
    position: fixed; /* Tetap di tempatnya saat di-scroll */
    z-index: 120; /* Tampilkan di atas elemen lain */
    left: 0;
    top: 0;
    width: 100%;
    height: 90%;
    overflow: auto; /* Aktifkan scroll jika konten terlalu panjang */
 
}

/* Gaya untuk konten pop-up */
.popup-con {
    border-bottom: 2px solid #5ddd21;
  box-shadow: 1px 2px #5ddd21 ;
  border-top: 2px solidrgb(241, 211, 37);
    background-color:#18b313;
    z-index: 5; /* Di atas konten lain */
    margin: 5% auto; /* 15% dari atas dan tengah */
    padding: 10px;
    border: 0px solid #888;
    width: 80%; /* Lebar pop-up */
    max-width: 500px; /* Lebar maksimum */
    position: relative;
    border-radius: 5px;
    color:white;
}

/* Gaya untuk tombol tutup (X) */
.close-button {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close-button:hover,
.close-button:focus {
    color: white;
    text-decoration: none;
}

.btndaftar {
    background-color: #1916c2;
    border: #F0F0F0 1px solid;
    padding: 2px 5px;
    color: #FFF;
    text-decoration: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    float:left;
    border-radius: 5px;
    transition: 0.3s;
}/*ini css untuk tombol daftar unggulan*/

.container23 {
            text-align: center;
            background: #222;
            padding: 6px 6px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.2), 0 0 40px rgba(0, 255, 255, 0.1);
            border: 2px solid #333;
        }

        .jam-digital {
            font-size: 1rem;
            font-weight: bold;
            color: #0ff;
            text-shadow: 0 0 10px #0ff, 0 0 20px #0ff, 0 0 30px #0ff;
            letter-spacing: 5px;
        }

        .tanggal {
            font-size: 1.2rem;
            color: #aaa;
            margin-top: 10px;
            letter-spacing: 2px;
        }

            </style>
</head>
<body>

 <!--wrapper Pembungkus kerangka website-->
<div class="wrapper">
 
<div class="header"><!--bagian kepala website-->
    <nav id='menu'><!--Menu Drop Down-->
<input type='checkbox'/> 
<label>&#8801;<span>Mari&#160;Belajar&#160;Karawang</span>
</label>
<ul>
<li><a href='Beranda.php'>Home</a></li>
<li><a href='portofolio.php'>Portofolio Pengajar</a></li>
<li><a href='#bagian-keuntungan'>Manfaat Belajar Teknologi</a></li>
<li><a href='#bagian-daftar'>Daftar</a></li>
<!-- <li><a href=''>Kegiatan Belajar</a></li>-->
<li><a>Tentang Mari Belajar</a>
<ul class='menus'>
<li><a href='#bagian-bawah'>Sejarah Singkat</a></li>
<li><a href='#bagian-footer4'>Visi & Misi</a></li>
<li><a href='https://www.google.com/maps/place/Mari+Belajar/@-6.1576294,107.4902235,153m/data=!3m1!1e3!4m14!1m7!3m6!1s0x2e6963e0d972c391:0x5c4e8c4c1fb0e1dc!2sMari+Belajar!8m2!3d-6.1576987!4d107.4908498!16s%2Fg%2F11kbcyph19!3m5!1s0x2e6963e0d972c391:0x5c4e8c4c1fb0e1dc!8m2!3d-6.1576987!4d107.4908498!16s%2Fg%2F11kbcyph19!5m1!1e4?hl=en-US&entry=ttu&g_ep=EgoyMDI1MTExNy4wIKXMDSoASAFQAw%3D%3D'>Lokasi Mari Belajar</a></li>
</ul>
</li>
<li><a href='desain_grafis.php'>E-Learning</a></li>
<li><a href='Login.php'>Login</a></li>
       </ul>
       
       
    </nav><!--bagian Akhir Menu Drop Down-->
 
</div><!--div header-->
<div class="content"><!--bagian isi website-->
<!--Percobaan-->  
<?php
	include "koneksi1.php";

	//membaca kode barang terbesar
	$sql = "SELECT max(id) FROM toy";
	$query = mysql_query($sql) or die (mysql_error());

	$id = mysql_fetch_array($query);

	if($id){
		$nilai = substr($id[0], 1);
		$kode = (int) $nilai;

		//tambahkan sebanyak + 1
		$kode = $kode + 1;
		$auto_kode = "1" .str_pad($kode, 3, "0",  STR_PAD_LEFT);
	} else {
		$auto_kode = "10";
	}

?>
<script>
function validate() {
	var valid = true;	
	$(".demoInputBox").css('background-color','');
	$(".info").html('');
	
	if(!$("#name").val()) {
		$("#name-info").html("(required)");
		$("#name").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#code").val()) {
		$("#code-info").html("(required)");
		$("#code").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#category").val()) {
		$("#category-info").html("(required)");
		$("#category").css('background-color','#FFFFDF');
		valid = false;
	}
	if(!$("#pay").val()) {
		$("#pay-info").html("(required)");
		$("#pay").css('background-color','#FFFFDF');
		valid = false;
	}	
	if(!$("#Date").val()) {
		$("#Date-info").html("(required)");
		$("#Date").css('background-color','#FFFFDF');
		valid = false;
	}	
	return valid;
}
$carikode = mysqli_query($connect,"select max(id) from toy") or die (mysql_error());
 
$tanggal= $_POST['Date'];
$gantiformat=date('m-d-y', strtotime($tanggal));  
</script>

<?php
// koneksi ke mysqli
$servername = "localhost";
$username = "root";
$password = "";
$db = "db_user";
$sub="";
// Create connection
$koneksi = mysqli_connect($servername, $username, $password,$db);
// Check connection
if (!$koneksi) {
 die("Connection failed: " . mysqli_connect_error());
}
// membaca kode barang terbesar
$query = "SELECT max(id) as id FROM toy";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$kode = $data['id'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($kode, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "1";
$newID = $char . sprintf("%03s", $noUrut);

//Memasukkan data textbox ke database
if($sub){
 $kode = $_POST['id'];

 

 $query2 = "INSERT INTO toy VALUES ('$kode')";
 $hasil2 = mysqli_query($koneksi, $query2);

 if ($hasil2) {  
  header("Location: Data_siswa.php");
  echo "Berhasil";
  exit();
 }else{
  echo "gagal";
 }
}

?>

<!--Percobaan Akhir-->
<div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" width='100%'cellspacing="0">
                        <thead>
                            
                              
                                <dd width='200%' height='20px'>
                              
                           
                        </thead>

                        <tbody>
                        	
                        <?php
                            // include database
                            include 'database.php';
                            // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                            $sql="select * from tb_header order by id_gambar desc";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        
                            	
                            <img src="gambar/<?php echo $data['gambar'];?>" class="rounded" width='100%' alt="Cinque Terre">    
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>

                        </tbody>
                    </table>
   
                </div>
                 </div>
                 
</div>

    <script src="script.js"></script>
    
</div> 
<section id="bagian-daftar">
<div class="menu-card">
  <div class="menu-header">
  <div class="container23">
        <!-- Tampilan jam real-time -->
        <div class="jam-digital" id="jam">00:00:00</div>
        
        <!-- Tanggal PHP (Statis saat dimuat) -->
        <div class="tanggal">
            <?php 
                echo date('l, d F Y');
            ?>
        </div>
    </div>
           <br>
              <!-- Tombol untuk membuka popup -->
    <button id="open-button">Informasi Penting</button>

<!-- Elemen pop-up -->
<div id="myPopup" class="popup">
    <div class="popup-con">
        <span class="close-button" id="close-popup-button">&times;</span>
        <h2>Info Penting</h2>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered" width='90%'height='20%' cellspacing="10">
                        <thead>
                            
                              
                             
                              
                           
                        </thead>

                        <tbody>
                        	
                        <?php
                            // include database
                            include 'database.php';
                            // perintah sql untuk menampilkan daftar bank yang berelasi dengan tabel kategori bank
                            $sql="select * from tb_sidebar order by id_gambar desc";
                            $hasil=mysqli_query($kon,$sql);
                            $no=0;
                            //Menampilkan data dengan perulangan while
                            while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                        ?>
                        
                            	
                            <img src="gambar/<?php echo $data['gambar'];?>" class="rounded" width='100%'height='620%'alt="Cinque Terre">    
                        <!-- bagian akhir (penutup) while -->
                        <?php endwhile; ?>

                        </tbody>
                    </table>
      </div>              
                </div>
   </div>     
    </div>
</div>
<!--Ujicoba akhir> -->           
<br>
<p style="text-align: left;">Pilihan Terbaik Untuk Anda</p>
        </div>
        <div class="menu-body">
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 1 (8 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">Dasar-Dasar Komputer, Microsoft Office, Internet.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 200.000</button>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 1 (12 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">Dasar-Dasar Komputer, Microsoft Office, Internet.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 250.000</button>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 2 (8 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">UI/UX Design, Desain Grafis, Editing Video.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 250.000</button>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 2 (12 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">UI/UX Design, Desain Grafis, Editing Video.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 300.000</button>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 3 (8 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">Pengembangan Aplikasi Web, Aplikasi Desktop, VBA Excel.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 300.000</button>
                </div>
            </div>
            <div class="menu-item">
                <div class="item-details">
                    <h3>Kelas 3 (12 x Pertemuan Dalam 1 Bulan)</h3>
                    <p style="text-align: left;">Pengembangan Aplikasi Web, Aplikasi Desktop, VBA Excel.</p>
                </div>
                <div class="item-price">
                    <button class="Tombol">Rp 350.000</button>
                    
                </div>              
            </div>               
</div>
    </div>
      </section>
    </section>
    </section>
    <div class="container">
        <p>Silahkan Daftar</p>
        <!-- Tombol untuk membuka pop-up -->
        <button id="open-popup-btn">Daftar Sekarang</button>
    </div>

    <!-- Struktur Pop-up Modal -->
    <div id="registration-popup" class="popup-modal">
        <div class="popup-content">
            
            <fieldset>
            <span class="close-btn">&times;</span>
            <br>
            <center><h2>Form Pendaftaran Les Komputer</h2></center>
                        <form action="code_student.php" method="POST">
                        <div class="mb-3">
                                <label></label>
                            <input type="text" name="id" value="<?php echo $auto_kode;?> " class="form-control"readonly >
                            </div>
                            <div class="mb-3">
                                <label></label>
                                <input type="text" name="Nama" class="form-control" placeholder="masukan nama lengkap"required>
                            </div>
                            <div class="mb-3">
                            <label></label>
                                <Select id="Jenis_Kelamin" name="Jenis_Kelamin" class="form-control" required>
                                <option value="">--Jenis Kelamin--</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
</select>

                            <label></label>
                                <Select id="Kursus" name="Kursus" class="form-control" required>
                                <option value="">--Pilih Kursus--</option>
                                    <option value="Komputer Kls 1 (8 x P)">Komputer Kelas 1  (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 1 (12 x P)">Komputer Kelas 1 (12 x Pertemuan)</option>
                                    <option value="Komputer Kls 2 (8 x P)"> Komputer Kelas 2 (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 2 (12 x P)">Komputer Kelas 2 (12 x Pertemuan)</option>
                                    <option value="Komputer Kls 3 (8 x P)">Komputer Kelas 3  (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 3 (12 x P)">Komputer Kelas 3 (12 x Pertemuan)</option>
</select>
                          
                            <div class="mb-3">
                                <label></label>
                              
                                <input type="text" name="Alamat" class="form-control"placeholder="masukan alamat"required>
                            </div>
                            <div class="mb-3">
                                <label></label>
                                <input type="text" name="Date" class="form-control" value='<?php 
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
echo date('d/m/Y/l'); //kombinasi jam dan tanggal
?>'readonly required class="demoInputBox">
                            </div>
                            <div class="mb-3">
                                <label></label>
                                <input type="text" name="No_Hp" class="form-control"placeholder="masukan No WA"required>
                            </div>
                            <div class="mb-3">
                                <button  type="submit"name="save_student"  class="btn btn-primary">Daftar</button>
                                <button type="reset" name="save_student" class="btn btn-primary">Reset</button>
                            </div>
                            

                        </form>
            <div id="response-message"></div>
        </div>
    </div>
</fieldset>

    <section class="main">
      <div class="main-top">
        
      
      </div>

          </div> 
     
    </section>
 
    </section><!--Bagian Akhir Menu Les Komputer-->


             
 <!--WhatsApp icon -->
<a href="https://wa.me/6285776821436"
        class="whatsapp_float"
        target="_blank"
        rel="noopener noreferrer">
        <i class="fa fa-whatsapp whatsapp-icon"></i>
      </a>
      <!--Bagian Akhir Whatsapp icon-->
</div><!--div content-->
<div class="footer"><!--bagian kaki websie-->

    <br>
    <!--Video--> <div id="video" Class="video"><iframe width="370" height="215" src="https://www.youtube.com/embed/fiuhu924--M?si=eC_k5DVhNTXhuUY2" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe></div><!--Akhir Video-->
<section id="bagian-keuntungan">


 <!--
 <div class="wrapper">

  <h3><b>Ikuti Kami</b><h3>
  <a href="https://www.facebook.com/share/1JvsCEWUfb/" class="icon facebook">
    <div class="tooltip">Facebook</div>
    <span><i class="fab fa-facebook-f"></i></span>
  </a>
  <a href="#" class="icon twitter">
    <div class="tooltip">Twitter</div>
    <span><i class="fab fa-twitter"></i></span>
  </a>
  <a href="https://www.instagram.com/candra301291?utm_source=qr&igsh=MXJ5ZzRiajNxZzMzMA==" class="icon instagram">
    <div class="tooltip">Instagram</div>
    <span><i class="fab fa-instagram"></i></span>
  </a>
  <a href="#" class="icon github">
    <div class="tooltip">Github</div>
    <span><i class="fab fa-github"></i></span>
  </a>
  <a href="#" class="icon youtube">
    <div class="tooltip">Youtube</div>
    <span><i class="fab fa-youtube"></i></span>
  </a>
</div>-->
<br>
<p style="text-align: left;"><b>BELAJAR TEKNOLOGI UNTUK KEBUTUHAN SEHARI-HARI</b></p>
        <p>Belajar teknologi menawarkan segudang keuntungan yang dapat mengubah hidup secara signifikan. Berikut adalah kata-kata panjang mengenai keuntungan belajar teknologi:
"Menguasai teknologi di era digital ini bukan lagi sebuah pilihan, melainkan sebuah keharusan. Keuntungan belajar teknologi sangatlah luas dan mendalam, meresap ke dalam setiap aspek kehidupan pribadi dan profesional kita.
Pertama, akses terhadap informasi menjadi tanpa batas. Dahulu, pengetahuan terkurung dalam perpustakaan fisik atau dibatasi oleh lokasi geografis. Kini, dengan menguasai teknologi, kita dapat mengakses jutaan sumber belajar, e-book, jurnal ilmiah, dan kursus daring dari seluruh dunia, kapan saja dan di mana saja. Ini membuka pintu menuju pembelajaran seumur hidup yang dipersonalisasi dan fleksibel.
Kedua, komunikasi menjadi lebih mudah dan efisien. Batasan jarak dan waktu seolah sirna. Kita dapat terhubung dengan keluarga, teman, atau rekan kerja di belahan dunia lain secara real-time melalui berbagai platform komunikasi, kolaborasi tim menjadi lebih lancar, dan bisnis dapat berinteraksi dengan pelanggan mereka dengan lebih efektif.
Ketiga, produktivitas dan efisiensi meningkat drastis. Proses manual yang memakan waktu kini dapat diotomatisasi atau diselesaikan dengan cepat berkat perangkat lunak dan sistem digital. Baik dalam pekerjaan, pendidikan, atau tugas sehari-hari, teknologi membantu kita mencapai lebih banyak hal dalam waktu yang lebih singkat, menghemat tenaga dan biaya.
Keempat, prospek karir menjadi lebih cerah. Di pasar kerja yang semakin kompetitif, keterampilan teknologi adalah aset berharga. Menguasai teknologi tidak hanya membantu kita beradaptasi dengan tuntutan pekerjaan saat ini, tetapi juga membuka peluang untuk peran baru yang muncul seiring inovasi teknologi, seperti di bidang kecerdasan buatan (AI) atau analisis data.
Singkatnya, belajar teknologi adalah investasi untuk masa depan. Ini memberdayakan kita untuk menjalani hidup yang lebih terinformasi, terhubung, produktif, dan siap menghadapi tantangan zaman yang terus berubah. Dengan teknologi, kita dapat meningkatkan efisiensi dalam bekerja dan mengatasi masalah kompleks.Mempelajari teknologi berarti mempersiapkan diri untuk masa depan yang lebih maju dan modern. Memahami teknologi adalah cara terbaik untuk tetap relevan dalam persaingan global. Teknologi membantu kita menyampaikan informasi dengan cepat, tepat, dan berkualitas. Literasi digital: keterampilan penting untuk berkomunikasi dan berkolaborasi di era global.</p>

        </section>
        <section id="bagian-bawah"><!--Link section 1 halaman-->
       <P><b>MOTIVASI BELAJAR TEKNOLOGI</b></P>
        <p>Teknologi adalah masa depan, tapi manusialah kuncinya. Belajarlah untuk beradaptasi dan berinovasi, karena dalam dunia digital yang selalu berubah, kemampuan untuk terus belajar dan berpikir kritis adalah modal utama. Jangan takut pada teknologi; gunakanlah sebagai alat untuk menciptakan solusi, memperluas wawasan, dan menggapai tujuan yang lebih besar, dengan pemahaman bahwa inovasi membedakan antara pemimpin dan pengikut. </p>
        <br>
        <br>
        <br>
        <br>
        <br>
     
      </section><!--Link section 1 halaman bagian akhir-->
      
    </div><!--div footer-->
    <div class="footer_Tambah">
      <br>
      <div class="left">
<img src="gambar/mb21.png" width="216" height="210">
</div> 
    <section id="bagian-bawah"><!--Link section 1 halaman-->
    <p style="text-align: left;"><b>SEJARAH SINGKAT MARI BELAJAR</b></p>
    <p style="text-align: justyify;">Mari belajar adalah sebuah usaha les komputer yang didirikan pada tanggal 14 Agustus 2023. Usaha ini berawal dari keprihatinan saya melihat banyak orang yang masih kesulitan mengoperasikan komputer, padahal di era digital seperti sekarang, kemampuan ini sangatlah penting. Mari belajar berkomitmen untuk terus menjadi mitra terpercaya bagi siapa pun yang ingin menguasai teknologi komputer. Kami yakin, dengan belajar bersama Mari belajar, Anda akan menjadi pribadi yang lebih kompeten dan siap menghadapi tantangan di era digital. Mari Belajar lahir dari sebuah mimpi sederhana: menjadikan teknologi komputer bisa diakses oleh semua orang. Pada pertengahan tahun 2023, kami melihat betapa pentingnya penguasaan komputer di era digital ini, namun banyak yang masih merasa kesulitan atau bahkan takut untuk memulainya. </p>
        <P>Teknologi sebagai alat, bukan tujuan akhir: Ingatlah bahwa teknologi hanyalah sebuah alat yang diciptakan untuk mempermudah dan mempercepat pekerjaan manusia. Jangan pernah menganggap teknologi lebih tinggi dari tujuan utama Anda. Belajar teknologi adalah cara untuk menguasai alat ini demi mencapai tujuan yang telah ditetapkan.</P>
       
      </section><!--Link section 1 halaman bagian akhir-->
      <br>
    
    
    
    <div class="footer4"><!--Footer4-->
    
    <section id="bagian-footer4">
     
<br>
<br>

<h3><b><p>Visi & Misi Mari Belajar</p></b></h3>  
<p>VISI</p>
<p>"Visi Lembaga Kursus Mari Belajar adalah ingin melahirkan Sumber Daya Manusia (SDM) yang kompeten di bidang IT"</p>
<p> MISI</p>
<ol type="1">
    <li>Memberantas sikap dan prilaku gaptek (gagap teknologi)</li>
    &nbsp;
    <li>Memberikan pengetahuan untuk para peserta kursus tentang ilmu IT</li>
    &ensp;
    <li>Membekali peserta kursus dalam menghadapi persaingan dunia kerja</li>
    &emsp;
    <li>Memberika strategi dalam menggunakan teknologi komunikasi dan informasi</li>
</ol>
<br>
<br>
<br>
<br>
<br>
<br>


        
    </section>
        </div><!--div penutup Footer 4-->
        <div class="footer2">
          
    <div id="googleMap" style="width:100%;height:380px;" ></div>
        </div>
    </div> <!-- div footer2 -->  
       <!-- <div class="footer3">
          
      <br>
      <div class="contact-card">
        <div class="contact-header">
            <h2>Kontak Person</h2>
        </div>
        <div class="contact-info">
            <div class="info-item">
                <i class="fas fa-user icon"></i>
                <span>Candra Argadinata, S.Kom.</span>
            </div>
            <div class="info-item">
                <i class="fas fa-phone icon"></i>
                <span>Telepon: <a >085776821436</a></span>
            </div>
            <div class="info-item">
                <i class="fas fa-envelope icon"></i>
                <span>Email: <a href="https://mail.google.com/mail/?view=cm&fs=1&to=candra.argadinata1234@gmail.com" target="_blank">candra.argadinata1234@gmail.com</a></span>
            </div>
            <div class="info-item">
                <i class="fas fa-map-marker-alt icon"></i>
                <span>Alamat: Dsn Pulomulya, Dsa Ciparagejaya Kec. Tempuran Kab. Karawang</span>
            </div>
        </div>
    </div>-->
  
    
        <br>
        </div>
        <div class="menu-card">
        <div class="menu-header">
        <button class="tombol-animasi"  id="theme-toggle">Mode</button> 
            <h2>Program Unggulan </h2>
           
            <p>Pilihan terbaik kami untuk Anda</p>
            
        </div>
        <div class="container">
 
    <div class="app-grid">
        <?php foreach ($apps as $app): ?>
            <div class="app-card">
                <div class="app-icon"><?php echo $app['icon']; ?></div>
                <h3 class="app-name"><?php echo $app['nama']; ?></h3>
                <p class="app-desc"><?php echo $app['deskripsi']; ?></p>
                <div>
                    <?php foreach ($app['teknologi'] as $tech): ?>
                        <span class="tech-tag"><?php echo $tech; ?></span>    
                    <?php endforeach; ?>
                </div>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>
   <div class="container">
        <p>Silahkan Daftar</p>
        <!-- Tombol untuk membuka pop-up -->
        <a class ="btndaftar" href="student-create2.php">Daftar Sekarang</a>
        <br>
        <br>
    </div>
        <div class="footer_terakhir">
    
  <div class="footer-content">
        <div class="footer-section about">
       <h1>Masa Depan & Karier</h1>
            <p>Menyediakan pembelajaran kreatif untuk kebutuhan digital Anda dengan pembelajaran inovatif dan fungsionalitas terbaik.</p>
            <p>Kuasai Masa Depan Digital Anda Hari Ini! Les komputer kami membekali Anda dengan skill siap kerja yang paling dicari.</p>
           <p> Upgrade Skill Anda, Upgrade Hidup Anda. Teknologi modern membutuhkan keterampilan modern. Mulai perjalanan Anda di sini!</p>
            <div class="social-container">
        <a href="www.facebook.com" target="_blank" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="www.instagram.com" target="_blank" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
        <a href="www.twitter.com" target="_blank" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
        <a href="www.youtube.com" target="_blank" class="social-icon youtube"><i class="fab fa-youtube"></i></a>
    </div>
            
        </div>

      <div class="footer-section links">
       <h1>Tautan Cepat</h1>
         <ul>
                <li><a href="Beranda.php">Home</a></li>
                <li><a href="#bagian-keuntungan">Manfaat</a></li>
                <li><a href="#bagian-daftar">Daftar</a></li>
                <li><a href="#bagian-bawah">Sejarah</a></li>
                <li><a href="#bagian-footer4">Visi- Misi</a></li>
            </ul>
        </div>

        <div class="footer-section contact">
            <h1>Kontak Kami</h1><br>
            <span><i class="fas fa-user "></i>&#160;Candra Argadinata, S.Kom</span><br>
            <span><i class="fas fa-phone "></i>&#160;085776821436</span><br>
            <span class="fas fa-envelope">&#160;<a href="https://mail.google.com/mail/?view=cm&fs=1&to=candra.argadinata1234@gmail.com" target="_blank" style="color:white"><em>candra.argadinata1234@gmail.com</em></a></span><br>
            <span><i class="fas fa-map-marker"></i> <span>&#160;Alamat: Dsn Pulomulya, Dsa Ciparagejaya Kec. Tempuran &#160;&#160;&#160;&#160;Kab. Karawang</span><br>
           <div class="newsletter">
                <h1>Selamat Datang Pengunjung</h1>
    
    <div class="counter-box">

        <p>Jumlah Pengunjung: <?php echo $counter; ?></p>
      
    </div>
            </div>
        </div>
    </div>
  
</footer>
<hr width="97%">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#"style="color:white">Mari Belajar</a>, Website Pendaftaran Online Les Komputer.
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="#"style="color:white">Candra Argadinata, S.Kom.</a><br>
                        Distributed By <a class="border-bottom" href="#"style="color:white">Mari Belajar</a>
                    </div>
                   
        </div>
        
</div><!--ini div penutup dari wrapper-->

</body>
<script>
    
    function tampil(){
        alert("hallo, selamat datang silahkan klik ok untuk daftar");
    }
    </script>
     <script src="http://maps.googleapis.com/maps/api/js"></script>

<script>
    // fungsi initialize untuk mempersiapkan peta
    function initialize() {
    var propertiPeta = {
        center:new google.maps.LatLng(-6.15765066855746, 107.49084539632882),
        zoom:19,
        mapTypeId:google.maps.MapTypeId.ROADMAP
    };
    
    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
    }

    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
    
</script>
<script>
const themeToggle = document.getElementById('theme-toggle');
const body = document.body;
const localStorageTheme = localStorage.getItem('theme');

// Cek preferensi tema saat halaman dimuat
if (localStorageTheme === 'dark-mode') {
  body.classList.add('dark-mode');
}

// Tambahkan event listener untuk toggle
themeToggle.addEventListener('click', () => {
  body.classList.toggle('dark-mode');

  // Simpan preferensi pengguna
  if (body.classList.contains('dark-mode')) {
    localStorage.setItem('theme', 'dark-mode');
    themeToggle.textContent = 'Terang';
  } else {
    localStorage.setItem('theme', '');
    themeToggle.textContent = 'Gelap';
  }
});
</script>
<!--PopUp-->
<script>
// Dapatkan elemen modal
var popupModal = document.getElementById("registration-popup");

// Dapatkan tombol yang membuka modal
var openBtn = document.getElementById("open-popup-btn");

// Dapatkan elemen <span> yang menutup modal
var closeBtn = document.getElementsByClassName("close-btn")[0];

// Ketika user mengklik tombol, buka modal
openBtn.onclick = function() {
  popupModal.style.display = "flex"; // Menggunakan flex untuk centering
}

// Ketika user mengklik <span> (x), tutup modal
closeBtn.onclick = function() {
  popupModal.style.display = "none";
}

// Ketika user mengklik di luar modal, tutup modal
window.onclick = function(event) {
  if (event.target == popupModal) {
    popupModal.style.display = "none";
  }
}

// --- Logika Pengiriman Formulir AJAX ---
document.getElementById('registration-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah form dari pengiriman tradisional (page reload)

    var formData = new FormData(this);
    var responseDiv = document.getElementById('response-message');

    fetch('process_form.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            responseDiv.innerHTML = '<p style="color: green;">' + data.message + '</p>';
            document.getElementById('registration-form').reset(); // Reset form
            // Opsional: tutup pop-up setelah beberapa detik
            setTimeout(() => {
                popupModal.style.display = 'none';
                responseDiv.innerHTML = '';
            }, 3000);
        } else {
            responseDiv.innerHTML = '<p style="color: red;">' + data.message + '</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        responseDiv.innerHTML = '<p style="color: red;">Terjadi kesalahan koneksi.</p>';
    });
});

    </script>
<script>
// Dapatkan elemen-elemen yang diperlukan
var popup = document.getElementById("myPopup");
var openBtn = document.getElementById("open-button");
var closeBtn = document.getElementById("close-popup-button");

// Fungsi untuk membuka pop-up
function openPopup() {
    popup.style.display = "block";
}

// Fungsi untuk menutup pop-up
function closePopup() {
    popup.style.display = "none";
}

// Tambahkan event listener untuk tombol "Buka Pop-up"
openBtn.onclick = function() {
    openPopup();
}

// Tambahkan event listener untuk tombol tutup (X)
closeBtn.onclick = function() {
    closePopup();
}

// Tambahkan event listener untuk menutup pop-up jika pengguna mengklik di luar konten pop-up
window.onclick = function(event) {
    if (event.target == popup) {
        closePopup();
    }
}

    </script>
<script src="script.js"></script>


<script>
        function updateJam() {
            const now = new Date();
            let jam = now.getHours();
            let menit = now.getMinutes();
            let detik = now.getSeconds();

            // Menambahkan nol di depan jika < 10
            jam = (jam < 10) ? "0" + jam : jam;
            menit = (menit < 10) ? "0" + menit : menit;
            detik = (detik < 10) ? "0" + detik : detik;

            const waktuString = jam + ":" + menit + ":" + detik;
            document.getElementById("jam").innerText = waktuString;
        }

        // Jalankan fungsi setiap detik
        setInterval(updateJam, 1000);
        
        // Panggil sekali agar tidak delay 1 detik saat *load* pertama
        updateJam();
    </script>
</html>
