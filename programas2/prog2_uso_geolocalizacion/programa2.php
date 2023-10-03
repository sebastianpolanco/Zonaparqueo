<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      
      // El mapa a continuación se centra aproximadamente en el centro de POPAYAN, con las coordenadas indicadas de longitud y latitud.

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 2.44000, lng: -76.61000},  
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow({map: map});

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('Localizacion encontrada.');
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: Servicio de Geolocalizacion fallo' :
                              'Error: Su Navegador no soporta geolocalizacion.');
      }
    </script>
    <script async defer                                                                                                        
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP10OujyVODF_IHAxNUuJaKvOqtkPExZk&callback=initMap">  <!-- Se deben reemplazar el espacio vacio por la API Key de Google MAPS, si se quiere ver el mapa sin el mensaje de "For development purposes only"-->
    </script>
  </body>
</html>

