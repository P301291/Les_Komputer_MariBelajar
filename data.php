<?php 
include 'config.php';

?>

<table border="1">
    <tr>
        <th>Id</th>
        <th>Nama</th>
        <th>Jenis_Kelamin</th>
        <th>Kursus</th>
		<th>Alamat</th>
		<th>Tanggal</th>
        <th>Whatsapp</th>
    </tr>
    <?php 
    $data = mysql_query("select * from toy"); 
    $no = 1;
    while($d = mysql_fetch_array($data)){
    ?>
    <tr>
        
		 <td><?php echo $d['id']; ?></td>
        <td><?php echo $d['Nama']; ?></td>
        <td><?php echo $d['Jenis_Kelamin']; ?></td>
        <td><?php echo $d['Kursus']; ?></td>
		        <td><?php echo $d['Alamat']; ?></td>
				        <td><?php echo $d['Date']; ?></td>
                        <td><?php echo $d['No_Hp']; ?></td>
    </tr>
    <?php
    } 

    ?>
</table>
