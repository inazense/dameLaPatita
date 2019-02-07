<?php

session_start();

include '../lib/gestionAnimales.php';

// Capturo datos del formulario
$nombreDenunciante = htmlspecialchars($_POST['nombreDenunciante']);
$mailDenunciante = htmlspecialchars($_POST['mailDenunciante']);
$mensajeDenunciante = htmlspecialchars($_POST['mensajeDenunciante']);
$idAnimalDenunciante = $_POST['idAnimalDenunciante'];

// URL de donde se produce la denuncia
$url = "http://localhost/damelapatita/paginas/fichaAnimal.php?id=" . $idAnimalDenunciante;

// Envio el mensaje al administrador
generarDenuncia($idAnimalDenunciante, $nombreDenunciante, $mailDenunciante, $mensajeDenunciante);

// Redirijo a la página del anuncio una vez enviado el correo
header('location: ' . $url);