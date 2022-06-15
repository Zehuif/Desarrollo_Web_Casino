<?php
session_start();
date_default_timezone_set('America/Santiago');
require 'vendor/autoload.php';
use MongoDB\Client;
$client = new Client('mongodb://localhost:27017');
$usuarios = $client->casino->usuarios;
?>

<head>
	<meta charset="utf-8">
	<title>Casino</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
		integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>

<header>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark">
			<a class="navbar-brand" href="index.php">
				<img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/10/casino-logo.jpg" width="70"
					height="45" class="d-inline-block align-center" alt="Imagen casino" loading="lazy">
				Casino
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="ruleta.php">Ruleta</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dados.php">Dados</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="moneda.php">Cara o sello?</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="informacion.php">Información de casino</a>
					</li>
					<?php
					if(isset($_SESSION["user"])) {
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Cuenta
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="comprar.php">Comprar créditos</a>
						<a class="dropdown-item" href="registro.php">Registro de apuestas</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php">Logout</a>
						</div>
					</li>
					<?php
					}
					?>
				</ul>
				<?php
				if(isset($_SESSION["user"])) {
				?>
				<div id="headermessage">
					<p class="font-weight-lighter">Hola <?php echo $_SESSION["user"]["username"]; ?> te quedan <?php echo $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"]; ?> créditos</p>
				</div>
				<?php
				}else{
				?>
				<form class="form-inline" method="POST" action="login.php">
					<div class="from-group">
						<input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" name="username" placeholder="Usuario">
					</div>
					<div class="from-group">
						<input type="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputGroupUsername2" name="pass" placeholder="Contraseña">
					</div>
					<div class="form mr-sm-2">
						<button type="submit" class="btn btn-primary mb-2">Ingresar</button>
					</div>
					<div class="form mr-sm-2">
						<a href="register.php" class="btn btn-success mb-2" role="button" aria-pressed="true">Registrarse</a>
					</div>
				</form>
				<?php } ?>
			</div>
		</nav>
    </header>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
		integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
		crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
		integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
		integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
		crossorigin="anonymous"></script>