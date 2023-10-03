<?php
  $idUsuario = $_POST['idUsuario'];
  $zona = $_POST['zona'];
  $puesto = $_POST['puesto'];

  include "../eventos/conexion.php";
  $mysqli = new mysqli($host, $user, $pw, $db); 

  $sqlHora = "SELECT hora from registros WHERE idUsuario='$idUsuario' and idTipoDeAccion= 2 order by idRegistro DESC LIMIT 1"; 
  $resHora = $mysqli->query($sqlHora);

  $rowH = $resHora->fetch_array(MYSQLI_NUM);
  $hora = $rowH[0];

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
  if($minutos==0){
    $tarifa = 700;
  }else{
    $tarifa = $minutos * 100;
  }


  $sqlRegistro = "INSERT into registrostarifas (idUsuario, tarifa, fecha, hora, zona, puesto, tarifaAdicional) VALUES ('$idUsuario', '$tarifa', '$fechaActual', '$horaActual', '$zona', '$puesto', 0)"; 

  $resRegistro = $mysqli->query($sqlRegistro); 

?>
