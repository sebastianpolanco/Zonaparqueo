<?php
include "conexion.php";  

$nivel_CL= $_GET["nivel_CL"];
$ID_TARJ=$_GET["ID_TARJ"]

$mysqli = new mysqli($host, $user, $pw, $db); 

date_default_timezone_set('America/Bogota'); // esta línea es importante cuando el servidor es REMOTO y está ubicado en otros países como USA o Europa. Fija la hora de Colombia para que grabe correctamente el dato de fecha y hora con CURDATE y CURTIME, en la base de datos.

//$fecha = date("Y-m-d");
//$hora = date("h:i:s");

//Consulta estado puesto 1
$sql1 = "INSERT into datos_medidos (ID_TARJ,nivel_CL)VALUES('$ID_TARJ','nivel_CL',CURDATE(),CURTIME())"; // Aquí se ingresa el valor recibido a la base de datos.

echo "sql1...".$sql1; // Se imprime la cadena sql enviada a la base de datos, se utiliza para depurar el programa php, en caso de algún error.
$result1 = $mysqli->query($sql1);
echo "result es...".$result1; // Si result es 1, quiere decir que el ingreso a la base de datos fue correcto.

?>