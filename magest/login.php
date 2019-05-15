<?php
	include "sessioncheck.php";
	$user_email = $_POST[user_email];
	$user_password = $_POST[user_password];
	if($user_email==NULL or $user_password==NULL){
		barring();
	}
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query', array($user_email));
	if(pg_num_rows($result)!=1){
		barring();
	}
	$result = pg_fetch_row($result);
	if($user_email == $result[1] and (hash('tiger128,3',$user_password) == $result[2] or $user_password == $result[2])){
		$_SESSION['userid'] = $user_email;
		pg_prepare($dbconnect,'update_query','UPDATE users SET user_lastauth = $1 WHERE user_email = $2');
		pg_execute($dbconnect, 'update_query', array(date("Y-m-d H:i:s"),$user_email));
		header('Location: userinfo.php');
		die();
	}
	barring();
?>