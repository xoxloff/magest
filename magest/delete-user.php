<?php 
	session_start();
	if(!isset($_SESSION['userid'])){
		header('Location: index.php');
		die();
	}
	$delete_user = $_POST[user_delete];
	include 'dbconnect.php';
	if(!empty($delete_user)){
		pg_prepare($dbconnect,'delete_user', 'UPDATE users SET user_status = 0, user_deletedate = $1 WHERE user_email = $2');
		pg_execute($dbconnect,'delete_user', array(date("Y-m-d H:i:s"),$delete_user)) or die();
	}else{
		header('Location: userinfo.php?id='.$delete_user);
		die();
	}
	header('Location: userlist.php');
 ?>