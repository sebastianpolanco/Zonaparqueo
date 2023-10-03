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
        <li><a href="/zonaDeParqueo/vtn/vtnAdminInicio.php">Inicio</a></li>
        <li><a href="">Gestión Usuarios</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnAdminInformes.php">Informes</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnAdminEstadisticas.php">Estadísticas</a></li>
        <li><a href="#">Opción 4</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a>
        </li>
      </ul>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
      	<tr>
           <td valign="top" align=center width=80& colspan=7 class="tdima">
              <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
           </td>
   	    </tr>
   	    <tr>
          <td valign="top" align=center width=80 height=30 colspan=7 class="tdima">
            <h1> <font color=white>Estado Puestos</font></h1>
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
          <b>Dirección</b>
        </td>
        <td valign="top" align=center bgcolor="44709B">
          <b>Estado</b>
        </td>
        <td valign="top" align=center bgcolor="44709B">
          <b>Estado Alerta</b>
        </td>
        <td valign="top" align=center bgcolor="44709B">
          <b>Generar Alerta</b>
        </td>
      </tr>
      <?php
          $sql1 = "SELECT * from puestos inner join zonas on puestos.idZona=zonas.idZona"; 
          $result1 = $mysqli->query($sql1);
          $contador = 0;
          while($row1 = $result1->fetch_array(MYSQLI_NUM)){
            $zona = $row1[1];
            $estado = $row1[2];
            $puesto = $row1[3];
            $alerta = $row1[6];
            $direccion = $row1[8];
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
            <?php echo $direccion; ?> 
        </td>  
        <td valign="middle" align=center>
            <?php 
              if($estado==1){
            ?>  
              <img src="/zonaDeParqueo/img/libre.png" width=40 height=40> 
            <?php
              }
              if($estado==2){
            ?> 
              <img src="/zonaDeParqueo/img/ocupado.png" width=40 height=40> 
            <?php
              } 
              if($estado==3){
            ?>
              <img src="/zonaDeParqueo/img/reservado.png" width=40 height=40>
            <?php 
              }
            ?>
        </td>
        <td valign="middle" align=center>
            <?php 
              if($alerta==1){
            ?>  
              <img src="/zonaDeParqueo/img/advertencia.png" width=40 height=40> 
            <?php
              }
              if($alerta==0){
            ?> 
              <img src="/zonaDeParqueo/img/ok.png" width=40 height=40> 
            <?php
              } 
            ?>
        </td>
         <td valign="middle" align=center>
          <?php 
              if($alerta==1){
            ?>  
              <button class="btn" onclick="cancelarAlerta(<?php echo $zona;?>, <?php echo $puesto;?>)">Cancelar</button>
            <?php
              }
              if($alerta==0){
            ?> 
              <button class="btn" onclick="generarAlerta(<?php echo $zona;?>, <?php echo $puesto;?>)">Generar</button>
            <?php
              } 
            ?>
        </td>
      </tr>
        <?php
          }
        ?>  
      </table>
      <style type="text/css">
        .btn{
          width: 40%;
          margin-bottom: 0px;
        }
        .btn{
          border: none;
          outline: none;
          height: 25px;
          background: #0848BF;
          color: #000;
          font-size: 18px;
          border-radius: 20px;
        }

        .btn:hover {
          cursor: pointer;
          background: #ffc107;
          color: #000;
        }
      </style>
    </body>
  </html>