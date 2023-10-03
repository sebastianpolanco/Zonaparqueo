<?php
	
	$usuario = $_POST['usuario'];
	$contrasena = $_POST['contrasena'];
	$contrasenaCD = md5($contrasena);
	session_start();

	include "../eventos/conexion.php";
	$mysqli = new mysqli($host, $user, $pw, $db); 

	$sqlLogueo = "SELECT * FROM usuarios where usuario='$usuario'";
	$resLogueo = $mysqli->query($sqlLogueo);
	$numFilas = $resLogueo->num_rows;

	if($numFilas==0){
		echo "0";
	}else{
		$row = $resLogueo->fetch_array(MYSQLI_NUM);
		$contrasenaC = $row[2];
		$idTipoUsuario = $row[5];

		if($contrasenaC == $contrasenaCD){
			$_SESSION["autenticado"]= "SIx5";
	        $_SESSION["idUsuario"]= $row[0];
	        $_SESSION["usuario"]= $row[1];
	        $_SESSION["nombres"]= $row[3]; 
	        $_SESSION["apellidos"]= $row[4];
	        $_SESSION["idTipoUsuario"]= $row[5];
	        if($idTipoUsuario==1){
	        	echo "1";
	        }else{
	        	echo "2";
	        }
		}else{
			echo "3";
		}
	}
?>