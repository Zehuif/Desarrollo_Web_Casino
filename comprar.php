<!doctype html>
<html lang="esp">

<?php include_once("header.php");
?>

<body>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">Comprar créditos</h1>
            <form method="POST" action="agregar.php">
                <div class="form-group row">
                    <div class="col-sm-12 col-form-label">
                        <label class ="text-light " for="validationTooltip01">Monto</label>
                        <input name ="monto" type="number" min="0" class="form-control" placeholder="10000" required>
                    </div>
                </div>
                <button class="btn btn-primary col-md-6 mb-3" type="submit" data-target="#resultado-apuesta">Comprar</button>
            </form>
    </div>

  <?php include_once("footer.php");
  ?>

  </div>

</body>
</htm>