
<?php
session_start();
date_default_timezone_set('America/Santiago');
header('Content-Type: application/json');
$ruta = explode("v1.0.php/",$_SERVER['REQUEST_URI'])[1];
$ruta = explode("/", $ruta);

//print_r($ruta);

require '../vendor/autoload.php';
use MongoDB\Client;
$client = new Client('mongodb://localhost:27017');

switch($ruta[0]){
    case "historial":
        if($_SESSION["user"]["username"]){
            $colection = $client->casino->movimientos;
            $movimientos = $colection->find(["username" => $_SESSION["user"]["username"]]);
            echo json_encode(iterator_to_array($movimientos));
        }else{
            echo json_encode(false);
        }
    break;

    case "login":
        if(!isset($ruta[1])){
             echo json_encode(array('message' => 'No user')); 
             die();
        }
        if(!isset($_POST["password"])){
             echo json_encode(array('message' => 'No password')); 
             die();
        }
        $usuarios = $client->casino->usuarios;
        $usr = $usuarios->find(array(username => $ruta[1], pass => $_POST["password"]));
        $login = false;
        foreach($usr as $u){
            $login = true; 
        }
        if($login){
            $_SESSION["user"] = Array("username" => $ruta[1], "password" => $_POST["password"]);
            echo json_encode(Array("username" => $ruta[1], "monto" => $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"]));
        }else{
            echo json_encode(false);
        }
    break;

    case "logout":
        if(session_destroy()) echo json_encode(true);
        else echo json_encode(false);
    break;

    case "register":
        if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){
            $usuarios = $client->casino->usuarios;
    
            $insertOneResult = $usuarios->insertOne([
                'username' => $_POST["username"],
                'email' => $_POST["email"],
                'pass' => $_POST["password"],
                'amount'=> 0
            ]);
            echo json_encode(Array('message' => 'registrado'));
        }else echo json_encode(false);
    break;

    case "agregar":
        if(isset($_POST["monto"])){
            
            $usuarios = $client->casino->usuarios;
            $movimientos = $client->casino->movimientos;

            $movimiento = array("username" => $_SESSION["user"]["username"], "detalle" => "Compra de créditos", "transacción" => $_POST["monto"],"estado" => "positivo", "fecha" => date("d-m-Y \a \l\a\s G:i:s"));
            $movimientos->insertOne($movimiento);

            $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] + $_POST["monto"];
            $usuarios->updateOne(["username" => $_SESSION["user"]["username"]], ['$set' => ["amount" => $total]]);
            echo json_encode(Array('message' => 'comprado'));
        }else echo json_encode(false);
    break;

    case "ruleta":
        $movimientos = $client->casino->movimientos;
        $movimiento = array("username" => $_SESSION["user"]["username"], "detalle" => $_POST["juego"], "transacción" => $_POST["dinero"], "apuesta" => $_POST["apuesta"], "estado" => "null", "fecha" => date("d-m-Y \a \l\a\s G:i:s"));
        $movimientos->insertOne($movimiento);
        $randomNumber = rand(0, 36);

        if ($_POST["apuesta"] == strval($randomNumber) ) {

            $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] + 4 * $_POST["dinero"];
            $usuarios->updateOne(["username" => $_SESSION["user"]["username"]], ['$set' => ["amount" => $total]]);

            $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["estado" => "positivo"]]);
            $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["transacción" => $_POST["dinero"]*4]]);
            echo json_encode(Array('resultado' => 'ganar', 'number' => $randomNumber));

        }else {

            $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] - $_POST["dinero"];
            $usuarios->updateOne(["username" => $_SESSION["user"][$_POST["username"]]], ['$set' => ["amount" => $total]]);

            $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["estado" => "negativo"]]);
            $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["transacción" => $_POST["dinero"]*-1]]);
            echo json_encode(Array('resultado' => 'perder', 'number' => $randomNumber));

        }
        


    break;

    default:
        echo json_encode(Array('message' => 'API v1.0'));
}
?>
