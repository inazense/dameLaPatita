<?php

error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
session_start();

if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

if ($now > $_SESSION['expire']){
    session_destroy();
    header('location: /damelapatita/paginas/finSesion.html');
}

include("../lib/gestionAnimales.php");

$nombre = $_POST['nuevoNombre'];
$sexo = $_POST['nuevoSexo'];
$altura = $_POST['nuevaAltura'];
$peso = $_POST['nuevoPeso'];
$caracter = $_POST['nuevoCaracter'];
$informacion = $_POST['nuevaInformacion'];
$idAn = $_POST['idFormAn'];

if (strlen($_POST['nuevoNombre']) > 0){
    actualizarNombreAnimal($idAn, $_POST['nuevoNombre']);
}

if (strlen($_POST['nuevoSexo']) > 0){
    actualizarSexoAnimal($idAn, $_POST['nuevoSexo']);
}

if (strlen($_POST['nuevaAltura']) > 0){
    actualizarAlturaAnimal($idAn, $_POST['nuevaAltura']);
}

if (strlen($_POST['nuevoPeso']) > 0){
    actualizarPesoAnimal($idAn, $_POST['nuevoPeso']);
}

if (strlen($_POST['nuevoCaracter']) > 0){
    actualizarCaracterAnimal($idAn, $_POST['nuevoCaracter']);
}

if (strlen($_POST['nuevaInformacion']) > 0){
    actualizarInformacionAnimal($idAn, $_POST['nuevaInformacion']);
}

header('location: /damelapatita/paginas/misAnimales.php');