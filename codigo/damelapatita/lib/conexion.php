<?php


/**
 * Crea un conector PDO a base de datos MySQL
 * @return PDO Connection
 */
function conectar(){
    $servidorBD = 'localhost';
    $nombreBD = 'proyecto_fin_dam';
    $usuarioBD = 'usuario_basico';
    $passwordBD = 'm0nster!!';

    $dbh = new PDO("mysql:host=$servidorBD;dbname=$nombreBD;charset=utf8", $usuarioBD, $passwordBD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
} // Fin conectar()

/**
 * Desconecta el conector PDO y lo retorna
 * @param PDO Connection $dbh
 * @return NULL
 */
function desconectar($dbh){
    if ($dbh != NULL){
        $dbh = NULL;
    }

    return $dbh;
} // Fin desconectar
