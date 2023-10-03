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
    $idTipodeAccion = $rowH[5];
    $fecha = $rowH[6];
    $hora = $rowH[7];

    date_default_timezone_set('America/Bogota');
    $horaActual = date("H:i:s");
    $fechaActual =  date("Y-m-d");

    $final = date_create($hora);
    $inicio = date_create($horaActual);
    $diferen = date_diff($inicio, $final);

    $tiempo = $diferen-> days * 24 * 60;
    $tiempo += $diferen-> h * 60;
    $tiempo += $diferen-> i;
    $minutos = $tiempo;
    $tiempo += $diferen-> s;
    $segundos = $tiempo;


    if($estado==3){
      $min = 5 - $minutos;
      if ($min<=4) {
        echo "5";
      }else{
      echo "0";
      }
    }elseif($estado==2 and $idTipodeAccion ==1){
      $min = 15 - $minutos;
      if ($min<=14) {
        $sqlTarifa = "SELECT tarifa,tarifaAdicional from registrostarifas WHERE idUsuario='$idUsuario' order by id DESC LIMIT 1"; 
        $resTarifa = $mysqli->query($sqlTarifa);
        $rowTarifa = $resTarifa->fetch_array(MYSQLI_NUM);
        $tarifa = $rowTarifa[0];
        $tarifaAdicional = $rowTarifa[1];
        $tarifaAdicional = $tarifa + $tarifaAdicional;

        $sqlUTarifa = "UPDATE registrostarifas SET tarifaAdicional='$tarifaAdicional' WHERE idUsuario='$idUsuario' order by id DESC LIMIT 1";
        $mysqli->query($sqlUTarifa);

        $sqlURegistros = "UPDATE registros SET fecha ='$fechaActual', hora = '$horaActual' WHERE idUsuario='$idUsuario' order by idRegistro DESC LIMIT 1";
        $mysqli->query($sqlURegistros);
        echo "15";  
      }else{
        echo "0";
      }
    }else{
      echo "0";
    }
  }else{
    echo "0";
  }
?>
