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
      <meta http-equiv="refresh" content="400"/>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <script src="/zonaDeParqueo/js/vtnVisualizarPuestos.js"></script>
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/btnVisualizarPuestos.css">
    </head>
    <body>
      <ul class="menu">
        <li><a href="/zonaDeParqueo/vtn/vtnAdminInicio.php">Inicio</a></li>
        <li><a href="#">Gestión Usuarios</a></li>
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
          <td valign="top" align=center width=80 colspan=3 class="tdima">
            <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
          </td>
        </tr>
        <tr>
          <td valign="top" align=center width=80 height=10 colspan=3 class="tdima">
            <h1> <font color=white>Informes de Ingresos</font></h1>
          </td>
        </tr>
        <!--<tr class="submenu">
          <form action="/zonaDeParqueo/vtn/vtnAdminInformes.php" method="POST">
            <td valign="top" align=center width=80 height=20 colspan=7 bgcolor="#001532">
              <font color="white">Zona: </font>
              <select name="zona" id="zona">
                <option value="0">All</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select> 
              <font color="white">Puesto: </font>
              <select name="puesto" id="puesto">
                <option value="0">All</option>
                <option value="1">1</option>
                <option value="2">2</option>
              </select> 
                <font color="white">Hora Inicial: </font>
                <input type="time" name="horaIni" id="horaIni">
                <font color="white">Hora Final: </font>
                <input type="time" name="horaFin" id="horaFin">
                <font color="white">Fecha Inicial: </font>
                <input type="date" name="fechaIni" id="fechaIni">
                <font color="white">Fecha Final: </font>
                <input type="date" name="fechaFin" id="fechaFin">
              <input type="submit" value="Enviar" name="enviar">
            </td>
          </form>
        </tr>-->
        <tr>
          <td valign="top" align=center bgcolor="44709B">
            <b>#</b>
          </td>
          <td valign="top" align=center bgcolor="44709B">
            <b>Usuario</b>
          </td>
          <td valign="top" align=center bgcolor="44709B">
            <b>Total Tarifas Pagadas</b>
          </td>
        </tr>
      <?php
        $sql1 = "SELECT idUsuario FROM usuarios WHERE idTipoUsuario=2";

        $result1 = $mysqli->query($sql1);
        $contador = 0;

        while($row1 = $result1->fetch_array(MYSQLI_NUM)){
          $idUsuarioC = $row1[0];
          //echo "".$idUsuarioC;
          $sqlSumTarifa = "SELECT SUM(tarifa) as sumTarifa FROM registrostarifas where idUsuario='idUsuarioC'"; 

          $resSumTarifa = $mysqli->query($sqlSumTarifa);
          $numFilasSumTarifa = $resSumTarifa->num_rows;

          if($numFilasSumTarifa>0){
            $rowSumTarifa = $resSumTarifa->fetch_array(MYSQLI_NUM);
            $tarifaC = $rowSumTarifa[0];
            echo "".$tarifaC;
          }else{
            $tarifaC=0;
            
          }

          $sqlSumTarifaA = "SELECT SUM(tarifaAdicional) as sumTarifaA FROM registrostarifas where idUsuario='idUsuarioC'"; 

          $resSumTarifaA = $mysqli->query($sqlSumTarifaA);
          $numFilasSumTarifaA = $resSumTarifaA->num_rows;
          if($numFilasSumTarifaA>0){
            $rowSumTarifaA = $resSumTarifaA->fetch_array(MYSQLI_NUM);
            $tarifaA = $rowSumTarifaA[0];
          }else{
            $tarifaA=0;
          }
          $tarifa = $tarifaC + $tarifaA;

          $sqlUsu = "SELECT nombres FROM usuarios where idUsuario = '$idUsuarioC'"; 
          $resultU = $mysqli->query($sqlUsu);
          $rowU = $resultU->fetch_array(MYSQLI_NUM);
          $UsuarioC = $rowU[0];

          $contador++;

      ?>
      <tr>
        <td valign="middle" align=center>
          <?php echo $contador; ?> 
        </td>
        <td valign="middle" align=center>
          <?php echo $UsuarioC; ?> 
        </td>
        <td valign="middle" align=center>
          <?php echo $tarifa; ?> 
        </td> 
        <?php
          }
        ?>
      </tr>
    </body>
    </table>
  </html>