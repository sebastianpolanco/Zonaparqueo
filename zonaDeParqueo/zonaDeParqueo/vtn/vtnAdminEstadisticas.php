<?php
  include "../eventos/conexion.php";  
  $mysqli = new mysqli($host, $user, $pw, $db); 
  session_start();
  if ($_SESSION["autenticado"] != "SIx5"){
    header('Location: index.php');
  }
  $idUsuario = $_SESSION['idUsuario'];
  $usuario = $_SESSION['usuario'];

  if(isset($_POST['enviar'])){
    $tipoDeAccionC = $_POST['tipoDeAccion'];
    $horaIni = $_POST['horaIni'];
    $horaFin = $_POST['horaFin'];
    $fechaIni = $_POST['fechaIni'];
    $fechaFin = $_POST['fechaFin'];

    $sqlZ1 = "SELECT COUNT(idTipoDeAccion) AS count FROM registros";

    if($tipoDeAccionC!=0 or (strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)){
      $sqlZ1 = $sqlZ1.' WHERE';
      if($tipoDeAccionC!=0){
        $sqlZ1 = $sqlZ1.' idTipoDeAccion='.$tipoDeAccionC;
        if ((strlen($fechaIni)>0 and strlen($fechaFin)>0) or (strlen($horaIni)>0 and strlen($horaFin)>0)) {
          $sqlZ1 = $sqlZ1.' and';
        }
      }
      if(strlen($fechaIni)>0 and strlen($fechaFin)>0){
        $sqlZ1 = $sqlZ1.' fecha BETWEEN '.'"'.$fechaIni.'"'.' and '.'"'.$fechaFin.'"';
        if (strlen($horaIni)>0 and strlen($horaFin)>0) {
          $sqlZ1 = $sqlZ1.' and';
        }
      }
      if(strlen($horaIni)>0 and strlen($horaFin)>0){
        $sqlZ1 = $sqlZ1.' hora BETWEEN '.'"'.$horaIni.'"'.' and '.'"'.$horaFin.'"';
      }
      $sqlZ2 = $sqlZ1.' and puesto=2 GROUP BY zona ORDER BY zona';
      $sqlZ1 = $sqlZ1.' and puesto=1 GROUP BY zona ORDER BY zona'; 
      }else{
        if((strlen($fechaIni)>0 and empty($fechaFin)) or (strlen($fechaFin)>0 and empty($fechaIni))){
        echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de las fechas', 'error')</script>";
        }
        if((strlen($horaIni)>0 and empty($horaFin)) or (strlen($horaFin)>0 and empty($horaIni))){
          echo "<script> Swal.fire('Campo Obligatorio', 'Debe llenar los campos de horas', 'error')</script>";
        }
      }
  }else{
    $sqlZ1 = "SELECT COUNT(idTipoDeAccion) AS count FROM registros where idTipoDeAccion=1 and puesto=1 GROUP BY zona ORDER BY zona"; 
    $sqlZ2 = "SELECT COUNT(idTipoDeAccion) AS count FROM registros where idTipoDeAccion=1 and puesto=2 GROUP BY zona ORDER BY zona"; 
    echo "entro";
  }

    $datoZ1 = mysqli_query($mysqli,$sqlZ1);
    $datoZ1 = mysqli_fetch_all($datoZ1,MYSQLI_ASSOC);
    $datoZ1 = json_encode(array_column($datoZ1, 'count'),JSON_NUMERIC_CHECK);

    $datoZ2 = mysqli_query($mysqli,$sqlZ2);
    $datoZ2 = mysqli_fetch_all($datoZ2,MYSQLI_ASSOC);
    $datoZ2 = json_encode(array_column($datoZ2, 'count'),JSON_NUMERIC_CHECK);
    //echo "".$datoZ1;
    //echo "".$datoZ2;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Zona De Parqueo</title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="400"/>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/btnVisualizarPuestos.css">
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
      <script src="https://code.highcharts.com/highcharts.js"></script>
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
      <table width="70%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
        <tr>
          <td valign="top" align=center width=70 colspan=7 class="tdima">
            <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
          </td>
        </tr>
        <tr>
          <form action="/zonaDeParqueo/vtn/vtnAdminEstadisticas.php" method="POST">
            <td valign="top" align=center width=80 height=20 colspan=1 bgcolor="#001532">
              <font color="white">Tipo De Acción: </font>
              <select name="tipoDeAccion" id="tipoDeAccion">
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
          <td>
            <div id="container"></div>
          </td>
        </tr>
        <script type="text/javascript">
          $(function () { 

            var dataZ1 = <?php echo $datoZ1; ?>;
            var dataZ2 = <?php echo $datoZ2; ?>;

            $('#container').highcharts({
                chart: {
                type: 'column'
                },
                title: {
                text: 'Titulo'
                },
                xAxis: {
                categories: ['Zona 1','Zona 2']
                },
                yAxis: {
                title: {
                text: 'Cantidad'
                }
                },
            series: [{
            name: 'Puesto 1',
            data: dataZ1
            }, {
            name: 'Puesto 2',
            data: dataZ2
             }]
            });
           });
          $("#tipoDeAccion").val("<?php echo "".$tipoDeAccionC?>");
          $("#fechaIni").val("<?php echo "".$fechaIni?>");
          $("#fechaFin").val("<?php echo "".$fechaFin?>");
          $("#horaIni").val("<?php echo "".$horaIni?>");
          $("#horaFin").val("<?php echo "".$horaFin?>");
        </script>
    </body>
    </table>
  </html>