<?php 
	session_start();
	if(!isset($_SESSION['userid'])){
		header('Location: index.php');
		die();
	}
	$title = "Main Page";
	include "header.php";
	include "dbconnect.php";
	$result = pg_prepare($dbconnect,'connection_query','SELECT * FROM users WHERE 1=1 or $1');
	$result = pg_execute($dbconnect, 'connection_query', array(true));
	if(pg_num_rows($result)!=1){
		/*barring();*/
	}
 ?>
	<div class="container">
		<header>
			<div class="row justify-content-end">
				<div class="col-6">
					<div class="mainpage-header">
						<a href="userinfo.php">Профиль</a></div>
					</div>
				<div class="col-6">
					<div class="mainpage-header">
						<a href="logout.php">Выйти</a></div>
					</div>
			</div>
		</header>
		<div class="info-block">
			<div class="row text-center justify-content-between">
			<?php 
				for($i=0;$i<pg_num_rows($result);$i++){
				$subresult = pg_fetch_row($result,$i);
				include "userinfo_output.php";
				if($subresult[3]=="Active"){
					?>
					<div class="col-12 userlist">
					<?php	
				}else{
					?>
					<div class="col-12 userlist errorcolor">
					<?php	
				}
				?>
						<div class="row">
							<div class="col-4 userlist_desc">
								<a href="userinfo.php?id=<?php echo $subresult[1]?>"><?php echo $subresult[1]?></a>
							</div>
							<div class="col-4 userlist_desc">
								<?php echo $subresult[3]?>
							</div>
							<div class="col-4 userlist_desc">
								<?php echo $subresult[4]?>
							</div>
						</div>
						
					</div>
				<?php
				
			}
			?>
		</div>
		</div>
	</div>
<?php 
	include "footer.php";
 ?>