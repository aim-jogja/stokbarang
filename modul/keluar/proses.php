<?php
session_start();

include_once "../../config/config.php";
date_default_timezone_set('Asia/Jakarta');

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=../../index.php?alert=1'>";
}

else {
    if ($_GET['act']=='insert') {
        if (isset($_POST['save'])) {
			
			$random = (rand()%999);
			
			$idkeluar=$_POST["idkeluar"];
			$tanggalkeluar=$_POST["tanggalkeluar"];
			$kodebarang=$_POST["kodebarang"];
			$quantity=$_POST["quantity"];
			$harga=$_POST["harga"];
			$total=$_POST["hTotal"];
														
						$mySql	= "INSERT INTO keluar 
								   VALUES('$idkeluar','$tanggalkeluar','$kodebarang','$quantity','$harga', '$total')";
						$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                        if ($query) {
                            header("location:../../main.php?open=tampilkeluar&alert=1");
                        }							
		}
    }
	
	  
    elseif ($_GET['act']=='update') {
        if (isset($_POST['save'])) {
            if (isset($_POST['idkeluar'])) {
				
            $idkeluar=$_POST["idkeluar"];
			$tanggalkeluar=$_POST["tanggalkeluar"];
			$kodebarang=$_POST["kodebarang"];
			$quantity=$_POST["quantity"];
			$harga=$_POST["harga"];
				
                    $mySql = "UPDATE keluar SET idkeluar='$idkeluar',tanggalkeluar='$tanggalkeluar',kodebarang='$kodebarang',  quantity='$quantity', harga='$harga' WHERE kodebarang='$kodebarang'";
					$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                    if ($query) {
                        header("location:../../main.php?open=tampilkeluar&alert=3");
                    }				
            }
        }
    }

        elseif ($_GET['act']=='delete') {
        if (isset($_GET['idkeluar'])) {
            $idkeluar = $_GET['idkeluar'];
    
			$mySql = "DELETE FROM keluar WHERE idkeluar='$idkeluar'";
			$query = mysql_query($mySql, $koneksidb) or die ("Query salah".mysql_error());

            if ($query) {
                header("location:../../main.php?open=tampilkeluar&alert=2");
            }	
			
        }
    }       
}       
?>



  