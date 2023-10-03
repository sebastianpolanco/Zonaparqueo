<?php
  session_start();
  if ($_SESSION["autenticado"] != "SIx5"){
    header('Location: /zonaDeParqueo/index.php');
  }
  $idUsuario = $_SESSION['idUsuario'];
  $usuario = $_SESSION['usuario'];
  $nombres = $_SESSION["nombres"]; 
  $apellidos = $_SESSION["apellidos"]; 

  include "../eventos/conexion.php";
  $mysqli = new mysqli($host, $user, $pw, $db); 
  $sqlHora = "SELECT * from registros WHERE idUsuario='$idUsuario' order by idRegistro DESC LIMIT 1"; 
  $resHora = $mysqli->query($sqlHora);
  $rowH = $resHora->fetch_array(MYSQLI_NUM);
  $zona = $rowH[2];
  $puesto = $rowH[3];
  $estado = $rowH[4];
  $idTipodeAccion = $rowH[5];
  $fecha = $rowH[6];
  $hora = $rowH[7];
  if($estado==1){
    header("Location: /zonaDeParqueo/vtn/vtnVisualizarPuestos.php");
  }
  $sqlTarifa = "SELECT tarifa, tarifaAdicional from registrostarifas WHERE idUsuario='$idUsuario' order by id DESC LIMIT 1"; 
  $resTarifa = $mysqli->query($sqlTarifa);
  $numFilasT = $resTarifa->num_rows;
  if ($numFilasT>0) {
    $rowTarifa = $resTarifa->fetch_array(MYSQLI_NUM);
    $tarifa = $rowTarifa[0];
    $tarifaAdicional = $rowTarifa[1];
  }else{
    $tarifa = 500;
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Zona De Parqueo</title>
      <meta charset="utf-8"> 
      <meta http-equiv="refresh" content="30" />
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    </head>
    <body>
      <ul class="menu">
        <li><a href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php">Inicio</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnUbicacionZonas.php">Mapa</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnHistorialPuestos.php">Historial</a></li>
        <li><a href="#">Opción 3</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a></li>
      </ul>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
       <tr>
         <td valign="top" align=center width=80& colspan=7 class="tdima">
           <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1195 height=250>
         </td>
       </tr>
       <tr>
         <td valign="top" align=center width=80 height=30 colspan=7 class="tdima">
           <h1> <font color=white>Información</font></h1>
         </td>
       </tr>
        <tr>
          <td>
            <h2>Información del usuario</h2>
            <label for="usuario">Usuario: <?php echo "$usuario";?></label>
            <br/> <br/>
            <label for="idUsuario" id="idUsuario">Usuario: <?php echo "$idUsuario";?></label>
            <br/> <br/>
            <label for="nombres">Nombre: <?php echo "$nombres";?> <?php echo "$apellidos";?></label>
            <h2>Información Puesto</h2>
            <label for="zona">Zona: <?php echo "$zona";?></label>
            <br/> <br/>
            <label for="puesto">Puesto: <?php echo "$puesto";?></label>
            <br/> <br/>
            <label for="estado">Estado: Ocupado</label>
            <br/> <br/>
            <label for="estado">Tarifa: $<?php echo "$tarifa";?></label>
            <br/> <br/>
            <label for="estado">Tarifa Adicional: $<?php echo "$tarifaAdicional";?></label>
            <br/> <br/>
            <label for="fecha">Fecha de Ocupación: <?php echo "$fecha"?></label>
            <br/> <br/>
            <label for="hora">Hora: <?="$hora"?></label>
            <br/> <br/>
            <?php  
              if($idTipodeAccion==1){
            ?>
            <label for="estado">Tiempo Restante: <label id="tiempo"></label> min</label>
            <?php  
              }else{
            ?>
            <!--<label for="estado">Tiempo Transcurrido: <label id="tiempo"></label> min</label>-->
            <?php
              }
            ?>
            <br/> <br/>
            <a href="vtnVisualizarPuestos.php"><button class="btn">Aceptar</button></a> 
          </td>
        </tr>
        <style type="text/css">
          .btn {
            width: 10%;
            margin-bottom: 0px;
          }
          .btn {
            border: none;
            outline: none;
            height: 25px;
            background: #13EA19;
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
        <script type="text/javascript">
          var idUsuario = '<?=$idUsuario?>';
          var ruta = "idUsuario="+idUsuario;
          $.ajax({
              url: '/zonaDeParqueo/eventos/calcularTiempo.php',
              type: 'POST',
              data: ruta,
          }).done(function(res){
            $('#tiempo').html(res)
          })

          $.ajax({
              url: '/zonaDeParqueo/eventos/validarTiempo.php',
              type: 'POST',
              data: ruta,
          }).done(function(res){
            if(res=="5"){
              Swal.fire({
                title: 'Reservación Cancelada',
                icon: 'info',
                backdrop: true,
                text: 'Ha superado el tiempo limite de ocupación, por lo que se ha cancelado la reservación',
                timer: 10000
              }).then((result) => {
                $.ajax({
                  url: '/zonaDeParqueo/eventos/actualizarEstado.php',
                  type: 'POST',
                  data: 'zona='+'<?=$zona?>'+'&puesto='+'<?=$puesto?>'+'&estado='+'1'+'&idUsuario='+'<?=$idUsuario?>'+'&tipoDeAccion='+'4',
                  success:function(response){
                    location.href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php";
                  }
                }) 
              })
            }
            if(res=="15"){
              Swal.fire({
                title: 'Cobro Adicional',
                icon: 'info',
                backdrop: true,
                text: 'Ha superado el tiempo limite de retiro por lo que se ha cobrado una tarifa adicional',
                showConfirmButton:  true,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#24B379",
                closeOnConfirm: true,
                timer: 10000
              }).then((result) => {
                location.href="/zonaDeParqueo/vtn/vtnInfoPuestoOcupado.php";
              });
            }
          })     
        </script>
        <!--<div id="respuesta"></div>-->
     </body>
     </table>
   </html>