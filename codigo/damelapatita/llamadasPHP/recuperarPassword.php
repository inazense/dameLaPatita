<?php

include_once '../lib/formatos.php';
include_once '../lib/gestionUsuarios.php';
include_once '../lib/comunicaciones.php';

$nuevoPass = getRandomCode();
$mailUsuario = $_POST['mailUsuario'];

if (generarPassword($mailUsuario, $nuevoPass)){
    $titulo = "Nueva contraseña en Dame la patita";
    $mensaje = "Se ha generado una nueva contraseña en Dame La Patita. \n".
            "Para loguearte, visita http://localhost/damelapatita y en la sección de login introduce "
            . "tu mail y la siguiente contraseña:\n"
            . $nuevoPass . "\nY recuerda, no compres, adopta";
    enviarMail($mailUsuario, $titulo, $mensaje);
}
echo "<script type='text/javascript'>"; 
echo "window.close()"; 
echo "</script>"; 