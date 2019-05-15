<?php
	session_start();
	include "dbconnect.php";
	pg_prepare($dbconnect,'update_query','UPDATE users SET user_lastauth = $1 WHERE user_email = $2');
	pg_execute($dbconnect, 'update_query', array(date("Y-m-d H:i:s"),$_SESSION['userid']));
	session_unset();
	barring();
?>