<?php  
if ($_GET['form']=='add') { 
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Input Data Barang
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
            <form class="form-horizontal" role="form" method="post" action="modul/stock/proses.php?act=insert" enctype="multipart/form-data">
              <div class="box-body">
			  		  
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="kodebarang" maxlength="6" class="form-control" placeholder="Kode Barang">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>

                  <div class="col-sm-10">
                    <input type="text" name ="namabarang" maxlength="50" class="form-control" placeholder="Nama Barang">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>

                  <div class="col-sm-10">
                    <input type="text" name ="jenisbarang" maxlength="35" class="form-control" placeholder="Jenis Barang">
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah</label>

                  <div class="col-sm-10">
                    <input type="numeric" name ="stock" maxlength="10" class="form-control" placeholder="Jumlah">
                  </div>
                </div>
			
				
                      
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilstock&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
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
  if (isset($_GET['kodebarang'])) {
  
	$mySql = "SELECT * FROM stock WHERE kodebarang='$_GET[kodebarang]'";
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
            <form class="form-horizontal" role="form" method="post" action="modul/stock/proses.php?act=update" enctype="multipart/form-data">
			
              <div class="box-body">
                
				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Kode Barang</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="kodebarang" value="<?php echo $myData['kodebarang']; ?>" maxlength="6" class="form-control" placeholder="Kode Barang" readonly>
                  </div>
                </div>	

				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Barang</label>

                  <div class="col-sm-10">
                    <input type="text" name="namabarang" value="<?php echo $myData['namabarang']; ?>" maxlength="50" class="form-control" placeholder="Nama Barang">
                  </div>
                </div>	

				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>

                  <div class="col-sm-10">
                    <input type="text" name="jenisbarang" value="<?php echo $myData['jenisbarang']; ?>" maxlength="35" class="form-control" placeholder="Jenis Barang">
                  </div>
                </div>	

				<div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Jumlah Barang</label>

                  <div class="col-sm-10">
                    <input type="numeric" name="stock" value="<?php echo $myData['stock']; ?>" maxlength="10" class="form-control" placeholder="Jumlah">
                  </div>
                </div>		

			
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" name="save" class="btn btn-info">Simpan</button>
				<a href="?open=tampilstock&alert=1"><button type="button" class="btn btn-default">Batal</button></a>
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