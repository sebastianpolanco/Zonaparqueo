<?php
include "../eventos/conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.

$zona = $_POST["zona"];
$puesto = $_POST["puesto"];

$mysqli = new mysqli($host, $user, $pw, $db); 

$sql1 = "UPDATE puestos set idEstado=3 where idZona = '$zona' and puesto = '$puesto'"; 
$result1 = $mysqli->query($sql1);
echo "result es...".$result1;

?>