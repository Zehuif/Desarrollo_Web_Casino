<!doctype html>
<html lang="esp">

<?php include_once("header.php");
?>

	<body>
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <center>
                <h1 class="display-4">Cara o sello?</h1>
                <form>
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label class="text-light" for="validationTooltip02" >Apuesta</label>
                      <select class="custom-select" id="validationTooltip01" required>
                        <option selected disabled value="">Elige...</option>
                        <option value="1">Cara</option>
                        <option value="2">Sello</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class ="text-light" for="validationTooltip02">Monto de apuesta</label>
                      <input type="text" class="form-control" id="validationTooltip02" placeholder="1000" required>
                    </div>
                  </div>
                  
                  <button class="btn btn-primary col-md-6 mb-3" type="submit">Apostar</button>
                </form>
                <img src="https://sendmeapic.files.wordpress.com/2019/10/img_7541.gif" alt="Moneda" class="img-thumbnail">
            </center>
        </div>
        <div class="container">
        <?php include_once("footer.php");
        ?>
        </div>
        <!--https://miscoins.files.wordpress.com/2014/07/41-100p01.jpg-->    
	</body>
</htm>
