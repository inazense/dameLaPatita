<?php

include("../lib/gestionUsuarios.php");

$apellidosUsuario = htmlspecialchars($_POST["apellidosUsuario"]);
$nombreUsuario = htmlspecialchars($_POST["nombreUsuario"]);
$mailUsuario = htmlspecialchars($_POST["mailUsuario"]);
$passwordUsuario = htmlspecialchars($_POST["passwordUsuario"]);
$nacimientoUsuario = htmlspecialchars($_POST["nacimientoUsuario"]);
$localidadUsuario = htmlspecialchars($_POST["localidadUsuario"]);
$provinciaUsuario = htmlspecialchars($_POST["provincia"]);
$sexoUsuario = htmlspecialchars($_POST["sexo"]);

if (comprobarUsuario($mailUsuario) == -2){
    
    nuevoUsuario($mailUsuario, encriptarPassword($passwordUsuario), $nombreUsuario, $localidadUsuario, 
            $provinciaUsuario, $nacimientoUsuario, $sexoUsuario);
    header('Location: /damelapatita/paginas/afterRegistro.html');
}

