<?php
	include "../eventos/conexion.php"; 

	$zona = $_GET["zona"];
	$puesto = $_GET["puesto"];
	$estado = $_GET["estado"];

	$mysqli = new mysqli($host, $user, $pw, $db); 
	$sql1 = "UPDATE puestos set idEstado='$estado' where idZona = '$zona' and puesto = '$puesto'"; 

	echo "sql1...".$sql1; 
	$result1 = $mysqli->query($sql1);
	echo "result es...".$result1;

	date_default_timezone_set('America/Bogota');
	$fecha =  date("Y-m-d");
	$hora = date("H:i:s");

	if($estado==1){
		$tipoDeAccion = 5;
	}elseif($estado==2){
		$tipoDeAccion = 2;
	}else{
		$tipoDeAccion = 3;
	}
	
	$sqlIdUsuario = "SELECT idUsuario from registros where zona = '$zona' and puesto = '$puesto' order by idRegistro DESC LIMIT 1"; 
	$resIdUsuario = $mysqli->query($sqlIdUsuario);
	$numFilas = $resIdUsuario->num_rows;

	if ($numFilas>0) {
		$rowIdUsuario = $resIdUsuario->fetch_array(MYSQLI_NUM);
		$idUsuario = $rowIdUsuario[0]; 

		$sqlRegistro = "INSERT into registros (idUsuario, zona, puesto, estado,idTipoDeAccion, fecha, hora) VALUES ('$idUsuario', '$zona', '$puesto','$estado', '$tipoDeAccion', '$fecha', '$hora')"; 

		$resRegistro = $mysqli->query($sqlRegistro);	
		echo "sqlRegistro...".$sqlRegistro; 
		echo "result es...".$resRegistro;
	}

?>