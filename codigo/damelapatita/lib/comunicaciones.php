<?php

include_once 'conexion.php';

/**
* Envia un correo electronico
*/
function enviarMail($destinatario, $titulo ,$mensaje){

	// Las lineas no pueden ser mayores de 70 caracteres
	$textoEnvio = wordwrap($mensaje, 70, "\r\n");

	// Creo la cabecera del mensaje
	$cabecera = 'From: webmaster@damelapatita.com' . "\r\n" .
    			'Reply-To: <noreply@thismessage>' . "\r\n" .
    			'X-Mailer: PHP/' . phpversion();


	mail($destinatario, $titulo, $textoEnvio, $cabecera);
}

?>
