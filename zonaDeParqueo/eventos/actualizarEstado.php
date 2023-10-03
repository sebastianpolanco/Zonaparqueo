<?php
	include "conexion.php";

	$idUsuario = $_POST["idUsuario"];
	$zona = $_POST["zona"];
	$puesto = $_POST["puesto"];
	$estado = $_POST["estado"];
	$tipoDeAccion = $_POST["tipoDeAccion"];

	$mysqli = new mysqli($host, $user, $pw, $db); 

	$sqlActualizar = "UPDATE puestos set idEstado='$estado' where idZona = '$zona' and puesto = '$puesto'"; 

	$resActualizar = $mysqli->query($sqlActualizar);


	date_default_timezone_set('America/Bogota');
	$fecha =  date("Y-m-d");
	$hora = date("H:i:s");

	$sqlRegistro = "INSERT into registros (idUsuario, zona, puesto, estado,idTipoDeAccion, fecha, hora) VALUES ('$idUsuario', '$zona', '$puesto','$estado', '$tipoDeAccion', '$fecha', '$hora')"; 

	$resRegistro = $mysqli->query($sqlRegistro);

?>
