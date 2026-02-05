<!DOCTYPE html>

<head>

	<title>Data Siswa Mari Belajar</title>
	<style>
		.scroll{
			
			height:400%;
	overflow: scroll;
	white-space: nowrap; /* Mencegah teks pindah baris */
	overflow-y: auto;        /* Sembunyikan scroll vertikal */

	
   
 
    }
		</style>
</head>

<body>

	
	<?php 
	include 'koneksi.php';
	?>
 	<center>
	<table border="1" style="width: 100%" class="scroll">

 
 <h2>LAPORAN DATA SISWA</h2>
 <h4>MARI BELAJAR</h4>



		<tr>
				<th>Id</th>
			<th>Nama</th>
			<th>Jenis_Kelamin</th>
			<th>Kursus</th>
			<th>Alamat</th>
			<th>Date</th>
			<th>Whatsapp</th>
			
		</tr>
		<?php 
		$no = 1;
		$sql = mysqli_query($koneksi,"select * from toy");
		while($data = mysqli_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $data['id']; ?></td>
			<td><?php echo $data['Nama']; ?></td>
			<td><?php echo $data['Jenis_Kelamin']; ?></td>
			<td><?php echo $data['Kursus']; ?></td>
			<td><?php echo $data['Alamat']; ?></td>
			<td><?php echo $data['Date']; ?></td>
			<td><?php echo $data['No_Hp']; ?></td>
		</tr>
		<?php 
		}
		?>
	</table>
	</center>
	<script>
		window.print();
	</script>
 
</body>
