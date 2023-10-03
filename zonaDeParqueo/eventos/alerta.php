<?php
	include "../eventos/conexion.php"; 

	$zona = $_GET["zona"];
	$puesto = $_GET["puesto"];
	$alerta = $_GET["alerta"];

	$mysqli = new mysqli($host, $user, $pw, $db); 
	$sql1 = "UPDATE puestos set alerta='$alerta' where idZona = '$zona' and puesto = '$puesto'";

	echo "sql1...".$sql1; 
	$result1 = $mysqli->query($sql1);
	echo "result es...".$result1;

?>