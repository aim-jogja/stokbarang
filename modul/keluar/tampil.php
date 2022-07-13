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
       <h1>
        Data Barang Keluar

      </h1>
	  <ol class="breadcrumb">
      <a href="?open=formkeluar&form=add"><button type="button" class="btn btn-primary btn-xs waves-effect waves-light"><i class="ico ico-left fa fa-plus"></i> Tambah</button></a>
	 </ol>
	</section>
	
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box -->

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
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
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
				  <th>No. Bukti Barang Keluar</th>
				  <th>Tanggal Keluar</th>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Quantity</th>
				          <th>Harga</th>
				          <th>Total</th>
                  <th>Proses</th>
                </tr>
                </thead>
                <tbody>
            
 <?php										
	$mySql = "SELECT * FROM keluar,stock WHERE keluar.kodebarang= stock.kodebarang ORDER BY idkeluar DESC";
	$myQry = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error()); 
	$nomor = 0; 
	while ($myData = mysql_fetch_array($myQry)) {
	$nomor++;
?>					

							<tr>
								<td><?php echo $nomor; ?></td>
								<td><?php echo $myData['idkeluar']; ?></td>
								<td><?php echo $myData['tanggalkeluar']; ?></td>
								<td><?php echo $myData['kodebarang']; ?></td>
								<td><?php echo $myData['namabarang']; ?></td>
								<td><?php echo $myData['quantity']; ?></td>
								<td><?php echo $myData['harga']; ?></td>
								<td><?php echo $myData['total']; ?></td>
								<td>

								
								
								
								<a href="modul/keluar/proses.php?act=delete&idkeluar=<?php echo $myData['idkeluar'];?>" onclick="return confirm('Yakin mau di hapus ?');">
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
  
  
  