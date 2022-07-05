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
			
			$idmasuk=$_POST["idmasuk"];
			$tanggalmasuk=$_POST["tanggalmasuk"];
			$kodebarang=$_POST["kodebarang"];
			$quantity=$_POST["quantity"];
			$harga=$_POST["harga"];
														
						$mySql	= "INSERT INTO masuk 
								   VALUES('$idmasuk','$tanggalmasuk','$kodebarang','$quantity','$harga')";
						$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                        if ($query) {
                            header("location:../../main.php?open=tampilmasuk&alert=1");
                        }							
		}
    }
    
    elseif ($_GET['act']=='update') {
        if (isset($_POST['save'])) {
            if (isset($_POST['idmasuk'])) {
				
            $idmasuk=$_POST["idmasuk"];
			$tanggalmasuk=$_POST["tanggalmasuk"];
			$kodebarang=$_POST["kodebarang"];
			$quantity=$_POST["quantity"];
			$harga=$_POST["harga"];
				
                    $mySql = "UPDATE masuk SET idmasuk='$idmasuk',tanggalmasuk='$tanggalmasuk',kodebarang='$kodebarang',  quantity='$quantity', harga='$harga' WHERE kodebarang='$kodebarang'";
					$query	= mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());

                    if ($query) {
                        header("location:../../main.php?open=tampilmasuk&alert=3");
                    }				
            }
        }
    }

    elseif ($_GET['act']=='delete') {
        if (isset($_GET['idmasuk'])) {
            $idmasuk = $_GET['idmasuk'];
    
			$mySql = "DELETE FROM masuk WHERE idmasuk='$idmasuk'";
			$query = mysql_query($mySql, $koneksidb) or die ("Query salah".mysql_error());

            if ($query) {
                header("location:../../main.php?open=tampilmasuk&alert=2");
            }	
			
        }
    }       
}       
?>