<?php
  session_start();
  if ($_SESSION["autenticado"] != "SIx5"){
    header('Location: index.php');
  }
  $idUsuario = $_SESSION['idUsuario'];
  $usuario = $_SESSION['usuario'];

  include "../eventos/conexion.php";  
  $mysqli = new mysqli($host, $user, $pw, $db); 
 
  $sqlHora = "SELECT * from registros WHERE idUsuario='$idUsuario' order by idRegistro DESC LIMIT 1"; 
  $resHora = $mysqli->query($sqlHora);
  $numFilas = $resHora->num_rows;
  if($numFilas>0){
    $rowH = $resHora->fetch_array(MYSQLI_NUM);
    $zona = $rowH[2];
    $puesto = $rowH[3];
    $estado = $rowH[4];
    $fecha = $rowH[6];
    $hora = $rowH[7];
  }
  
  
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 	Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
    <head>
      <title>Zona De Parqueo</title>
      <meta charset="utf-8">
      <meta http-equiv="refresh" content="180"/>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="/zonaDeParqueo/css/menu.css">
    </head>
    <body>
      <ul class="menu">
        <li><a href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php">Inicio</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnUbicacionZonas.php">Mapa</a></li>
        <li><a href="/zonaDeParqueo/vtn/vtnHistorialPuestos.php">Historial</a></li>
        <li><a href="#">Opción 3</a></li>
        <li><a href="#">Acerca De</a></li>
        <li class="item_sesion"><a href="/zonaDeParqueo/eventos/cerrarSesion.php">Cerrar Sesión</a></li>
        <li class="item_sesion"><a href="#"><?php echo $usuario;?></a>
        </li>
      </ul>
      <table width="80%" align=center cellpadding=5 border=1 bgcolor="FFFFFF" class="tabla">
    	<tr>
        <td valign="top" align=center width=80& colspan=7 class="tdima">
          <img src="/zonaDeParqueo/img/SmartParking.jpg" width=1195 height=250>
        </td>
 	    </tr>
 	    <tr>
        <td valign="top" align=center width=80 height=30 colspan=7 class="tdima">
          <h1> <font color=white>Ubicación Puestos</font></h1>
        </td>
 	    </tr>
    	<tr>
        <td>
          <style>
            #map {
              height: 400px;
              width: 1195;
             }
          </style>
          <div id="map"></div>
          <?php
            $sqlUbi = "SELECT * from ubicaciones order by id"; 
            $resUbi = $mysqli->query($sqlUbi);
            while($rowUbi = $resUbi->fetch_array(MYSQLI_NUM)){
              if($rowUbi[0]==1){
                $latitud1 = $rowUbi[1];
                $longitud1 = $rowUbi[2];
              }else{
                $latitud2 = $rowUbi[1];
                $longitud2 = $rowUbi[2];
              }
            }
          ?>
          <script>
            function initMap() {
              var image =
    "https://localhost/zonaDeParqueo/img/marcador1.png";
              var ubicacion1 = new google.maps.LatLng('<?=$latitud1?>', '<?=$longitud1?>');
              var ubicacion2 = new google.maps.LatLng('<?=$latitud2?>', '<?=$longitud2?>');
              var mapOpcions = {
                zoom: 13,
                center: {lat: 2.44000, lng: -76.61000}
              }
              
              var map = new google.maps.Map(document.getElementById('map'), mapOpcions);

              var marker1 = new google.maps.Marker({
                position: ubicacion1,
                map: map,
                title: 'Zona 1',
                icon: image,
              });

              var marker2 = new google.maps.Marker({
                position: ubicacion2,
                map: map,
                title: 'Zona 2',
                icon: image,
              });

              var infoWindow = new google.maps.InfoWindow({map: map});

              if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                  };

                  var marker3 = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: 'Mi ubicación',
                  });

                  //infoWindow.setPosition(pos);
                  //infoWindow.setContent('Localización encontrada.');
                  //map.setCenter(pos);
                }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
                });
              } else {
                handleLocationError(false, infoWindow, map.getCenter());
              }
            }
            function handleLocationError(browserHasGeolocation, infoWindow, pos) {
              infoWindow.setPosition(pos);
              infoWindow.setContent(browserHasGeolocation ? 'Error: Servicio de Geolocalizacion fallo' : 'Error: Su Navegador no soporta geolocalizacion.');
            }

            google.maps.event.addDomListener(window, 'load', initMap);
          </script>
          <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP10OujyVODF_IHAxNUuJaKvOqtkPExZk&callback=initMap"></script>
          <!--<script async defer
          src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap">  Se deben reemplazar el espacio vacio por la API Key de Google MAPS, si se quiere ver el mapa sin el mensaje de "For development purposes only"
          </script>-->
        </td>  
 	    </tr> 
      <?php  
        if($numFilas>0){ 
      ?>
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
              data: 'zona='+'<?=$zona?>'+'&puesto='+'<?=$puesto?>'+'&estado='+'1'+'&idUsuario='+'<?=$idUsuario?>'+'&tipoDeAccion='+'4',
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
          }).then((result) => {
            $.ajax({
              url: '/zonaDeParqueo/eventos/actualizarEstado.php',
              type: 'POST',
              data: 'zona='+'<?=$zona?>'+'&puesto='+'<?=$puesto?>'+'&estado='+'1'+'&idUsuario='+'<?=$idUsuario?>'+'&tipoDeAccion='+'1',
              success:function(response){
                location.href="/zonaDeParqueo/vtn/vtnVisualizarPuestos.php";
              }
            }) 
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