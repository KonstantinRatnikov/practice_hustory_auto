<?php 
session_start();
$_SESSION['vin'] = $_POST['vin'];

exec('python3 /var/www/site1/capcha.py'  , $capcha_res);

$_SESSION['token1'] = $capcha_res[0];
$_SESSION['token2'] = $capcha_res[2];
$_SESSION['token3'] = $capcha_res[4];
$_SESSION['token4'] = $capcha_res[6];
$_SESSION['token5'] = $capcha_res[8];

$capcha_img1 = $capcha_res[1];  
$capcha_img2 = $capcha_res[3];  
$capcha_img3 = $capcha_res[5];  
$capcha_img4 = $capcha_res[7];  
$capcha_img5 = $capcha_res[9];

require "template/header.php";
?>

<form action="gibdd_search.php" method="post">
  <div class="form-group">
      <label for="name" class="form-label mt-5"><h3>Capcha для проверки истории авто:</h3><img src="data:image/png;base64, <?php echo($capcha_img1); ?> " alt="Capcha" /></label>
    <input onclick="this.select();" type="text" class="form-control" id="name" name="code1" value="Введите_капчу">
  </div>
  
  <div class="form-group">
      <label for="name" class="form-label mt-5"><h3>Capcha для проверки розыска авто:</h3><img src="data:image/png;base64, <?php echo($capcha_img2); ?> " alt="Capcha" /></label>
    <input onclick="this.select();" type="text" class="form-control" id="name" name="code2" value="Введите_капчу">
  </div>
  
  <div class="form-group">
      <label for="name" class="form-label mt-5"><h3>Capcha для проверки ограничений авто:</h3><img src="data:image/png;base64, <?php echo($capcha_img3); ?> " alt="Capcha" /></label>
    <input onclick="this.select();" type="text" class="form-control" id="name" name="code3" value="Введите_капчу">
  </div>
  
  <div class="form-group">
      <label for="name" class="form-label mt-5"><h3>Capcha для проверки дтп авто:</h3><img src="data:image/png;base64, <?php echo($capcha_img4); ?> " alt="Capcha" /></label>
    <input onclick="this.select();" type="text" class="form-control" id="name" name="code4" value="Введите_капчу">
  </div>
  
  <div class="form-group">
      <label for="name" class="form-label mt-5"><h3>Capcha для проверки диагностической карты авто:</h3><img src="data:image/png;base64, <?php echo($capcha_img5); ?> " alt="Capcha" /></label>
    <input onclick="this.select();" type="text" class="form-control" id="name" name="code5" value="Введите_капчу">
  </div>   
  
  <button type="submit" class="btn btn-primary">Отправить</button>
</form>


<?php
    require "template/footer.php";
?>