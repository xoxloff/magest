<?php
	session_start();
	if(!isset($_SESSION['userid'])){
		header('Location: index.php');
		die();
	}
	$user_get = $_GET['id'];
	if ($user_get == NULL){
		$user_get = $_SESSION['userid'];
	}
	
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query_user','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query_user', array($_SESSION['userid']));
	if(pg_num_rows($result)!=1){
		barring_auth();
	}
	$result = pg_fetch_row($result);
	if($result[4]==3){
		$isMaster = true;
	}else{
		$isMaster = false;
	}
	$result = pg_prepare($dbconnect,'connection_query_users','SELECT * FROM users WHERE user_email = $1');
	$result = pg_execute($dbconnect, 'connection_query_users', array($user_get));
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
				<img src="<?=$image_link?>" alt="">
				<div class="info-block_name">
					<label for=""><b><?=$subresult[8];?></b></label>
					<label for=""><b><?=$subresult[9];?></b></label>
				</div>
			</div>
			<form class="info-block_form">
				<label for=""><b>Email</b></label>
				<input type="text" value="<?=$subresult[1];?>" readonly>
				<label for=""><b>Password</b></label>
				<input type="password" value="********" readonly>
				<label for=""><b>Status</b></label>
				<input type="text" value="<?=$subresult[3];?>" readonly>
				<label for=""><b>Role</b></label>
				<input type="text" value="<?=$subresult[4];?>" readonly>
				<label for=""><b>Registration date</b></label>
				<input type="text" value="<?=$subresult[5];?>" readonly>
				<label for=""><b>Delete date</b></label>
				<input type="text" value="<?=$subresult[6];?>" readonly>
				<label for=""><b>Last authorization</b></label>
				<input type="text" value="<?=$subresult[7];?>" readonly>
			</form>
			<?php if(($user_get == $_SESSION['userid'] or $isMaster) and $subresult[3]!="Удален"){?>
			<button class="button_change" id="button_change_info">Изменить</button>
			<form action="update-userinfo.php" method="POST" id="info-block_change" class="info-block_form" style="display: none">
				<input type="text" name="user_oldemail" style="display: none" value="<?=$subresult[1] ?>">
				<label for=""><b>New Firstname</b></label>
				<input type="text" name="user_firstname" value="<?=$subresult[8];?>" require>
				<label for=""><b>New Lastname</b></label>
				<input type="text" name="user_lastname" value="<?=$subresult[9];?>">
				<label for=""><b>New Email</b></label>
				<input type="text" name="user_email" value="<?=$subresult[1];?>" require>
				<label for=""><b>New Role</b></label>
				<select name="user_role">
				  <option value="1">Гном</option>
				  <option value="2">Эльф</option>
				</select>
				<button class="button_change" type="submit" id="button_change">Сохранить</button>
			</form>
			<?php 
				if($isMaster && $user_get != $_SESSION['userid']){
					?>
					<form action="delete-user.php" method="POST">
						<input type="text" name="user_delete" style="display: none" value="<?=$subresult[1] ?>">
						<button class="button_change" type="submit">Удалить</button>
					</form>
				<?php
					}}
			?>
		</div>

	<script>
		$('#button_change_info').click(function(){
			if($('#button_change_info').text()=='Отменить'){
				$('#button_change_info').text('Изменить');
				$('#info-block_change').css('display','none');
			}
			else{
				$('#button_change_info').text('Отменить');
				$('#info-block_change').css('display','block');
			}
		});
		

	</script>
<?php	
	include "footer.php";
?>