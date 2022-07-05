<?php 
if (isset($_GET['alert'])) {
        if ($_GET['alert']==1) {
            echo "<div class='alert alert-success'>Sukses.</div>";
        } elseif ($_GET['alert']==2) {
            echo "<div class='alert alert-success'>Sukses.</div>";
        } elseif ($_GET['alert']==3) {
            echo "<div class='alert alert-success'>Sukses.</div>";
        } elseif ($_GET['alert']==4){
            echo "<div class='alert alert-success'>Gagal.</div>";
        }
    }
 ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Barang
        <small>Inventory Barang</small>
		    </h1>
	  <ol class="breadcrumb">
      <a href="?open=formstock&form=add"><button type="button" class="btn btn-primary btn-xs waves-effect waves-light"><i class="ico ico-left fa fa-plus"></i> Tambah</button></a>
	 </ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Jenis Barang</th>
				  <th>Jumlah</th>
                  <th>Proses</th>
                </tr>
                </thead>
                <tbody>
				
                <?php										
	$mySql = "SELECT * FROM stock ORDER BY kodebarang ASC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>					

							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $myData['kodebarang']; ?></td>
								<td><?php echo $myData['namabarang']; ?></td>
								<td><?php echo $myData['jenisbarang']; ?></td>
								<td><?php echo $myData['stock']; ?></td>
								
								<td>
								
							
								
								<a href="modul/stock/proses.php?act=delete&kodebarang=<?php echo $myData['kodebarang'];?>" onclick="return confirm('Yakin mau di hapus ?');">
									<button type="button" class="btn btn-danger btn-xs waves-effect waves-light"><i class="ico ico-left fa fa-remove"></i> Hapus</button>
								</a>
								
								</td>
							</tr>
<?php } ?>
			
                
                
				
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
  
  