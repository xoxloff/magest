<?php 
	/*Отвечает за регистрацию новых пользователей*/
	include "sessioncheck.php";
	$user_firstname = $_POST[user_firstname];
	$user_lastname = $_POST[user_lastname];
	$user_email = $_POST[user_email];
	$user_password = $_POST[user_password];
	$user_role = $_POST[user_role];
	if($user_role !=1 && $user_role !=2)
		$user_role = 1;
	/*Проверка на правильные данные (еще не реализовано)*/
	if($user_email==NULL or $user_password==NULL){
		barring_reg();
	}
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query', array($user_email));
	if(pg_num_rows($result)>0){
		barring_reg();
	}
	pg_prepare($dbconnect,'insert_query', 'INSERT INTO users(user_email, user_password, user_status, user_role, user_regdate, user_lastauth, user_firstname, user_lastname) values($1,$2,$3,$4,$5,$6,$7,$8)');
	pg_execute($dbconnect, 'insert_query', array($user_email, hash('tiger128,3',$user_password), 1, $user_role, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $user_firstname, $user_lastname));
/*Проверка на успешность авторизации (еще не реализовано)*/

	$user_check = pg_prepare($dbconnect,'connection_check','SELECT * FROM users WHERE user_email = $1');
	$user_check = pg_execute($dbconnect, 'connection_check', array($user_email));
	if(pg_num_rows($user_check)!=1)
		barring_auth();
	else{
		$_SESSION['userid'] = $user_email;
		header('Location: userinfo.php');
	}
	die();
 ?>