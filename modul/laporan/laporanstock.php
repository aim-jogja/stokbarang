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
<!-- <body> -->
<center>
<table border="1" align="#">
<tr>
  <td width="790" height="#" >
  <table>
    <tr>
    <td colspan="#" width="1500" height="30">
  <center><b>PETSHOP SALSA</b><br><i>JL. Pagar Alam No. 74, Segala Mider, Kec. Tj. Karang Barat <br> Kota Bandar Lampung, 35122 </i> <br><u>Laporan Inventory Barang</u> </center><br>
    </td>
    </tr>
  </table>
<center>
  <?php
    $query = "SELECT * FROM masuk";
    $exct = mysql_query($query, $koneksidb)  or die ("Query salah : ".mysql_error()); 
    $kodeBarang = array("kode" => array(), "harga"=> array(), "quantity"=> array());
    while ($m = mysql_fetch_array($exct)) {
        if(!in_array($m["kodebarang"], $kodeBarang["kode"])){
          array_push($kodeBarang["kode"], $m["kodebarang"]);
        }
    }
    
    foreach($kodeBarang["kode"] as $k){
      echo $k."<br>";
    }
    
    echo "<br>";
    $e = mysql_query($query, $koneksidb)  or die ("Query salah : ".mysql_error());
    while ($m = mysql_fetch_array($e)) {
      for($i =0; $i<sizeof($kodeBarang["kode"]); $i++){
        if($m["kodebarang"] == $kodeBarang["kode"][$i]){
          $kodeBarang["harga"][$i] = $kodeBarang["harga"][$i] + $m["harga"];
          $kodeBarang["quantity"][$i] = $kodeBarang["quantity"][$i] + $m["quantity"];
          // echo $kodeBarang["harga"][$i]."<br>";
        }
      }
    }

    for($i =0; $i<sizeof($kodeBarang["kode"]); $i++){
        echo "Kode : ".$kodeBarang["kode"][$i]." Harga : ".$kodeBarang["harga"][$i]." Quantity : ".$kodeBarang["quantity"][$i]."<br>";
    }
    $kBarang = $kodeBarang;

    for($i =0; $i<sizeof($kodeBarang["kode"]); $i++){
      $kodeBarang["harga"][$i] = (int)($kodeBarang["harga"][$i] / $kodeBarang["quantity"][$i]);
    }
    echo "<br>";echo "<br>";
    for($i =0; $i<sizeof($kodeBarang["kode"]); $i++){
      echo "Kode : ".$kodeBarang["kode"][$i]." Harga : ".$kodeBarang["harga"][$i]." Quantity : ".$kodeBarang["quantity"][$i]."<br>";
    }
  ?>
<table border="1" cellpadding="1" cellspacing="0">
	<thead>
    <tr>
      <th>Kode Barang</th>
      <th>Nama Barang</th>
      <th>Jenis Barang</th>
      <th>Inventory Akhir</th>
      <th width="14%">Harga</th>				
      <th width="14%">Total</th>				
		</tr>
	</thead>
	<tbody>
    <?php										
      $mySql = "SELECT * FROM stock 
            WHERE stock.kodebarang = stock.kodebarang 
            GROUP BY kodebarang ORDER BY kodebarang ASC";
      $myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
      $h = 0;
      $ht = 0;
      while ($myData = mysql_fetch_array($myQry)) {
      
    ?>
		<tr>	
        <td><?php echo $myData['kodebarang']; ?></td>
        <td><?php echo $myData['namabarang']; ?></td>
        <td><?php echo $myData['jenisbarang']; ?></td>
        <td><?php echo $myData['stock']; ?></td>					
        <td width="10%"><?php
            for($i=0; $i<sizeof($kodeBarang["kode"]); $i++){
              if($myData["kodebarang"] == $kodeBarang["kode"][$i]){
                if(($myData["stock"] + 0) != 0){
                  echo "Rp. ".number_format($kodeBarang["harga"][$i], 0, ".", ".");
                  $h += $kodeBarang["harga"][$i];
                }
              }
            }
        ?></td>
        <td width="12%">
          <?php 
            for($i =0; $i<sizeof($kBarang["kode"]); $i++){
              if($myData["kodebarang"] == $kBarang["kode"][$i]){
                if(($myData["stock"] + 0) != 0){
                  echo "Rp. ".number_format($myData['stock'] * $kodeBarang["harga"][$i], 0, ".", ".");
                  $ht += ($myData['stock'] * $kodeBarang["harga"][$i]);
                }
              }
            }
          ?>
        </td>
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
			<td><b><?php echo "Rp. ".number_format($h, 0, ".", "."); ?></td></b>
			<td><b><?php echo "Rp. ".number_format($ht, 0, ".", "."); ?></td></b>
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