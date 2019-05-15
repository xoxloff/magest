<?php 
	$host = "127.0.0.1";
	$port = "5432";
	$user = "magest_user";
	$dbname = "magest_db";
	$dbpassword = "qwerty123";
	$connection_string = 'host='.$host.' port='.$port.' user='.$user.' dbname='.$dbname.' password='.$dbpassword;
	$dbconnect = pg_connect($connection_string) or die();
	function barring(){
		header("Location: index.php?error=Неверные учетные данные");
	}
 ?>