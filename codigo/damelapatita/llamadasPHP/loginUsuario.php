<?php

session_start();

include("../lib/gestionUsuarios.php");

$mailUsuario = $_GET['mail'];
$passwordUsuario = $_GET['password'];

$permiso = loguearUsuario($mailUsuario, $passwordUsuario);

// Login correcto
if ($permiso == 1){
    
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $mailUsuario;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (60 * 60); // Duración de 1 hora
    
    header('location: /damelapatita/index.php');
}

// Usuario sin registrar
if ($permiso == -2){
    header('location: /damelapatita/paginas/usuarioSinRegistrar.html');
}

// Usuario baneado
if ($permiso == -1){
    header('location: /damelapatita/paginas/usuarioBaneado.html');
}

// Usuario borrado
if ($permiso == 0){
    header('location: /damelapatita/paginas/usuarioBorrado.html');
}

// Usuario borrado
if ($permiso == 2){
    header('location: /damelapatita/paginas/errorLogin.php');
}