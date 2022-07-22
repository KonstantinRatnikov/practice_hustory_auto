<?php
    session_start();
    require "template/header.php";
    require "system/functions.php";
    $errors = array();
    if(!empty($_SESSION['danger']))
    {
        $errors = $_SESSION['danger'];
        alerts('danger', $errors);
    }  
?>
  <main class="flex-shrink-0">
      <div class="container ">
      <div class="w-50 mx-auto ">
      <h1 class="mt-5">Проверка юридической чистоты автомобиля</h1>
      <form action="capcha.php" method="post">
          <div class="">
	        <label for="name" class="form-label mt-5">Укажите VIN номер автомобиля:</label>
	        <input type="text" class="form-control" id="name" name="vin" placeholder="WDD2130431A224736">
	      </div>
          <button type="submit" class="btn btn-dark mt-3">Поиск</button>
      </form>
      </div>
      </div>
  </main>
<?php
    require "template/footer.php";
?>