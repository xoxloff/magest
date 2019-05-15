<?php
	include "sessioncheck.php";
	$title = "Registration";
	include "header.php";?>
	<div class="container">
		<header>
			<h1><a href="index.php">Magic forest</a></h1>
		</header>
		<div class="auth-form">
			<form action="reg.php" method="POST">
				<input type="email" name="user_email" placeholder="Введите почту..." required>
				<input type="password" name="user_password" placeholder="Введите пароль..." required>
				<select name="user_role">
				  <option value="1">Гном</option>
				  <option value="2">Эльф</option>
				  <option value="3">Мастер гном</option>
				</select>
				<!--<input type="text" name="user_role" placeholder="Укажите роль..." required>-->
				<button type="submit">Зарегистрироваться</button>
			</form>
		</div>
	</div>
	
<?php	
	include "footer.php";
?>