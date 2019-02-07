<!-- Contenedor general -->
<?php

// Libreria
include ("../lib/gestionAnimales.php");

// Genero la consulta
$stmt = animalesMaps();
$stmt->execute();
$filasConsultadas = $stmt->rowCount();
$filaActual = 1;

// Titulo
echo '<h4>¿Los has visto?</h4>';

// DIV donde cargar el mapa
echo '<div id="map"></div>';

// Inicio de script
echo '<script type="text/javascript">';

// Variable mapa
echo 'var map;';

// Inicio funcion para rellenar datos
echo 'function iniciarMapa(){';

// Genero mapa.
// Punto central coordenadas en Madrid
echo "map = new google.maps.Map(document.getElementById('map'), {" .
    'center: {' .
        'lat: ' . 40.463 . ', ' .
        'lng: -3.749' .
    '},' .
    // distancia visible del mapa (0 a 18)
    'zoom: 4' .
'});';

while ($row = $stmt->fetch()){
    
    // Genero marcador 1
    echo 'var marker' . $filaActual .' = new google.maps.Marker(';
    
    echo '{position: {lat: ' . $row['latitud'] . ', lng: ' . $row['longitud'] . '},';
    echo 'map: map,';
    if ($row['nombre'] != ""){
        echo "title: '". $row['nombre'] ."'}";
    }
    else{
        echo "title: 'Desconocido'}";
    }
    echo ');';
    
    if ($row['estado'] == 3){
        echo "marker".$filaActual.".setIcon('/damelapatita/img/iconoAzul.png');";
    }
    else{
        echo "marker".$filaActual.".setIcon('/damelapatita/img/iconoRojo.png');";
    }
    
    // Genero la ventana de informacion para el marcador
    if ($row['nombre'] != ""){
        echo 'var infowindow' . $filaActual . ' = new google.maps.InfoWindow({';
        echo "content: '<a href=\"http://localhost/damelapatita/paginas/fichaAnimal.php?id=" . $row['id'] . "\">" . $row['nombre'] ."</a><br><p>" . utf8_encode($row['informacion']) ."</p>'";
        echo '});';
    }
    else{
        echo 'var infowindow' . $filaActual . ' = new google.maps.InfoWindow({';
        echo "content: '<a href=\"http://localhost/damelapatita/paginas/fichaAnimal.php?id=" . $row['id'] . "\">" . "Desconocido</a><br><p>" . utf8_encode($row['informacion']) ."</p>'";
        echo '});';
    }
    

    // Añadimos un evento de clic al marcador
    echo "google.maps.event.addListener(marker" . $filaActual .", 'click', function() {";
        // Llamamos el método open del InfoWindow
        echo "infowindow" . $filaActual . ".open(map, marker" . $filaActual . ");";
    echo "});";
    
    $filaActual = $filaActual + 1;
} // Fin while

echo '}'; // Fin iniciarMapa


echo '</script>'; // Fin de script general
// Script asíncrono para la carga del mapa
echo '<script async defer src="http://maps.google.com/maps/api/js?sensor=false&callback=iniciarMapa"></script>';
