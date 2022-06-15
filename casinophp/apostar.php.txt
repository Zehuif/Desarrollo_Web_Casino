<?php

session_start();
require 'vendor/autoload.php';
use MongoDB\Client;
$client = new Client('mongodb://localhost:27017');
$apuestas = $client->casino->apuestas;
print_r($_POST);
print_r($_SESSION);
$apuesta = array("juego" => $_POST["juego"], "username" => $_SESSION["user"]["username"], "monto" => $_POST["dinero"]);
print_r($apuesta);
$apuestas->insertOne($apuesta);
$_SESSION["user"]["amount"] -= $_POST["dinero"];
header("Location:". $_SERVER['HTTP_REFERER']);

?>