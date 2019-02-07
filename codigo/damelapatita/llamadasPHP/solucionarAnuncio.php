<?php

session_start();

if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

include '../lib/gestionAnimales.php';
$_GET['anuncio'];

actualizarEstado($_GET['anuncio'], 1);

header('location: ../paginas/misAnimales.php');