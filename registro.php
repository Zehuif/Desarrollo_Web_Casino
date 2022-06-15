<!doctype html>
<html lang="esp">

<?php include_once("header.php");
require 'vendor/autoload.php';
use MongoDB\Client;
$client = new Client('mongodb://localhost:27017');
$colection = $client->casino->movimientos;
$movimientos = $colection->find(["username" => $_SESSION["user"]["username"]]);
?>

<body>
<table class="table table-dark table-sm table-bordered">
  <thead>
    <tr>
      <th scope="col">Fecha y hora</th>
      <th scope="col">Detalle</th>
      <th scope="col">Apuesta</th>
      <th scope="col">Transacción</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <?php
      foreach($movimientos as $mov){
        if($mov["estado"] == "positivo"){
          ?><style>#positivo{'display': 'block';}</style><?php
        }
    ?>
    
    <?php if($mov["estado"] == "negativo") echo '<tr class="bg-danger">' ?> 
    <?php if($mov["estado"] == "positivo") echo '<tr class="bg-success">' ?>
      <th scope="row"><?php echo $mov["fecha"]; ?></th>
      <td><?php echo $mov["detalle"]; ?></td>
      <td><?php echo $mov["apuesta"]; ?></td>
      <td><?php echo $mov["transacción"]; ?></td>

    </tr>
    <?php } ?>
  </tbody>
</table>

  <?php include_once("footer.php");
  ?>

  </div>

</body>
</htm>