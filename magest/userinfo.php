<?php
	session_start();
	if(!isset($_SESSION['userid'])){
		header('Location: index.php?error=Учетные данные введены неверно!');
		die();
	}
	$user_get = $_GET['id'];
	if ($user_get == NULL){
		$user_get = $_SESSION['userid'];
	}
	
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query', array($user_get));
	if(pg_num_rows($result)!=1){
		barring();
	}
	$subresult = pg_fetch_row($result);
	include "userinfo_output.php";
	$title = "Main Page";
	include "header.php";?>
	<div class="container">
		<header>
			<div class="row justify-content-end">
				<div class="col-6">
					<div class="mainpage-header">
						<a href="userlist.php">Список пользователей</a></div>
					</div>
				<div class="col-6">
					<div class="mainpage-header">
						<a href="logout.php">Выйти</a></div>
					</div>
			</div>
		</header>
		<div class="info-block">
			<div class="info-block_image">
				<img src="<?php echo $image_link?>" alt="">
			</div>
			<form class="info-block_form">
				<label for=""><b>Email</b></label>
				<input type="text" value="<?php echo $subresult[1];?>" readonly>
				<label for=""><b>Password</b></label>
				<input type="password" value="********" readonly>
				<label for=""><b>Status</b></label>
				<input type="text" value="<?php echo $subresult[3];?>" readonly>
				<label for=""><b>Role</b></label>
				<input type="text" value="<?php echo $subresult[4];?>" readonly>
				<label for=""><b>Registration date</b></label>
				<input type="text" value="<?php echo $subresult[5];?>" readonly>
				<label for=""><b>Delete date</b></label>
				<input type="text" value="<?php echo $subresult[6];?>" readonly>
				<label for=""><b>Last authorization</b></label>
				<input type="text" value="<?php echo $subresult[7];?>" readonly>
			</form>
		</div>
	</div>
	
<?php	
	include "footer.php";
?>