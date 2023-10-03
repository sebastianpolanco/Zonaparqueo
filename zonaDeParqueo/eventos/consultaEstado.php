<?php
include "../eventos/conexion.php";  
$zona = $_GET["zona"];
$mysqli = new mysqli($host, $user, $pw, $db); 

//Consulta estado puesto 1
$sql1 = "SELECT idEstado from puestos where idZona = '$zona' and puesto = 1"; 

$result1 = $mysqli->query($sql1);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$estado1 = $row1[0];  

$long_estado1= strlen($estado1);
for ($i=$long_estado1;$i<2;$i++)
  {
    $estado1 = "0".$estado1;
  }

//Consulta estado puesto 2
$sql2 = "SELECT idEstado from puestos where idZona = '$zona' and puesto = 2"; 

$result2 = $mysqli->query($sql2);
$row2 = $result2->fetch_array(MYSQLI_NUM);
$estado2 = $row2[0];  

$long_estado2= strlen($estado2);
for ($i=$long_estado2;$i<2;$i++)
  {
    $estado2 = "0".$estado2;
  }

  echo $estado1.$estado2;

?>