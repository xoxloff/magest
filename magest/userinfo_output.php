<?php 
	if($subresult[3]==1){
		$subresult[3] = "Active";
	}else{
		$subresult[3] = "Disabled";
	}
	if($subresult[4]==1){
		$image_link = "https://avatarko.ru/img/kartinka/28/gnom_27079.jpg";
		$subresult[4] = "Gnome";
	}
	if($subresult[4]==2){
		$image_link = "https://i.pinimg.com/originals/a5/35/0d/a5350d290c6f2e17360695ee58d81ca4.jpg";
		$subresult[4] = "Elf";
	}
	if($subresult[4]==3){
		$image_link = "http://asset-b.soupcdn.com/asset/12095/2493_b3c1_520.jpeg";
		$subresult[4] = "Master Gnome";
	}
 ?>