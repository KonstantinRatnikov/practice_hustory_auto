<?php
    session_start();
    require "system/functions.php";
    $ip_addr = $_SERVER['REMOTE_ADDR'];
    $log_date = date('Y-m-d H:i:s');
    $vin = $_SESSION['vin'];
    $link = mysqli_connect("mysql","root","kostya.1100","practice");
    if($link == false){
	   exit( 'Ошибка подключения к БД');
	}
    $q = 'INSERT INTO log_gibdd (date,ip,vin) values ("'.$log_date.'","'.$ip_addr.'","'.$vin.'")' ;
    $res = mysqli_query($link,$q);

    //Удаляю все пробелы, зарделители и тд
    $token1 = preg_replace('/\s+/', '', $_SESSION['token1']);
    $token2 = preg_replace('/\s+/', '', $_SESSION['token2']);
    $token3 = preg_replace('/\s+/', '', $_SESSION['token3']);
    $token4 = preg_replace('/\s+/', '', $_SESSION['token4']);
    $token5 = preg_replace('/\s+/', '', $_SESSION['token5']);

    $code1 = preg_replace('/\s+/', '', $_POST['code1']);
    $code2 = preg_replace('/\s+/', '', $_POST['code2']);
    $code3 = preg_replace('/\s+/', '', $_POST['code3']);
    $code4 = preg_replace('/\s+/', '', $_POST['code4']);
    $code5 = preg_replace('/\s+/', '', $_POST['code5']);

    $command ='python3 /var/www/html/main.py '.$vin.' '.$token1.' '.$code1.' '.$token2.' '.$code2.' '.$token3.' '.$code3.' '.$token4.' '.$code4;
    //echo($command);
    exec($command, $exec_res);
    //var_dump($exec_res);

    //Диагностика
    $command_dk = 'python3 /var/www/html/dk.py '.$vin.' '.$token5.' '.$code5;
    exec($command, $exec_res);

    $q = 'SELECT * FROM gibdd where vin ="'.$vin.'" LIMIT 1';
    //echo($q);
    $res = mysqli_query($link,$q);
    $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $errors = array();
    if(empty($res)){
        $errors[] = 'Автомобиль не найден в базе';
        $_SESSION['danger'] = $errors;
        //header('Location: gibdd_find.php');
    }
    else{
        $_SESSION['danger'] =[];
    }
    $dtp_q = 'SELECT * FROM gibdd_dtp where vin ="'.$vin.'"';
    $res_dtp = mysqli_query($link,$dtp_q);
    $res_dtp = mysqli_fetch_all($res_dtp, MYSQLI_ASSOC);

    $wanted_q = 'SELECT * FROM gibdd_wanted where w_vin ="'.$vin.'"';
    $res_wanted = mysqli_query($link,$wanted_q);
    $res_wanted = mysqli_fetch_all($res_wanted, MYSQLI_ASSOC);

    $restrict_q = 'SELECT * FROM gibdd_restrict where tsVIN ="'.$vin.'"';
    $res_restrict = mysqli_query($link,$restrict_q);
    $res_restrict = mysqli_fetch_all($res_restrict, MYSQLI_ASSOC);

    $DK_q = 'SELECT * FROM gibdd_dk where vin ="'.$vin.'"';
    $res_dk = mysqli_query($link,$DK_q);
    $res_dk = mysqli_fetch_all($res_dk, MYSQLI_ASSOC);
    require "template/header.php";

?>
  <main class="flex-shrink-0">
      <div class="container ">
      <div class="w-50 mx-auto ">
      <?php
          generateHistory($res[0]);
          generateWanted($res_wanted);
          generateRestrict($res_restrict);
          generateDK($res_dk);
          generateDtp($res_dtp);
      ?>
      </div>
      </div>

  </main>

<?php
    require "template/footer.php";
?>
