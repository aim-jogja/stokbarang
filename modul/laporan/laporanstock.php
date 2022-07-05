<?php
include_once "../../config/config.php";
include_once "../../config/inc.library.php";
include_once "../../config/fungsi_indotgl.php";
?>

<html>
<head>
<title>Laporan Inventory Barang</title>
</head>
<body onLoad="window.print()">
<center>
<table border="1" align="#">
<tr>
  <td width="530" height="#" >
  <table>
    <tr>
    <td colspan="#" width="1500" height="30">
  <center><b>PETSHOP SALSA</b><br><i>JL. Pagar Alam No. 74, Segala Mider, Kec. Tj. Karang Barat <br> Kota Bandar Lampung, 35122 </i> <br><u>Laporan Inventory Barang</u> </center><br>
    </td>
    </tr>
  </table>
<center>
<table border="1" cellpadding="1" cellspacing="0">
	<thead>
               
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jenis Barang</th>
                  <th>Inventory Akhir</th>
				  <th>Harga</th>
				
		</tr>
	</thead>
	<tbody>
<?php										
	$mySql = "SELECT * FROM stock 
				WHERE stock.kodebarang = stock.kodebarang 
				GROUP BY kodebarang ORDER BY kodebarang ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	
	while ($myData = mysql_fetch_array($myQry)) {
	
?>


		<tr>
				
					<td><?php echo $myData['kodebarang']; ?></td>
					<td><?php echo $myData['namabarang']; ?></td>
					<td><?php echo $myData['jenisbarang']; ?></td>
					<td><?php echo $myData['stock']; ?></td>
					
					
		</tr>
		<?php 
			$no++;
			} 
		?>
	
<?php										
	$mySql = "SELECT sum(stock) as total_barang FROM stock";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());  
	$myData = mysql_fetch_array($myQry);
	$total_barang = $myData['total_barang'];
	
	
	
	
?>		
		<tr>
			<td colspan="3"><b>Total Barang</b></td>
			<td><b><?php echo number_format($total_barang); ?></td></b>
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
<p>Admin <br><br><br><br> <br><br><br>( Riska ) </p>
<p>Bandar Lampung, <?php echo date("d F Y"); ?><br>Mengetahui<br>Pimpinan<br><br><br><br><br><br>( Deni Aplindo )</p>
</div>
</body>
</html>

</td>
</tr>
</table>
</body>
</html>