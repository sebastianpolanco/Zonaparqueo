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
          <td valign="top" align=center width=80 colspan=7 class="tdima">
            <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
          </td>
        </tr>
        <tr>
          <td valign="top" align=center width=80 height=10 colspan=7 class="tdima">
            <h1> <font color=white>Informes</font></h1>
          </td>
        </tr>
        <tr class="submenu">
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
               <font color="white">Tipo De Acción: </font>
              <select name="tipoDeAccion" id="tipoDeAccion">
                <option value="0">All</option>
                <option value="1">Terminación</option>
                <option value="2">Ocupación</option>
                <option value="3">Reservación</option>
                <option value="4">Cancelación</option>
                <option value="5">Liberación</option>
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
        </tr>
        <tr>
          <td valign="top" align=center bgcolor="44709B">
            <b>#</b>
          </td>
          <td valign="top" align=center bgcolor="44709B">
            <b>id Usuario</b>
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
            <b>Tipo De Acción</b>
          </td>
        </tr>
      <?php
        if (isset($_POST['enviar'])) {
          $zonaC = $_POST['zona'];
          $puestoC = $_POST['puesto'];
          $tipoDeAccionC = $_POST['tipoDeAccion'];
          $horaIni = $_POST['horaIni'];
          $horaFin = $_POST['horaFin'];
          $fechaIni = $_POST['fechaIni'];
          $fechaFin = $_POST['fechaFin'];
          /*echo "Zona: ".$zonaC." ";
          echo "Puesto: ".$puestoC." ";
          echo "HoraIni: ".$horaIni." ";
          echo "HoraFin: ".$horaFin." ";
          echo "FechaIni: ".$fechaIni." ";
          echo "FechaFin: ".$fechaFin." ";
          echo "Tipo Accion: ".$tipoDeAccionC." ";*/
          $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion";
          if($zonaC!=0 or $puestoC!=0 or $tipoDeAccionC!=0 or (strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)){
            $sql1 = $sql1.' WHERE';
            if($zonaC!=0){
              $sql1 = $sql1.' zona='.$zonaC;
              if ($puestoC!=0 or $tipoDeAccionC!=0 or (strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)) {
                $sql1 = $sql1.' and';
              }
            }
            if($puestoC!=0){
              $sql1 = $sql1.' puesto='.$puestoC;
              if ($tipoDeAccionC!=0 or (strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)) {
                $sql1 = $sql1.' and';
              }
            }
            if($tipoDeAccionC!=0){
              $sql1 = $sql1.' registros.idTipoDeAccion='.$tipoDeAccionC;
              if ((strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)) {
                $sql1 = $sql1.' and';
              }
            }
            if(strlen($fechaIni)>0 and strlen($fechaFin)>0){
              $sql1 = $sql1.' fecha BETWEEN '.'"'.$fechaIni.'"'.' and '.'"'.$fechaFin.'"';
              if (strlen($horaIni)>0 and strlen($horaFin)>0) {
                $sql1 = $sql1.' and';
              }
            }
            if(strlen($horaIni)>0 and strlen($horaFin)>0){
              $sql1 = $sql1.' hora BETWEEN '.'"'.$horaIni.'"'.' and '.'"'.$horaFin.'"';
            }
          }else{
            if((strlen($fechaIni)>0 and empty($fechaFin)) or (strlen($fechaFin)>0 and empty($fechaIni))){
            echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de las fechas', 'error')</script>";
            }
            if((strlen($horaIni)>0 and empty($horaFin)) or (strlen($horaFin)>0 and empty($horaIni))){
              echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de horas', 'error')</script>";
            }
          }

          $sql1 = $sql1.' order by idRegistro DESC LIMIT 10';
          //echo "".$sql1;
          
        }else{
          $sql1 = "SELECT * FROM registros inner join tiposdeaccion on registros.idTipoDeAccion=tiposdeaccion.idTipoDeAccion order by idRegistro DESC LIMIT 10"; 
        }

        $result1 = $mysqli->query($sql1);
        $contador = 0;
        while($row1 = $result1->fetch_array(MYSQLI_NUM)){
          $idUsuario = $row1[1];
          $zona = $row1[2];
          $puesto = $row1[3];
          $fecha = $row1[6];
          $hora = $row1[7];
          $tipoDeAccion = $row1[9];
          
          $contador++;
      ?>
      <tr>
        <td valign="middle" align=center>
          <?php echo $contador; ?> 
        </td>
        <td valign="middle" align=center>
          <?php echo $idUsuario; ?> 
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
          <?php echo $tipoDeAccion; ?> 
        </td> 
        <?php
          }
        ?>
      </tr>
      <script type="text/javascript">
        $("#zona").val("<?php echo "".$zonaC?>");
        $("#puesto").val("<?php echo "".$puestoC?>");
        $("#tipoDeAccion").val("<?php echo "".$tipoDeAccionC?>");
        $("#fechaIni").val("<?php echo "".$fechaIni?>");
        $("#fechaFin").val("<?php echo "".$fechaFin?>");
        $("#horaIni").val("<?php echo "".$horaIni?>");
        $("#horaFin").val("<?php echo "".$horaFin?>");
      </script>
    </body>
    </table>
  </html>