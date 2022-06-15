<?php

session_start();
require 'vendor/autoload.php';
use MongoDB\Client;
$client = new Client('mongodb://localhost:27017');
$usuarios = $client->casino->usuarios;
$usr = $usuarios->find(array(username => $_POST["username"], pass => $_POST["pass"]));
$login = false;

foreach($usr as $u){
    echo $u['username'] . "<br>";
    $login = true;
}

if($login){
    $_SESSION["user"] = Array("username" => $_POST["username"], "password" => $_POST["pass"]);
    header("Location:". $_SERVER['HTTP_REFERER']);
}else{
    die("No estas registrado o tu contraseña y/o ususario estan incorrectos.");
}
