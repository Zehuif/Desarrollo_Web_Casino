<!doctype html>
<html lang="esp">

<?php include_once("header.php");
$juegos = array();

$juegos[] = array("nombre" => "RULETA", "inf" => "Cuatruplica tu apuesta!!!", "href" => "ruleta.php", "img" => "https://m.gifanimados.com/Gifs-Objetos/Animaciones-Juguetes/Casino/Ruleta/Ruleta-Casino-89320.gif");
$juegos[] = array("nombre" => "DADOS", "inf" => "Tira y gana", "href" => "dados.php", "img" => "https://i.pinimg.com/originals/69/33/61/6933611fc15dc04750cd0ec8a8c33300.gif");
$juegos[] = array("nombre" => "MONEDA", "inf" => "50% de probabilidad de ganar", "href" => "moneda.php", "img" => "https://sendmeapic.files.wordpress.com/2019/10/img_7541.gif");

?>

<body>
	<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		<center>
			<h1 class="display-1">Bienvenido a Casino Online</h1>
			<picture>
				<img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/10/casino-logo.jpg"
					class="avatar img-fluid img-thumbnail" alt="Casino logo">
			</picture>
		</center>
	</div>
		
	<div class="container">
		<div class="card-deck">
			<?php 
				foreach($juegos as $juego){
			?>	
			<div class="card text-white bg-dark">
				<div class="card-header bg-transparent text-center font-weight-bolder"><?php echo $juego["nombre"];?></div>
					<img src=<?php echo $juego["img"];?> class="card-img-top" alt=<?php echo $juego["nombre"];?>>
					<div class="card-body">
						<p class="card-text"><?php echo $juego["inf"];?></p>
					</div>
					<div class="card-footer">
						<a role="button" href=<?php echo $juego["href"];?> class="btn btn-success btn-lg btn-block">Jugar</a>
					</div>
				</div>
				<?php } ?>
			</div>
		<?php include_once("footer.php");
		?>
		</div>
	</div>
</body>
</html>
