<!doctype html>
<html lang="esp">
  
<?php include_once("header.php");
require 'vendor/autoload.php';
use MongoDB\Client;

if ($_POST["juego"] != null && $_SESSION["user"]["username"] != null && $_POST["dinero"] <= $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"]){
  $client = new Client('mongodb://localhost:27017');
  $movimientos = $client->casino->movimientos;
  $movimiento = array("username" => $_SESSION["user"]["username"], "detalle" => $_POST["juego"], "transacción" => $_POST["dinero"], "apuesta" => $_POST["apuesta"], "estado" => "null", "fecha" => date("d-m-Y \a \l\a\s G:i:s"));
  $movimientos->insertOne($movimiento);
}

$resultado = array();
$resultado[] = array("tipo" => "alert alert-success");
$resultado[] = array("tipo" => "alert alert-danger");
$resultado[] = array("tipo" => "");

$randomNumber = rand(0, 36);
//$randomNumber = 1;
$message = "";

if (isset($_POST["dinero"]) && isset($_POST["apuesta"])){

  ?>

  <script>

  $(function() {

    function rotate(numero) {
    
    grados = [-6, 131, 296, 14, 315, 170, 257, 413, 559, 92, 180, 219, 33, 238, 112, 335, 
              151, 277, 72, 325, 122, 305, 82, 189, 160, 286, 4, 248, 43, 62, 209,
              102, 344, 140, 267, 24, 228]

      $("#ruleta-img").css({'transform': 'rotate('+parseInt(3600+grados[numero])+ 'deg)'});
    }
    rotate(<?php echo($randomNumber) ?>);

  });

  </script>

  <?php

  if ($_POST["apuesta"] == $randomNumber && $_POST["dinero"] <= $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"]) {
    $message = "Eligiste el numero ".$_POST["apuesta"]." y ha salido el numero ".$randomNumber.".
                Usted ha <strong>GANADO</strong> y cuadruplicado ".$_POST["dinero"]." pesos.";
    $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] + 4 * $_POST["dinero"];
    $usuarios->updateOne(["username" => $_SESSION["user"]["username"]], ['$set' => ["amount" => $total]]);
    $estado = "positivo";
    $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["estado" => $estado]]);
    $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["transacción" => $_POST["dinero"]*4]]);

    ?>
    <script>
    $(function() {  
      setTimeout(function() {
      $("#messageRuletaCorrecto").css({'display': 'block'});
      }, 4000);
     });
     </script>
     <meta http-equiv="refresh" content="6">
    
    <?php            
  }else if($_POST["dinero"] <= $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"]){
    $message = "Eligiste el numero ".$_POST["apuesta"]." y ha salido el numero ".$randomNumber.".
                Usted ha PERDIDO ".$_POST["dinero"]." pesos.";
    $total = $usuarios->findOne(array("username" => $_SESSION["user"]["username"]),array("amount"))["amount"] - $_POST["dinero"];
    $usuarios->updateOne(["username" => $_SESSION["user"]["username"]], ['$set' => ["amount" => $total]]);
    $estado = "negativo";
    $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["estado" => $estado]]);
    $movimientos->updateOne(["username" => $_SESSION["user"]["username"], "fecha" => date("d-m-Y \a \l\a\s G:i:s")], ['$set' => ["transacción" => $_POST["dinero"]*-1]]);

    ?>
    <script>
    $(function() {  
      setTimeout(function() {
        $("#messageRuletaIncorrecto").css({'display': 'block'});
        //$("#headermessage").load("http://18.232.89.245/ruleta.php" + " #headermessage");      
      }, 4000);
      });
    </script>
      <meta http-equiv="refresh" content="6">
    <?php     
  }else{
    $message = "Usted no ha iniciado sesión o no posee suficientes créditos. Para comprar créditos dirijase a Cuenta->Comprar créditos.";
    ?>
    <script>
    $(function() {  
      setTimeout(function() {
        $("#messageRuletaNoValido").css({'display': 'block'});
      }, 4000);
      });
      </script>
    <?php  
  }
}

?>
	<body>
      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <center>
            <h1 class="display-4">Ruleta</h1>
            <form method="POST">
              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label class ="text-light" for="validationTooltip01">Ingrese su apuesta</label>
                  <input name ="apuesta" type="number" min="0" max="36" class="form-control" placeholder="Elige un numero del 0 al 36" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label class ="text-light" for="validationTooltip02">Monto de apuesta</label>
                  <input name ="dinero" type="number" min="1" class="form-control" placeholder="1000" required>
                </div>
                <input name ="juego" type="hidden" value="Ruleta">
              </div>
              <button class="btn btn-primary col-md-6 mb-3" type="submit" data-target="#resultado-apuesta">Apostar</button>
            </form>
            <div class="alert alert-success" role="alert" id='messageRuletaCorrecto' style='display:none;' ><?php echo $message;?></div>
            <div class="alert alert-danger" role="alert" id='messageRuletaIncorrecto' style='display:none;' ><?php echo $message;?></div>
            <div class="alert alert-warning" role="alert" id='messageRuletaNoValido' style='display:none;' ><?php echo $message;?></div>

            <div id="ruleta-img-container">
            <div id="ruleta-indicador"></div>
              <img id="ruleta-img"  src="img/Ruleta.png" alt="Ruleta" class="shadow-sm rounded-circle">
              
            </div>
        </center>
      </div>
      <div class="container">

        <?php include_once("footer.php");
        ?>

      </div>    
	</body>
</htm>
