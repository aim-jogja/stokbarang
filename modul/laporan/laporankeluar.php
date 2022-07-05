<?php
include_once "../../config/config.php";
include_once "../../config/inc.library.php";
include_once "../../config/fungsi_indotgl.php";
?>

<?php						

	$bulan 	= $_POST['bulan'];
	$tahun	= $_POST['tahun'];
	
	$mySql = "SELECT * FROM keluar,stock 
				WHERE keluar.kodebarang = stock.kodebarang 
				AND month(tanggalkeluar) = '$bulan' AND year(tanggalkeluar) = '$tahun'
				GROUP BY idkeluar ORDER BY idkeluar ASC";
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
<title> Kertas Kerja Keluar</title>
</head>
<body onLoad="window.print()">
<center>
<table border="1" align="#">
<tr>
  <td width="700" height="#" >
  <table>
    <tr>
    <td colspan="#" width="1500" height="30">
  <center><b>PETSHOP SALSA</b><br><i>JL. Pagar Alam No. 74, Segala Mider, Kec. Tj. Karang Barat <br> Kota Bandar Lampung, 35132 </i> <br><u>Kertas Kerja Keluar</u><br>Bulan : <?php echo $namabulan; ?> <?php echo $tahun; ?></center>
    </td>
    </tr>
  </table>
<center>
<table border="1" cellpadding="1" cellspacing="0">
	<thead>
		<tr>
                  <th>No.</th>
                  <th>No. Bukti Barang Keluar</th>
                  <th>Tanggal Keluar</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
				  <th>Quantity</th>
				  <th>Harga</th>
				  <th>Total Harga</th>
		</tr>
	</thead>
	<tbody>
<?php						

	$bulan 	= $_POST['bulan'];
	$tahun	= $_POST['tahun'];
	
	$mySql = "SELECT * FROM keluar,stock 
				WHERE keluar.kodebarang = stock.kodebarang 
				AND month(tanggalkeluar) = '$bulan' AND year(tanggalkeluar) = '$tahun'
				GROUP BY idkeluar ORDER BY idkeluar ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>
		<tr>
				
					<td><?php echo $nomor; ?></td>
					<td><?php echo $myData['idkeluar']; ?></td>
					<td><?php echo IndonesiaTgl($myData['tanggalkeluar']); ?></td>
					<td><?php echo $myData['kodebarang']; ?></td>
					<td><?php echo $myData['namabarang']; ?></td>
					<td><?php echo $myData['quantity']; ?></td>
					<td><?php echo $myData['harga']; ?></td>
					<td><?php echo $myData['total']; ?></td>
					
		</tr>
		<?php 
			$no++;
			} 
		?>
		
<?php										
	$mySql = "SELECT sum(quantity) as total_keluar FROM keluar WHERE month(tanggalkeluar) = '$bulan' AND year(tanggalkeluar) = '$tahun'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_keluar = $myData['total_keluar'];
	
	$mySql = "SELECT sum(harga) as total_harga FROM keluar WHERE month(tanggalkeluar) = '$bulan' AND year(tanggalkeluar) = '$tahun'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_harga = $myData['total_harga'];

	$mySql = "SELECT sum(total) as total_keseluruhan FROM keluar WHERE month(tanggalkeluar) = '$bulan' AND year(tanggalkeluar) = '$tahun'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_keseluruhan = $myData['total_keseluruhan'];
?>		
		<tr>
			<td colspan="5"><b>Total </b></td>
			<td align="leaf"><b><?php echo number_format($total_keluar); ?></b></td>
			<td align="leaf"><b><?php echo number_format($total_harga); ?></b></td>
			<td align="leaf"><b><?php echo number_format($total_keseluruhan); ?></b></td>
		</tr>
		
		
	</tbody>
</table>

</center>
</center>
<br>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
	div {
		-webkit-column-count: 2;
		-moz-column-count: 2;
		column-count: 2;
	}
</style>
</head>
<body>
<div>
<p>Admin <br><br><br><br><br><br><br> ( Riska ) </p>
<p>Bandar Lampung, <?php echo date("d F Y"); ?><br>Mengetahui<br>Pimpinan<br><br><br><br><br><br>( Deni Aplindo )</p>
</div>
</body>
</html>

</td>
</tr>
</table>
</body>
</html>