<?php session_start() ?>

<!DOCTYPE html>
<html>

<body>

    <a href="index.php?accion=cerrarSesion">Cerrar Sesion</a><br/>
    <form action="cargaTrazas.php"  enctype="multipart/form-data" method="POST">
      <h3>Cargue sus propias trazas XML:</h3>
      <input type="file" id="traza" name="traza">
      <input type="submit" value="Cargar">
      <input type="reset" value="Borrar">
    </form>
    
<div id="map" style="width:100%;height:500px"></div>

<script>
function myMap() {
  var myCenter;
  var zoomConfig;
  
  <?php  
  
    require_once '../Model/Usuario.php';
    require_once '../Model/ConectarDB.php';

    $conexion = ConectarDB::conexion();

    $usuario = unserialize($_SESSION['logueado']);
    $codigoUsuario = $usuario->getCodigo();
    
    $consulta = $conexion->query("SELECT latitud, longitud, hora FROM coordenada WHERE codigoUsuario='$codigoUsuario' ORDER BY hora");

    if ($consulta->rowCount() > 0) {
        ?> var polilyne = [ <?php
        while ($posiciones = $consulta->fetchObject()) { 

        ?>
        {lat: <?= $posiciones->latitud ?>, lng: <?= $posiciones->longitud ?>},
        
        <?php } echo '];';
            $consulta = $conexion->query("SELECT latitud, longitud, hora FROM coordenada WHERE codigoUsuario='$codigoUsuario' ORDER BY hora desc LIMIT 1");
            $posiciones = $consulta->fetchObject();
        ?>

        myCenter = new google.maps.LatLng(<?= $posiciones->latitud ?>,<?= $posiciones->longitud ?>);
        zoomConfig = 12;
    <?php } else {?>
        myCenter = new google.maps.LatLng(0, 0);
        zoomConfig = 2;
    <?php }?>        
    var mapCanvas = document.getElementById("map");
    var mapOptions = {center: myCenter, zoom: zoomConfig};
    var map = new google.maps.Map(mapCanvas, mapOptions);
      
    var rutaPolyline = new google.maps.Polyline({
        path: polilyne,
        strokeColor: '#FF0000',
        strokeOpacity: 1.0,
        strokeWeight: 2
      });
    rutaPolyline.setMap(map);
    
    var marker = new google.maps.Marker({
        position: myCenter,
        animation: google.maps.Animation.BOUNCE
    });
    marker.setMap(map);
   
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBj8-R7qXsgWxKwnNaS2k1oHnC0tVxWA0Y&callback=myMap"></script>

</body>
</html>

