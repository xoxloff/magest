<?php 
	session_start();
	if(!isset($_SESSION['userid'])){
		header('Location: index.php');
		die();
	}
	$user_old = $_POST[user_oldemail];
	$user_email = $_POST[user_email];
	$user_firstname = $_POST[user_firstname];
	$user_lastname = $_POST[user_lastname];
	$user_role = $_POST[user_role];
	if(empty($user_email) || empty($user_firstname) || empty($user_role) ){
		die();
	}
	include "dbconnect.php";
	pg_prepare($dbconnect, 'update_query', 'UPDATE users SET user_email = $1, user_firstname = $2, user_lastname = $3, user_role = $4 WHERE user_email = $1 ' );
	pg_execute($dbconnect, 'update_query', array($user_email, $user_firstname,$user_lastname,$user_role));
	if($_SESSION['userid']==$user_oldemail)
		$_SESSION['userid'] = $user_email;
	header('Location: userinfo.php');
	die();
 ?>