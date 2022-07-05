<?php  
if ($_GET['form']=='add') { 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Input Masuk
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
            <form class="form-horizontal" role="form" method="post" action="modul/masuk/proses.php?act=insert" enctype="multipart/form-data">
              <div class="box-body">
			  <?php
			  $query = mysqli_query($koneksidb, "SELECT max(idmasuk) as maxKode FROM masuk")
			  or die('Query salah : '.mysqli_error($koneksidb));	
			  $data = mysqli_fetch_assoc($query);
	
			  $kode = $data['maxKode'];
			  $noUrut = substr($kode, 2, 4);
			  $noUrut++;
	
			  $singkatan1 = "BM";
	
			  $query2 = mysqli_query($koneksidb, "SELECT COUNT(*) as jumlah FROM masuk")
			  or die('Query salah : '.mysqli_error($koneksidb));	
			  $data2 = mysqli_fetch_assoc($query2);
			  $jumlah = $data2['jumlah'];
	
			  if($jumlah ==0){
			  $newID1 = "BM0001";
			  }else{
		      $newID1 = $singkatan1 . sprintf("%04s", $noUrut);
			  }
			  ?>
			  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Bukti Barang Masuk</label>
			
                  <div class="col-sm-10">
                    <input type="text" name="idmasuk" maxlength="6" class="form-control" value="<?php echo $newID1; ?>" readonly>
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Masuk</label>

                  <div class="col-sm-10">
                    <input type="date" name ="tanggalmasuk"  class="form-control" placeholder="Tanggal Masuk">
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
						<option value="<?php echo $myData['kodebarang']; ?>"><?php echo $myData['kodebarang']; ?> - <?php echo $myData['namabarang'];  ?></option>
						<?php } ?>
					</select>
					
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="quantity" maxlength="25" class="form-control" placeholder="Quantity">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga</label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="harga" maxlength="25" class="form-control" placeholder="harga">
                  </div>
                </div>
				
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilmasuk&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
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
  if (isset($_GET['idmasuk'])) {
  
	$mySql = "SELECT * FROM masuk WHERE idmasuk='$_GET[idmasuk]'";
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
            <form class="form-horizontal" role="form" method="post" action="modul/masuk/proses.php?act=update" enctype="multipart/form-data">
			
              <div class="box-body">
                
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">No. Bukti Barang Masuk</label>

                  <div class="col-sm-10">
                    <input type="text" name="idmasuk" value="<?php echo $myData['idmasuk']; ?>" maxlength="15" class="form-control" placeholder="No. Bukti Barang Masuk" >
                  </div>
                </div>	

				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Masuk</label>

                  <div class="col-sm-10">
                    <input type="date" name="tanggalmasuk" value="<?php echo $myData['tanggalmasuk']; ?>" class="form-control" placeholder="Tanggal Masuk">
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
                  <label for="inputEmail3" class="col-sm-2 control-label">Harga </label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="harga" maxlength="25" class="form-control" placeholder="harga">
                  </div>


				


              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilmasuk&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
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