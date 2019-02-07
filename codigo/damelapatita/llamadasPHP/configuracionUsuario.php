<?php

session_start();

if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

include("../lib/gestionUsuarios.php");

if (strlen($_POST['nuevoNombre']) > 0){
    actualizarNombre($_SESSION['username'], $_POST['nuevoNombre']);
}
if (strlen($_POST['passwordViejo']) > 0 && strlen($_POST['passwordNuevo1']) > 0){
    actualizarPassword($_SESSION['username'], $_POST['passwordViejo'], $_POST['passwordNuevo1']);
}

if (strlen($_POST['localidadUsuario']) > 0){
    actualizarLocalidad($_SESSION['username'], $_POST['localidadUsuario']);
}

actualizarProvincia($_SESSION['username'], $_POST['provincia']);

header('location: /damelapatita/paginas/configuracion.php');
