<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 50%;
       }
    </style>
  </head>
  <body>
<?php
include "conexion.php";  // Conexión tiene la información sobre la conexión de la base de datos.
$mysqli = new mysqli($host, $user, $pw, $db); // Aquí se hace la conexión a la base de datos.
$sqlubi = "SELECT * from ubicaciones order by id"; //CONSULTA LA ULTIMA UBICACION AGREGADA A LA TABLA UBICACIONES
$resultubi = $mysqli->query($sqlubi);
$rowubi = $resultubi->fetch_array(MYSQLI_NUM);
$latitud = $rowubi[1];
$longitud = $rowubi[2];

?>

    <h3>My Google Maps</h3>
    <div id="map"></div>
    <script>
      function initMap() {
        var latit= <?php echo $latitud ?>;
        var longi= <?php echo $longitud ?>;
        var uluru = {lat: latit, lng: longi};
        
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 12,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP10OujyVODF_IHAxNUuJaKvOqtkPExZk&callback=initMap"> <!-- Se deben reemplazar el espacio vacio por la API Key de Google MAPS, si se quiere ver el mapa sin el mensaje de "For development purposes only"--> 
    //"AIzaSyBP10OujyVODF_IHAxNUuJaKvOqtkPExZk"
    </script>
  </body>
</html>
