<?php
include_once "config/config.php";
date_default_timezone_set('Asia/Jakarta');

$username = $_POST['username'];
$password = md5($_POST['password']);
$time=date("YmdHis")+180;

if (!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {
		$loginSql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
		$loginQry = mysql_query($loginSql, $koneksidb)  or die ("Query Periksa Password Salah : ".mysql_error());
		
		if (mysql_num_rows($loginQry) >=1) {
			
		$data  = mysql_fetch_array($loginQry);

		session_start();
		$_SESSION['iduser']  = $data['iduser'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['namakaryawan'] = $data['namakaryawan'];
		$_SESSION['password'] = $data['password'];
		$_SESSION['status'] = $data['status'];
		
		
		echo "<meta http-equiv='refresh' content='0; url=main.php?open=Halaman-Utama'>";
		

		
	}

	else {
		header("Location: index.php?alert=1");
	}
	
	
}
?>