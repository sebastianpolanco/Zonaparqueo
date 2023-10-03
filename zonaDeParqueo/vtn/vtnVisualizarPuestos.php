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
        <li><a href="#">Opción 3</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a></li>
      </ul>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
    	 <tr>
         <td valign="top" align=center width=80& colspan=7 class="tdima">
           <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1210 height=250>
         </td>
 	     </tr>
 	     <tr>
         <td valign="top" align=center width=80 height=30 colspan=7 class="tdima">
           <h1> <font color=white>Información de Puestos</font></h1>
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
            <b>Opción</b>
         </td>
         <td valign="top" align=center bgcolor="44709B">
            <b>Información</b>
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
            $direccion = $row1[8];
            $contador++;

            $sqlConsultaP= "SELECT zona,puesto,estado FROM registros where idUsuario='$idUsuario' order by idRegistro DESC LIMIT 1"; 
            $resConsultaP = $mysqli->query($sqlConsultaP);
            $numFilasP = $resConsultaP->num_rows;
            if ($numFilasP>0) {
              $rowConsultaP = $resConsultaP->fetch_array(MYSQLI_NUM);
              $zonaC = $rowConsultaP[0];
              $puestoC = $rowConsultaP[1];
              $estadoC = $rowConsultaP[2];
            } else {
              $zonaC = $zona;
              $puestoC = $puesto;
              $estadoC = $estado;
            }
                       
            $sqlIdUsuario = "SELECT idUsuario, idTipoDeAccion FROM registros WHERE puesto='$puesto' and zona='$zona' and (estado=2 or estado=3) order by idRegistro DESC LIMIT 1"; 
            $resIdUsuario = $mysqli->query($sqlIdUsuario);
            $numFilas = $resIdUsuario->num_rows;
            if($numFilas>0){
              $rowIdUsuario = $resIdUsuario->fetch_array(MYSQLI_NUM);
              $idUsuarioC = $rowIdUsuario[0];
              $idTipoDeAccion = $rowIdUsuario[1];
            }else{
              $idUsuarioC = $idUsuario;
            }
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
            if($estadoC==1){
              if($estado==1){
          ?>
          <button class="btnReservar" onclick="reservarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)" >Reservar</button>
          <?php
              }elseif($idUsuarioC==$idUsuario){
                if($estado==2){
                  if($idTipoDeAccion!=1){
          ?>  
          <button class="btnTerminar" onclick="terminarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)">Terminar</button>
          <?php
                  }
                }else{
          ?> 
          <button class="btnCancelar" onclick="cancelarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)">Cancelar</button>
          <?php
                }
              }else{
          ?>
          <img src="/zonaDeParqueo/img/prohibido.png" width=40 height=40> 
          <?php
              }
            }else{
              if($zonaC==$zona and $puestoC==$puesto){
                if($estado==1){
          ?>
          <button class="btnReservar" onclick="reservarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)">Reservar</button>
          <?php
                }elseif($idUsuarioC==$idUsuario){
                  if($estado==2){
                    if($idTipoDeAccion!=1){
          ?>
          <button class="btnTerminar" onclick="terminarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)">Terminar</button>
          <?php
                    }
                  }else{
          ?>
          <button class="btnCancelar" onclick="cancelarPuesto(<?php echo $zona;?>, <?php echo $puesto;?>, <?php echo $idUsuario;?>)">Cancelar</button>
          <?php 
                  }
                }else{
          ?>
          <img src="/zonaDeParqueo/img/prohibido.png" width=40 height=40> 
          <?php
                }
              }else{
          ?>
          <img src="/zonaDeParqueo/img/prohibido.png" width=40 height=40> 
          <?php      
              }
            }
          ?>
        </td>
        <td valign="middle" align=center>
          <?php
            if($estado==2 and $idUsuarioC==$idUsuario){
          ?> 
          <a href="/zonaDeParqueo/vtn/vtnInfoPuestoOcupado.php"><img class="imgInfo" src="/zonaDeParqueo/img/informacion.png" width=30 height=30></a>
          <?php
            }elseif($estado==3 and $idUsuarioC==$idUsuario){
          ?>
          <a href="/zonaDeParqueo/vtn/vtnInfoPuestoReservado.php"><img class="imgInfo" src="/zonaDeParqueo/img/informacion.png" width=30 height=30></a>
          <?php
            }
          ?>
        </td>
      </tr>
      <script type="text/javascript">

      var idUsuario = '<?=$idUsuario?>';
      var ruta = "idUsuario="+idUsuario;
      $.ajax({
          url: '/zonaDeParqueo/eventos/validarTiempo.php',
          type: 'POST',
          data: ruta,
      }).done(function(res){
        //$('#respuesta').html(res)
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
              data: 'zona='+'<?=$zonaC?>'+'&puesto='+'<?=$puestoC?>'+'&estado='+'1'+'&idUsuario='+'<?=$idUsuario?>'+'&tipoDeAccion='+'4',
              success:function(response){
                location.href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php";
              }
            }) 
          })
        }
        if(res=="15"){
          Swal.fire('Cobro Adicional', 'Ha superado el tiempo limite de retiro por lo que se ha cobrado una tarifa adicional', 'info')
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
          })
        }
      })     
    </script> 
        <?php
          }
        ?>  
    </table>
    </body>
  </html>