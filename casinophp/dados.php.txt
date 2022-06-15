<!doctype html>
<html lang="esp">

<?php include_once("header.php");
?>

<body>
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <center>
      <h1 class="display-4">Dados</h1>
      <form>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label class="text-light" for="validationTooltip02" >Apuesta</label>
            <select class="custom-select" id="validationTooltip01" required>
              <option selected disabled value="">Elige...</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label class ="text-light" for="validationTooltip02">Monto de apuesta</label>
            <input type="text" class="form-control" id="validationTooltip02" placeholder="1000" required>
          </div>
        </div>
        
        <button class="btn btn-primary col-md-6 mb-3" type="submit">Apostar</button>
      </form>
      <img src="https://i.pinimg.com/originals/69/33/61/6933611fc15dc04750cd0ec8a8c33300.gif" alt="Dados"
        class="img-thumbnail">
    </center>
  </div>
  <div class="container">

  <?php include_once("footer.php");
  ?>

  </div>

  <!--https://w7.pngwing.com/pngs/764/595/png-transparent-dice-game-gambling-dice-game-dice-game-dice-gambling.png-->
</body>
</htm>