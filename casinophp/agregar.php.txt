<?php
    session_start();
    require 'vendor/autoload.php';
    use MongoDB\Client;
    $client = new Client('mongodb://localhost:27017');
    $usuarios = $client->casino->usuarios;
    $movimientos = $client->casino->movimientos;

    $movimiento = array("username" => $_SESSION["user"]["username"], "detalle" => "Compra de créditos", "transacción" => $_POST["monto"],"estado" => "positivo", "fecha" => date("d-m-Y \a \l\a\s G:i:s"));
    $movimientos->insertOne($movimiento);

    print_r($_POST);
    $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] + $_POST["monto"];
    $usuarios->updateOne(["username" => $_SESSION["user"]["username"]], ['$set' => ["amount" => $total]]);

    header("Location:". $_SERVER['HTTP_REFERER']);
?>