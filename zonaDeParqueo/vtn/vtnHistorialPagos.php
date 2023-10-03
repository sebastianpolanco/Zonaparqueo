<?php
  include "../eventos/conexion.php";  
  $mysqli = new mysqli($host, $user, $pw, $db); 
  session_start();
  if ($_SESSION["autenticado"] != "SIx5"){
    header('Location: index.php');
  }
  $idUsuario = $_SESSION['idUsuario'];
  $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Zona De Parqueo</title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="30"/>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <script src="/zonaDeParqueo/js/vtnVisualizarPuestos.js"></script>
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/btnVisualizarPuestos.css">
    </head>
    <body>
      <ul class="menu">
        <li><a href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php">Inicio</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnUbicacionZonas.php">Mapa</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnHistorialPuestos.php">Historial</a></li>
        <li><a href="#">Opcion 3</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a>
        </li>
      </ul>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
    	 <tr>
         <td valign="top" align=center width=80 colspan=7 class="tdima">
           <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
         </td>
 	     </tr>
 	     <!--<tr>
         <td valign="top" align=center width=80 height=10 colspan=6 class="tdima">
           <h1> <font color=white>Informes</font></h1>
         </td>
 	     </tr>-->
       <tr class="submenu">
        <td valign="top" align=center width=80 height=20 colspan=4 bgcolor="#001532">
            <a href="/zonaDeParqueo/vtn/vtnHistorialPuestos.php">Historial Puestos</a>
        </td>
        <td valign="top" align=center width=80 height=20 colspan=4 bgcolor="#001532">
            <a href="/zonaDeParqueo/vtn/vtnHistorialPuestos.php">Historial Pagos</a>
        </td>
       </tr>
    	 <tr>
         <td valign="top" align=center bgcolor="44709B">
            <b>#</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Zona</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Puesto</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Fecha</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Hora</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Tarifa</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Tarifa Adicional</b>
         </td>
      </tr>
      <?php
        $sql1 = "SELECT * FROM registrostarifas WHERE idUsuario='$idUsuario'"; 
        $result1 = $mysqli->query($sql1);
        $contador = 0;
        while($row1 = $result1->fetch_array(MYSQLI_NUM)){
          $tarifa = $row1[2];
          $fecha = $row1[3];
          $hora = $row1[4];
          $zona = $row1[5];
          $puesto = $row1[6];
          $tarifaAdicional = $row1[7];
          
          $contador++;
      ?>
      <tr>
        <td valign="middle" align=center>
            <?php echo $contador; ?> 
        </td>
        <td valign="middle" align=center>
            <?php echo $zona; ?> 
        </td>
        <td valign="middle" align=center>
            <?php echo $puesto; ?> 
        </td>
        <td valign="middle" align=center>
            <?php echo $fecha; ?> 
        </td>  
        <td valign="middle" align=center>
            <?php echo $hora; ?> 
        </td>
        <td valign="middle" align=center>
            <?php echo $tarifa; ?> 
        </td>
        <td valign="middle" align=center>
            <?php echo $tarifaAdicional; ?> 
        </td>   
        <?php
          }
        ?>
      </tr>
      <style type="text/css">
        .submenu td a{
          text-decoration: none;
          color: white;
          padding: 20px;
          display: block;
        }
        .submenu td a:hover{
          background: #11C6C4;
        }
      </style>
    </body>
    </table>
  </html>