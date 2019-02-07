<?php

session_start();

if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

include '../lib/gestionAnimales.php';
$num = $_GET['anuncio'];
actualizarEstado($num, 0);

header('location: ../paginas/misAnimales.php');

