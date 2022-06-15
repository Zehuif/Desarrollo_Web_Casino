<!doctype html>
<html lang="esp">

<?php include_once("header.php");
?>

<body>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Registro</h1>
    <?php
    require 'vendor/autoload.php';
    use MongoDB\Client;
    if ($_POST["username"] != null && $_POST["email"] != null && $_POST["pass"] != null){
        $client = new Client('mongodb://localhost:27017');
        $usuarios = $client->casino->usuarios;

        $insertOneResult = $usuarios->insertOne([
            'username' => $_POST["username"],
            'email' => $_POST["email"],
            'pass' => $_POST["pass"],
            'amount'=> 0
        ]);
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert" text="center">
             Gracias por registrarte, <strong>inicia sesión</strong> para poder jugar.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php
    }
?>
    <form method="POST">
        <div class="form-group row">
            <div class="col-sm-4 col-form-label">
                <label class ="text-light " for="validationTooltip01">Nombre</label>
                <input name ="username" type="text" class="form-control" placeholder="Pepe" required>
            </div>
            <div class="col-sm-4 col-form-label">
                <label class ="text-light" for="validationTooltip02">Email</label>
                <input name ="email" type="email" class="form-control" placeholder="pepe@gmail.com" required>
            </div>
            <div class="col-sm-4 col-form-label">
                <label class ="text-light" for="validationTooltip02">Contraseña</label>
                <input name ="pass" type="password" class="form-control" placeholder="" required>
            </div>
        </div>
        <button class="btn btn-primary col-md-6 mb-3" type="submit">Registrarse</button>
    </form>
  </div>


  <?php include_once("footer.php");
  ?>

  </div>

</body>
</htm>