<?php

require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();


//locate the IP
 $geoplugin->locate();
$geoplugin->city;
 $geoplugin->countryName;
echo  $geoplugin->latitude;
echo  $geoplugin->longitude;


?>




<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>

    <style type="text/css">
      /* Set the size of the div element that contains the map */
      #map {
        height: 400px;
        /* The height is 400 pixels */
        width: 100%;
        /* The width is the width of the web page */
      }
    </style>
    <script>
      // Initialize and add the map
      function initMap() {
        // The location of Uluru
        const uluru = { lat: <?php echo $geoplugin->latitude;?>, lng: <?php echo $geoplugin->longitude;?> };
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 10,
          center: uluru,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: uluru,
          map: map,
        });
      }
    </script>
  </head>
  <body>
    <h3>Location: <?php echo $geoplugin->city;?>(<?php echo  $geoplugin->countryName; ?>)</h3>
    <!--The div element for the map -->
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMruoXxdnh3sylM2T0SsXX3H0xPDqAdNc&callback=initMap&libraries=&v=weekly"
      async
    ></script>
  </body>
</html>