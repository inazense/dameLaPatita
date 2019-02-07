<?php

include("../lib/gestionUsuarios.php");

$usuario = $_REQUEST['mailUsuario'];

if(comprobarUsuario($usuario) == -2){
    echo '<div class="success form-control" id="comprobante"></div>';
}
else{
    echo '<div class="error form-control" id="comprobante"></div>';
}

