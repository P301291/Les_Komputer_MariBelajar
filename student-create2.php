<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Daftar</title>
    
</head>
<body>
  
 
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

<link href="css/style_add.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
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
 
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Pendaftaran
                            <a href="Beranda.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">
                        <div class="mb-3">
                                <label>Kode</label>
                                <input type="text" name="id" value="<?php echo $auto_kode;?> " class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="Nama" class="form-control" placeholder="masukan nama lengkap"required>
                            </div>
                            <div class="mb-3">
                            <label>Jenis Kelamin</label>
                                <Select id="Jenis_Kelamin" name="Jenis_Kelamin" class="form-control" required>
                                <option value="">--Pilih Kelamin--</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
</select>
                            </div>
                            <div class="mb-3">
                            <label>Kursus</label>
                                <Select id="Kursus" name="Kursus" class="form-control" required>
                                <option value="">--Pilih Kursus--</option>
                                <option value="Komputer Kls 1 (8 x P)">Komputer Kelas 1  (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 1 (12 x P)">Komputer Kelas 1 (12 x Pertemuan)</option>
                                    <option value="Komputer Kls 2 (8 x P)"> Komputer Kelas 2 (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 2 (12 x P)">Komputer Kelas 2 (12 x Pertemuan)</option>
                                    <option value="Komputer Kls 3 (8 x P)">Komputer Kelas 3  (8 x Pertemuan)</option>
                                    <option value="Komputer Kls 3 (12 x P)">Komputer Kelas 3 (12 x Pertemuan)</option>
</select>
</select>
                            </div>
                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" name="Alamat" class="form-control"placeholder="masukan alamat"required>
                            </div>
                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input type="text" name="Date" class="form-control" value='<?php 
date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
echo date('d/m/Y/l'); //kombinasi jam dan tanggal
?>'readonly required class="demoInputBox">
                            </div>
                            <div class="mb-3">
                                <label>Whatsapp</label>
                                <input type="text" name="No_Hp" class="form-control"placeholder="masukan No WA"required>
                            </div> 
                            <div class="mb-3">
                                <button type="submit" name="save_student" class="btn btn-primary">Daftar</button>
                                <button type="reset" name="save_student" class="btn btn-primary">Reset</button>
                            </div>
                           

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

