<?php
session_start();

include_once "../../config/config.php";
date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=1'>";
}

else 
    if ($_GET['act']=='insert') {
        if (isset($_POST['save'])) {
			
			$random = (rand()%999);

			$kodebarang=$_POST["kodebarang"];
			$namabarang=$_POST["namabarang"];
			$jenisbarang=$_POST["jenisbarang"];
			$stock=$_POST["stock"];
	
			
						$mySql	= "INSERT INTO stock VALUES('$kodebarang','$namabarang','$jenisbarang','$stock')";
						$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                        if ($query) {
                            header("location:../../main.php?open=tampilstock&alert=1");
                        }							
		}
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['save'])) {
            if (isset($_POST['kodebarang'])) {
                				
			$kodebarang=$_POST["kodebarang"];
			$namabarang=$_POST["namabarang"];
			$jenisbarang=$_POST["jenisbarang"];
			$stock=$_POST["stock"];
		
                    $mySql = "UPDATE stock SET kodebarang='$kodebarang', namabarang='$namabarang', jenisbarang='$jenisbarang', stock='$stock', WHERE kodebarang='$kodebarang'";
					$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                    if ($query) {
                        header("location:../../main.php?open=tampilstock&alert=3");
                    }				
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['kodebarang'])) {
            $kodebarang = $_GET['kodebarang'];
    
			$mySql = "DELETE FROM stock WHERE kodebarang='$kodebarang'";
			$query = mysql_query($mySql, $koneksidb) or die ("Query salah".mysql_error());

            if ($query) {
                header("location:../../main.php?open=tampilstock&alert=2");
            }	
			
        }
    }       
    
?>