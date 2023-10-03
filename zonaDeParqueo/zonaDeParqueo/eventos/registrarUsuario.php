<?php
	
	$nombreUsuario = $_POST['nombreUsuario'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$contrasena = $_POST['contrasena'];
	$contrasenaCD = md5($contrasena);
	session_start();

	include "../eventos/conexion.php";
	$mysqli = new mysqli($host, $user, $pw, $db); 

	$sqlUsuario = "SELECT * FROM usuarios where usuario='$nombreUsuario'";
	$resUsuario = $mysqli->query($sqlUsuario);
	$numFilas = $resUsuario->num_rows;

	if($numFilas>0){
		echo "0";
	}else{
		$sqlRegistro = "INSERT INTO usuarios(usuario, contrasenia, nombres, apellidos, idTipoUsuario) values('$nombreUsuario', '$contrasenaCD', '$nombre', '$apellido', 2)";
		$resRegistro = $mysqli->query($sqlRegistro);
		if($resRegistro==1){
			echo "1";
		}else{
			echo "2";
		}
	}
?>