<?php 
	session_start();
	if(isset($_SESSION['userid'])){
		header('Location: userinfo.php');
		die();
	}else{
		session_unset();
	}
	

 ?>