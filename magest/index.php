<?php
	include "sessioncheck.php";
	$error_message = $_GET['error'];
	$title = "Authorization";
	include "header.php";?>
	<div class="container">
		<header>
			<h1><a href="index.php">Magic forest</a></h1>
		</header>
		<div class="auth-form">
			<form action="login.php" method="POST">
				<input type="email" name="user_email" placeholder="Введите почту..." required>
				<input type="password" name="user_password" placeholder="Введите пароль..." required>
				<button type="submit">Войти</button>
			</form>
			<p><b><?php if($error_message!="") echo "<div class=\"error\">".$error_message."</div>";?></b></p>
			<a href="register.php">Еще нет аккаунта?</a>
		</div>
	</div>
	
<?php	
	include "footer.php";
?>
