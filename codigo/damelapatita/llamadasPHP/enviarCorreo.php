<?php

session_start();

include '../lib/comunicaciones.php';
include '../lib/gestionAnimales.php';

// Capturo datos del formulario
$nombreSender = htmlspecialchars($_POST['nombreSender']);
$mailSender = htmlspecialchars($_POST['mailSender']);
$telefonoSender = htmlspecialchars($_POST['telSender']);
$mensaje = htmlspecialchars($_POST['mensajeSender']);
$animalAnuncio = $_POST['idAnimalSender'];

// Titulo del mensaje
$titulo = "Te respondieron a tu anuncio en DameLaPatita.com";

// Genero la URL de la que viene la petición
$url = "http://localhost/damelapatita/paginas/fichaAnimal.php?id=" . $animalAnuncio;

// Creo el contenido HTML para el mail
$cabecera = "<h1>Has recibido una nueva respuesta a tu anuncio</h1>";
$subcabecera = "<h2>Puedes ver tu publicación aquí: " . $url ."</h2>";
$contenido = "<p>Datos de quien te contacta:"
        . "Nombre: " . $nombreSender 
        . "Email para responder: " . $mailSender
        . "Telefono de contacto: " . $telefonoSender
        . "</p>"
        . "<p> Contenido del mensaje:"
        . $mensaje
        . "</p>";

$mailCompleto = $cabecera . $subcabecera . $contenido;

// Envio el mail
enviarMail(verPublicador($animalAnuncio), $titulo, $$mailCompleto);

// Redirijo a la página del anuncio una vez enviado el correo
header('location: ' . $url);
?>