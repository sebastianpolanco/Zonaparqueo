<?php

// PROGRAMA DE MENU CONSULTA
include "conexion.php";
                                                 
session_start();
if ($_SESSION["autenticado"] != "SIx3")
    {
      header('Location: index.php?mensaje=3');
    }
else
    {      
        $mysqli = new mysqli($host, $user, $pw, $db);
  	    $sqlusu = "SELECT * from tipo_usuario where id='2'"; //CONSULTA EL TIPO DE USUARIO CON ID=2, TIPO CONSULTA
        $resultusu = $mysqli->query($sqlusu);
        $rowusu = $resultusu->fetch_array(MYSQLI_NUM);
  	    $desc_tipo_usuario = $rowusu[1];
        if ($_SESSION["tipo_usuario"] != $desc_tipo_usuario)
          header('Location: index.php?mensaje=4');
    }

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
     <html>
       <head>
           <title> Gestion De Usuarios </title>
           <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/>
           <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
       <body>
        <header id="header">
            <nav class="navbar">
              <h1 class="title">Sistema de Monitoreo del Cloro para Plantas de Tratamiento </h1>                   
              <div class="user-wrap">
                    <span FACE="arial" SIZE=2 color="#000000"> <u><?php  echo "Nombre Usuario</u>:   ".$_SESSION["nombre_usuario"];?> </span><br>
                    <span FACE="arial" SIZE=2 color="#000000"> <u><?php  echo "Tipo Usuario</u>:   ".$desc_tipo_usuario;?> </span><br>  
                    <span FACE="arial" SIZE=2 color="#00FFFF"> <u> <a href="cerrar_sesion.php"> Cerrar Sesion </a></u></span>  
              </div>
            </nav>
            <menu>
            <?php
              include "menu_consul.php";
            ?>
            </menu>   
            <!-- Limpiar el float-->
            <div class="clearfix"></div>        
        </header>


       <body>
        <section class="content">
            <h2>Consulta datos medidos (&Uacute;ltimos 5)</h2>
        </section>
        
    

      <div class="table-wrap">
      <table class="table-users" >
			<tr class="titles-table">	
         <td  colspan=6 >
           <h3>Ultimos datos medidos de cloro </h3>
         </td>
 	     </tr>
    	 <tr class="titles-table">
         <td>
            <b>#</b>
         </td>
         <td>
            <b>Id de la Tarjeta</b>
         </td>
         <td>
            <b>Nivel Cloro (mA)</b>
         </td>
         <td>
            <b>Fecha</b>
         </td>
         <td>
            <b>Hora</b>
         </td>         
 	     </tr>
<?php

$mysqli = new mysqli($host, $user, $pw, $db);
$id_usuario1 = $_SESSION["id_usuario"];
$sqlusu1 = "SELECT * from usuarios where id='$id_usuario1'"; //CONSULTA EL ID TARJETA DEL USUARIO LOGUEADO
$resultusu1 = $mysqli->query($sqlusu1);
$rowusu1 = $resultusu1->fetch_array(MYSQLI_NUM);
$id_tarjeta= $rowusu1[7];

// la siguiente linea almacena en una variable denominada sql1, la consulta en lenguaje SQL que quiero realizar a la base de datos. Se consultan los datos de la tarjeta 1, porque en la tabla puede haber datos de diferentes tarjetas.
$sql1 = "SELECT * from datos_medidos where Id_tarjeta='$id_tarjeta' order by id DESC LIMIT 5"; // Aqu� se guarda en la variable sql la sentencia de consulta a realizar
// la siguiente l�nea ejecuta la consulta guardada en la variable sql, con ayuda del objeto de conexi�n a la base de datos mysqli
//echo "sql1 ...".$sql1;
$result1 = $mysqli->query($sql1);
// la siguiente linea es el inicio de un ciclo while, que se ejecuta siempre que la respuesta a la consulta de la base de datos
// tenga alg�n registro resultante. Como la consulta arroja 5 resultados, los �ltimos que tenga la tabla, se ejecutar� 5 veces el siguiente ciclo while.
// el resultado de cada registro de la tabla, se almacena en el arreglo row, row[0] tiene el dato del 1er campo de la tabla, row[1] tiene el dato del 2o campo de la tabla, as� sucesivamente
$contador = 0;
while($row1 = $result1->fetch_array(MYSQLI_NUM))
{
 $cloro = $row1[2];
 $fecha = $row1[3];
 $hora = $row1[4];
 $contador++;
?>
    	 <tr class="datos-content">
         <td >
           <?php echo $contador; ?> 
         </td>
         <td >
           <?php echo $id_tarjeta; ?> 
         </td>
         <td>
           <?php echo $cloro; ?> 
         </td>
         <td>
           <?php echo $fecha; ?> 
         </td>
         <td >
           <?php echo $hora; ?> 
         </td>
         
 	     </tr>
<?php
}
?>
       </table>
       <hr>
       <br><br>
     </body>
   </html>