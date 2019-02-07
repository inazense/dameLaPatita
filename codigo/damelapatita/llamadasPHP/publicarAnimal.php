<?php

session_start();

// Si la sesión no está iniciada, redirijo a la página inicial
if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

// Importo librerias
include_once '../lib/gestionAnimales.php';
include_once '../lib/gestionUsuarios.php';
include_once '../lib/geoposicionamiento.php';

// Capturo el formulario por POST
$tipoAnuncio = $_POST['tipoAnuncio'];
if (strlen($_POST['calle']) > 0){
    $calle = htmlspecialchars($_POST['calle']);
}
else{
    $calle = '';
}

$localidad = $_POST['localidad'];
$tipoAnimal = $_POST['tipoAnimal'];
$provincia = $_POST['provincia'];

if (strlen($_POST['nombre']) > 0){
    $nombre = htmlspecialchars($_POST['nombre']);
}
else{
    $nombre = NULL;
}

if (strlen($_POST['sexo']) > 0){
    $sexo = htmlspecialchars($_POST['sexo']);
}
else{
    $sexo = NULL;
}

if (strlen($_POST['edad']) > 0){
    $edad = htmlspecialchars($_POST['edad']);
}
else{
    $edad = NULL;
}

if (strlen($_POST['caracter']) > 0){
    $caracter = htmlspecialchars($_POST['caracter']);
}
else{
    $caracter= NULL;
}

if (strlen($_POST['informacion']) > 0){
    $informacion = htmlspecialchars($_POST['informacion']);
}
else{
    $informacion = NULL;
}

if (strlen($_POST['peso']) > 0){
    $peso = htmlspecialchars($_POST['peso']);
}
else{
    $peso = NULL;
}

if (strlen($_POST['altura']) > 0){
    $altura = htmlspecialchars($_POST['altura']);
}
else{
    $altura = NULL;
}

if (strlen($_POST['tlfn1']) > 0){
    $tlfn1 = htmlspecialchars($_POST['tlfn1']);
}
else{
    $tlfn1 = NULL;
}

if (strlen($_POST['tlfn2']) > 0){
    $tlfn2 = htmlspecialchars($_POST['tlfn2']);
}
else{
    $tlfn2 = NULL;
}

// Creo la cadena para el geoposicionamiento
$cadena = $calle . ', ' . $localidad . ', ' . $provincia . ', ' . 'Spain';

// Capturo la latitud, longitud y dirección formateada
$data_arr = geocode($cadena);

// Si los datos son correctos, guardo la posición
if ($data_arr){
    $latitud = $data_arr[0];
    $longitud = $data_arr[1];
    // $formatted_address = $data_arr[2]; USADO PARA TESTS. Es la dirección completa
}
else{
    $latitud = NULL;
    $longitud = NULL;
}

// Llamo al id del usuario usando la variable de sesión
$stmt = verUsuarioDesdeMail($_SESSION['username']);
$stmt->execute();
$row = $stmt->fetch();
$usuario = $row['id'];

// Inserto todos los datos recogidos
insertarNuevoAnimal($tipoAnimal, $usuario, $nombre, $sexo, $edad, $caracter, $informacion, $peso, $altura, $calle, $localidad, $provincia, $latitud, $longitud, $tlfn1, $tlfn2, $tipoAnuncio);

/***************************
    SUBIDA DE FOTOGRAFIAS
***************************/

// Averiguo el id del animal para generar la carpeta
$numAnimal = cantidadAnimalesTotal();

// Genero el nombre de la carpeta
$rutaCarpeta = "..\\..\\img\\animales\\$numAnimal";

// Compruebo si existe y si no creo la carpeta y subdirectorios de esta
if (!is_dir($rutaCarpeta)){
    mkdir($rutaCarpeta, 0700, true);
    mkdir("$rutaCarpeta\\facturas", 0700, true);
    mkdir("$rutaCarpeta\\img", 0700, true);
}

// Comienzo la subida de archivos    
$rutaCarpeta = "$rutaCarpeta\\img\\";

// Si hay algun archivo que añadir
if ($_FILES["archivo"]["name"][0]){
    
    // Recorro todos los archivos que se han subido
    for ($i = 0; $i < count($_FILES["archivo"]["name"]); $i++){
        $origen = $_FILES["archivo"]["tmp_name"][$i];
        $destino = $rutaCarpeta.$_FILES["archivo"]["name"][$i];
        
        // Muevo el archivo
        if(@move_uploaded_file($origen, $destino)){
            insertarFoto($numAnimal, "animales/$numAnimal/img/" . basename($_FILES['archivo']['name'][$i]));
        }
    } // Fin for
} // Fin if

