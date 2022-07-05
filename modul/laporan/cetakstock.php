<?php
include_once "../../config/config.php";
include_once "../../config/inc.library.php";
include_once "../../config/fungsi_indotgl.php";
?>

<?php						

	$bulan 	= $_POST['bulan'];
	$tahun	= $_POST['tahun'];
	
	$mySql = "SELECT * FROM masuk,stock 
				WHERE masuk.idbarang = stock.idbarang 
				AND month(tanggalmasuk) = '$bulan' AND year(tanggalmasuk) = '$tahun'
				GROUP BY idmasuk ORDER BY idmasuk ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$myData = mysql_fetch_array($myQry);
	
  if($bulan=="1"){ $namabulan = "Januari";
  }else if($bulan=="2"){ $namabulan = "Februari";
  }else if($bulan=="3"){ $namabulan = "Maret";
  }else if($bulan=="4"){ $namabulan = "April";
  }else if($bulan=="5"){ $namabulan = "Mei";
  }else if($bulan=="6"){ $namabulan = "Juni";	 
  }else if($bulan=="7"){ $namabulan = "Juli";
  }else if($bulan=="8"){ $namabulan = "Agustus";
  }else if($bulan=="9"){ $namabulan = "September"; 
  }else if($bulan=="10"){ $namabulan = "Oktober"; 
  }else if($bulan=="11"){ $namabulan = "November"; 
  }else if($bulan=="12"){ $namabulan = "Desember"; } 
?>

<html>
<head>
<title>Laporan Data Stock</title>
</head>
<body onLoad="window.print()">

<center>

<h3>LAPORAN STOCK <br>PetShop SALSA BANDAR LAMPUNG</h3>
Bulan : <?php echo $namabulan; ?> <?php echo $tahun; ?>

<hr>

Data Masuk
<table border="1" cellpadding="1" cellspacing="0">
	<thead>
		<tr>
                  <th>No.</th>
                  <th>Id Masuk</th>
                  <th>Tanggal Masuk</th>
                  <th>Id Barang</th>
                  <th>Nama Barang</th>
				  <th>Keterangan</th>
				  <th>Jumlah Stock</th>
		</tr>
	</thead>
	<tbody>
<?php						

	$bulan 	= $_POST['bulan'];
	$tahun	= $_POST['tahun'];
	
	$mySql = "SELECT * FROM masuk,stock
				WHERE masuk.idbarang = stock.idbarang
				AND month(tanggalmasuk) = '$bulan' AND year(tanggalmasuk) = '$tahun'
				GROUP BY idmasuk ORDER BY idmasuk ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
		<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $myData['idmasuk']; ?></td>
					<td><?php echo Indonesia2Tgl($myData['tanggalmasuk']); ?></td>
					<td><?php echo ($myData['idbarang']); ?></td>
					<td><?php echo $myData['namabarang']; ?></td>
					<td><?php echo $myData['keterangan']; ?></td>
					<td align="right"><?php echo number_format($myData['jumlahstock']); ?></td>
		</tr>
		<?php 
			$no++;
			} 
		?>
		
<?php										
	$mySql = "SELECT sum(jumlahstock) as total_masuk FROM masuk WHERE month(tanggalmasuk) = '$bulan' AND year(tanggalmasuk) = '$tahun'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_masuk = $myData['total_masuk'];
	
	
?>		
		<tr>
			<td colspan="6"><b>Total Stock</b></td>
			<td align="right"><b> <?php echo number_format($total_masuk); ?></b></td>
		</tr>
		
		
	</tbody>
</table>


<br><br>

Data Keluar
<table border="1" cellpadding="1" cellspacing="0">
	<thead>
		<tr>
                  <th>No.</th>
                  <th>Id Keluar</th>
                  <th>Tanggal Keluar</th>
                  <th>Id Barang</th>
                  <th>Nama Barang</th>
				  <th>Keterangan</th>
				  <th>Jumlah Stock</th>
		</tr>
	</thead>
	<tbody>
<?php										
	$mySql = "SELECT * FROM masuk,stock 
				WHERE masuk.idbarang = stock.idbarang
				AND month(tanggalmasuk) = '$bulan' AND year(tanggalmasuk) = '$tahun'
				GROUP BY idmasuk ORDER BY idmasuk ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
		<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $myData['idmasuk']; ?></td>
					<td><?php echo Indonesia2Tgl($myData['tanggalmasuk']); ?></td>
					<td><?php echo ($myData['idbarang']); ?></td>
					<td><?php echo $myData['namabarang']; ?></td>
					<td><?php echo $myData['keterangan']; ?></td>
					<td align="right"><?php echo number_format($myData['jumlahstock']); ?></td>
		</tr>
		<?php 
			$no++;
			} 
		?>
		
<?php										
	$mySql = "SELECT sum(jumlahstock) as total_masuk FROM masuk WHERE month(tanggalmasuk) = '$bulan' AND year(tanggalmasuk) = '$tahun'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_keluar = $myData['total_masuk'];
	
	$Stock_akhir = $total_masuk - $total_keluar;
	
	
?>		
		<tr>
			<td colspan="6"><b>Total Keluar</b></td>
			<td align="right"><b> <?php echo number_format($total_masuk); ?></b></td>
		</tr>
		
	</tbody>
</table>


<hr>
<b> Total Stock Akhir :  <?php echo number_format($Stock_akhir); ?></b>
<hr>

<br>
Bandar Lampung, <?php echo Indonesia2Tgl(date("Y-m-d")); ?><br>Pemilik
<br><br><br><br><br>
( Agus Saputra )
</center>

</body>
</html>