<?php
	include "conexion.php";

	$idUsuario = $_POST["idUsuario"];
	$zona = $_POST["zona"];
	$puesto = $_POST["puesto"];
	$estado = $_POST["estado"];
	$tipoDeAccion = $_POST["tipoDeAccion"];
	$alerta = $_POST["alerta"];

	$mysqli = new mysqli($host, $user, $pw, $db); 

	$sqlActualizar = "UPDATE puestos set alerta = '$alerta', idEstado='$estado' where idZona = '$zona' and puesto = '$puesto'"; 

	$resActualizar = $mysqli->query($sqlActualizar);

	$sqlConsultaP= "SELECT idUsuario FROM registros where puesto='$puesto' and zona='$zona' order by idRegistro DESC LIMIT 1"; 

	$resConsultaP = $mysqli->query($sqlConsultaP);
	$rowConsultaP = $resConsultaP->fetch_array(MYSQLI_NUM);
    $idUsuarioC = $rowConsultaP[0];

    $sqlRegistro = "INSERT into registros (idUsuario, zona, puesto, estado,idTipoDeAccion, fecha, hora) VALUES ('$idUsuarioC', '$zona', '$puesto',1, 4, '$fecha', '$hora')"; 

	$resRegistro = $mysqli->query($sqlRegistro);

	date_default_timezone_set('America/Bogota');
	$fecha =  date("Y-m-d");
	$hora = date("H:i:s");

	$sqlRegistro = "INSERT into registros (idUsuario, zona, puesto, estado,idTipoDeAccion, fecha, hora) VALUES ('$idUsuario', '$zona', '$puesto','$estado', '$tipoDeAccion', '$fecha', '$hora')"; 

	$resRegistro = $mysqli->query($sqlRegistro);

?>
