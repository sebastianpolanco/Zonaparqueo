<?php
  $idUsuario = $_POST['idUsuario'];

  include "../eventos/conexion.php";
  $mysqli = new mysqli($host, $user, $pw, $db); 
  $sqlHora = "SELECT * from registros WHERE idUsuario='$idUsuario' order by idRegistro DESC LIMIT 1"; 
  $resHora = $mysqli->query($sqlHora);
  $numFilasH = $resHora->num_rows; 

  if($numFilasH!=0){
    $rowH = $resHora->fetch_array(MYSQLI_NUM);
    $zona = $rowH[2];
    $puesto = $rowH[3];
    $estado = $rowH[4];
    $fecha = $rowH[6];
    $hora = $rowH[7];

    date_default_timezone_set('America/Bogota');
    $horaActual = date("H:i:s");

    $final = date_create($hora);
    $inicio = date_create($horaActual);
    $diferen = date_diff($inicio, $final);

    $tiempo = $diferen-> days * 24 * 60;
    $tiempo += $diferen-> h * 60;
    $tiempo += $diferen-> i;
    $minutos = $tiempo;
    $tiempo += $diferen-> s;
    $segundos = $tiempo;
    $tarifa = $segundos*10;

    if($estado==3){
      $min = 5 - $minutos;
      echo "".$min;
    }elseif($estado==2){
      $min = 15 - $minutos;
      echo "".$min;
    }
  }
?>