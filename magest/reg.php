<?php 
	/*Отвечает за регистрацию новых пользователей*/
	include "sessioncheck.php";
	$user_email = $_POST[user_email];
	$user_password = $_POST[user_password];
	$user_role = $_POST[user_role];/*Проверка на правильные данные (еще не реализовано)*/
	if($user_email==NULL or $user_password==NULL){
		barring();
	}
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query', array($user_email));
	if(pg_num_rows($result)>0){
		barring();
	}
	pg_prepare($dbconnect,'insert_query', 'INSERT INTO users(user_email, user_password, user_status, user_role, user_regdate) values($1,$2,$3,$4,$5)');
	pg_execute($dbconnect, 'insert_query', array($user_email, hash('tiger128,3',$user_password), 1, $user_role, date("Y-m-d H:i:s")));
/*Проверка на успешность авторизации (еще не реализовано)*/
	$_SESSION['userid'] = $user_email;
	header('Location: userinfo.php');
	die();
 ?>