<div class="owl-carousel" id="owl-banner">
<?php
/*Add o link connection para pegar os dados do banco*/
	$link = mysqli_connect("localhost", "root", "", "lisieux_treinamento");

	mysqli_set_charset($link,"utf8");

	$query = mysqli_query($link, "SELECT * FROM ci_banner WHERE ic_banner_status = 1 ORDER BY banner_position ASC");
	
	while($row = mysqli_fetch_assoc($query)){
		echo '<div class="item_slider">';
		echo 	'<picture>';
		echo 		'<source media="(min-width: 768px)" srcset="'.$row['nm_url_banner'].'">';
		echo 		'<img class="img-responsive" src="'.$row['nm_url_banner_mobile'].'" >';
		echo 	'</picture>';
		echo 	'<div class="caption">';
		echo 		'<h3>';
		echo 			'<strong>Cursos, Treinamentos e Palestras na área da Saúde</strong><br>';
		echo 			''.$row['nm_subtitle_banner'].'';
		echo 		'</h3>';
		//echo 		'<a href="'.$row['banner_link'].'/?modal=false#inscricao"><span>INSCREVA-SE</span></a>';
		echo 	'</div>';
		echo '</div>';
	}
?>
</div>