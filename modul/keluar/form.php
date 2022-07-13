<?php  
if ($_GET['form']=='add') { 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Input Barang Keluar
        <small></small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <!--/.col (left) -->
		<!-- right column -->
		
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            
            <!-- /.box-header --> 
            <!-- form start -->
            <form class="form-horizontal" role="form" method="post" action="modul/keluar/proses.php?act=insert" enctype="multipart/form-data">
              <div class="box-body">
			  <?php
	$query = mysqli_query($koneksidb, "SELECT max(idkeluar) as maxKode FROM keluar")
    or die('Query salah : '.mysqli_error($koneksidb));	
	$data = mysqli_fetch_assoc($query);
	
	$kode = $data['maxKode'];
	$noUrut = substr($kode, 2, 4);
	$noUrut++;
	
	$singkatan1 = "BK";
	
	$query2 = mysqli_query($koneksidb, "SELECT COUNT(*) as jumlah FROM keluar")
    or die('Query salah : '.mysqli_error($koneksidb));	
	$data2 = mysqli_fetch_assoc($query2);
	$jumlah = $data2['jumlah'];
	
	if($jumlah ==0){
		$newID1 = "BK0001";
	}else{
		$newID1 = $singkatan1 . sprintf("%04s", $noUrut);
	}

?>
			  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Bukti Barang Keluar</label>

                  <div class="col-sm-10">
                     <input type="text" name="idkeluar" maxlength="6" class="form-control" value="<?php echo $newID1; ?>" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Keluar</label>

                  <div class="col-sm-10">
                    <input type="date" name ="tanggalkeluar"  class="form-control" placeholder="Tanggal Keluar">
                  </div>
                </div>
				
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>

                  <div class="col-sm-10">
                    
					<select class="form-control" id="barangSelect" name="kodebarang" required onchange="kodeHandler(this.options[this.selectedIndex].value)">
						<option value="">- Pilih -</option>
						<?php			
							$mySql = "SELECT * FROM stock  ORDER BY kodebarang ASC";
							$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
              $sql = "SELECT * FROM masuk";
							$masuk = mysql_query($sql, $koneksidb)  or die ("Query salah : ".mysql_error());
							while ($myData = mysql_fetch_array($myQry)) {
						?> 
						<option value="<?php echo $myData['kodebarang']; ?>"><?php echo $myData['kodebarang']; ?> - <?php echo $myData['namabarang'];  ?></option>
						<?php } ?>
					</select>
					
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>

                  <div class="col-sm-10">
                    <input type="numeric" id="quantity" name ="quantity" maxlength="25" class="form-control" placeholder="Quantity">
                  </div>
                </div>
                <div>
                  <?php 
                    while($m = mysql_fetch_array($masuk)){
                  ?>
                  <input type="hidden" name="kode" id="kode" value="<?php echo $m['kodebarang'] ?>">
                  <input type="hidden" name="harga" id="harga" value="<?php echo $m['harga'] ?>">
                  <input type="hidden" name="quantities" id="quantities" value="<?php echo $m['quantity'] ?>">
                  <?php } ?>
                  
                </div>
				        <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>

                  <div class="col-sm-10">
                    <input type="numeric" readonly id= "h" name ="harga" maxlength="25" class="form-control" placeholder="Harga">
                  </div>
                </div>
				        <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga Total</label>

                  <div class="col-sm-10">
                    <input type="numeric" readonly id= "hTotal" name ="hTotal" maxlength="25" class="form-control" placeholder="Harga Total">
                  </div>
                </div>
                <script>
                    var kode = document.getElementsByName('kode');
                    var harga = document.getElementsByName('harga');
                    var quantities = document.getElementsByName('quantities');
                    var hargaFinal = 0;
                    var hargaArray = [];
                    var tempHarga = [];
                    
                    function kodeHandler() {
                      // kode.forEach(printArr);
                      for(let i=0; i< kode.length; i++){
                        let barang = {
                          "kode" : kode[i].value,
                          "harga" : harga[i].value,
                          "quantity" : quantities[i].value
                        }
                        // console.log(barang);
                        hargaArray.push(barang);
                      }
                      console.log(hargaArray);
                    
                      dataHarga = [];
                      for(let i=0; i<kode.length;i++){
                        let tempKode = kode[i].value;
                        let tempHarga = harga[i].value;
                        let tempQuantities = quantities[i].value;
                        
                        let data = {
                          "kode" : tempKode,
                          "quantity" : parseInt(quantities[i].value),
                          "harga" : parseInt(harga[i].value),
                        }
                        dataHarga.push(data);
                      }
                      console.log(dataHarga);

                      var listHarga = [];
                      var k = [];

                      for(let m = 0; m<dataHarga.length; m++){
                        if(k.indexOf(dataHarga[m].kode) > -1 === false){
                          k.push(dataHarga[m]);
                        }
                      }

                      for(let m = 0; m<dataHarga.length; m++){
                        var datTemp = dataHarga[m];
                        let hargaTemp = 0;
                        let quantityTemp = 0;


                        for(let i=0; i<k.length; i++){
                          if(datTemp.kode === k[i].kode){
                              hargaTemp = hargaTemp + k[i].harga;
                              quantityTemp = quantityTemp + k[i].quantity;
                          }
                        }

                        d = {
                          "kode" : datTemp.kode,
                          "harga" : hargaTemp,
                          "quantity" : quantityTemp
                        }
                        listHarga.push(d);
                      }

                      console.log(listHarga);

                      var barangSelect = document.getElementById("barangSelect").value;
                      var hargaField = document.getElementById("h");
                      
                      for(let k=0; k< listHarga.length; k++){
                        if(listHarga[k].kode === barangSelect){
                          hargaField.value = parseInt(listHarga[k].harga / listHarga[k].quantity);
                          hargaFinal = parseInt(listHarga[k].harga / listHarga[k].quantity);
                        }
                      }
                    }
                    var qInput = document.getElementById("quantity");
                    document.getElementById("quantity").addEventListener("change", function(){
                        document.getElementById("hTotal").value = parseInt(qInput.value) * hargaFinal;
                    });
                  </script>
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilkeluar&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          
            
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  <?php
}
elseif ($_GET['form']=='edit') { 
  if (isset($_GET['idkeluar'])) {
  
	$mySql = "SELECT * FROM keluar WHERE idkeluar='$_GET[idkeluar]'";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
	$myData = mysql_fetch_array($myQry);
	
    }
?>


  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Edit Data
        <small></small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
         <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" role="form" method="post" action="modul/keluar/proses.php?act=update" enctype="multipart/form-data">
			
              <div class="box-body">
                
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Bukti Barang Keluar</label>

                  <div class="col-sm-10">
                    <input type="text" name="idkeluar" value="<?php echo $myData['idkeluar']; ?>" maxlength="15" class="form-control" placeholder="No. Bukti Barang Keluar" >
                  </div>
                </div>	

				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Keluar</label>

                  <div class="col-sm-10">
                    <input type="date" name="tanggalkeluar" value="<?php echo $myData['tanggalkeluar']; ?>" class="form-control" placeholder="Tanggal Keluar">
                  </div>
                </div>	

				

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>

                  <div class="col-sm-10">
                    
					<select class="form-control" name="kodebarang" required>
						<option value="">- Pilih -</option>
						<?php			
							$mySql = "SELECT * FROM stock  ORDER BY kodebarang ASC";
							$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
							while ($myData = mysql_fetch_array($myQry)) {
						?> 
						<option value="<?php echo $myData['kodebarang']; ?>"><?php echo $myData['kodebarang']; ?> - <?php echo $myData['namabarang'];?></option>
						<?php } ?>
					</select>
					
                  </div>
                </div>
				
                </div>
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
					
				   <div class="col-sm-10">
                    <input type ="text" name="quantity" value="<?php echo $myData['quantity']; ?>" maxlength="35" class="form-control" placeholder="Quantity">
                  </div>
                </div>	
				
						
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="harga" maxlength="25" class="form-control" placeholder="Harga">
                  </div>
                </div>

				


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilkeluar&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          <!-- general form elements disabled -->
         
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


<?php } ?>