<?php

include_once 'conexion.php';

/**
 * Comprueba la existencia de mails
 * @param string $mailUsuario
 * @return -2 no existe // -1 = Banneado // 0 = Dado de baja // 1 = Login permitido
 */
function comprobarUsuario($mailUsuario){

    $baseDatos = conectar();
    $sql = "SELECT * FROM usuarios WHERE mail = ?";
    $stmt = $baseDatos->prepare($sql);
    $stmt->bindParam(1, $mailUsuario, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 0){
        return -2;
    }
    else{
        $row = $stmt->fetch();
        return $row['activo'];
    }

    $stmt = null;
    $baseDatos = null;
} // Fin comprobarUsuario

/**
* Encripta una password // PHP7 recomienda generar $salt automaticamente
*/
function encriptarPassword($password){
    return crypt($password);
} // Fin encriptarPassword

/**
* Comprueba si dos passwords, uno de ellos encriptado, coinciden
*/
function validarPassword($passwordTest, $passwordGuardado){

    // TODO:
    if (hash_equals($passwordGuardado, crypt($passwordTest, $passwordGuardado))){
        return 1;
    }
    else{
        return 0;
    }
} // Fin validarPassword

/**
* Inserta un nuevo usuario en la base de datos
*/
function nuevoUsuario($mailUsuario, $passwordUsuario, $nombreUsuario, $localidadUsuario, $provinciaUsuario,
        $nacimientoUsuario, $sexoUsuario){

    $conn = conectar();
    $sql = "INSERT INTO usuarios(mail, pass_cuenta, nombre, localidad, provincia, fecha_nacimiento, genero, "
            . "privacidad, activo) VALUES(?, ?, ?, ?, ?, ?, ?, 0, 1)";
    $statement = $conn->prepare($sql);
    $statement->bindParam(1, $mailUsuario, PDO::PARAM_STR);
    $statement->bindParam(2, $passwordUsuario, PDO::PARAM_STR);
    $statement->bindParam(3, $nombreUsuario, PDO::PARAM_STR);
    $statement->bindParam(4, $localidadUsuario, PDO::PARAM_STR);
    $statement->bindParam(5, $provinciaUsuario, PDO::PARAM_STR);
    $statement->bindParam(6, $nacimientoUsuario, PDO::PARAM_STR);
    $statement->bindParam(7, $sexoUsuario, PDO::PARAM_STR);

    $statement->execute();

} // Fin nuevoUsuario

/**
* Devuelve estado para permitir logueo
*/
function loguearUsuario($mailUsuario, $passwordUsuario){

    if (comprobarUsuario($mailUsuario) == 1){

        $conn = conectar();
        $sql = "select mail, pass_cuenta "
                . "from usuarios "
                . "where mail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $mailUsuario, PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch();

        if (validarPassword($passwordUsuario, $row['pass_cuenta'])){
            return 1;
        }
        else{
            return 2;
        }
    }
    else{
        return comprobarUsuario($mailUsuario);
    }

} // Fin loguearUsuario

/**
* Devuelve el usuario que publico el animal
* pasado por parámetro
*/
function verUsuario($idUsuario){

	$conn = conectar();

	$sql = "select * from usuarios where id = ?;";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
    return $stmt;

} // Fin verUsuario

/**
 * Devuelvo a un usuario completo según su mail
 * @param string $mailUsuario
 * @return Statement PDO
 */
function verUsuarioDesdeMail($mailUsuario){

    $conn = conectar();

    $sql = "select * from usuarios where mail = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $mailUsuario, PDO::PARAM_STR);

    return $stmt;

} // fin verUsuarioDesdeMail

/**
 * Actualiza el campo nombre de un usuario
 * @param string $mail
 * @param type $nombre
 */
function actualizarNombre($mail, $nombre){

    $conn = conectar();

    $sql = "update usuarios set nombre = ? where mail = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nombre, PDO::PARAM_STR);
    $stmt->bindParam(2, $mail, PDO::PARAM_STR);

    $stmt->execute();
}

/**
 * Actualizar el campo pass_cuenta de un usuario
 * @param string $mail
 * @param string $passwordAntiguo
 * @param string $passwordNuevo
 */
function actualizarPassword($mail, $passwordAntiguo, $passwordNuevo){

    $conn = conectar();
    $sql = "select pass_cuenta "
            . "from usuarios "
            . "where mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $mail, PDO::PARAM_STR);
    $stmt->execute();

    $row = $stmt->fetch();

    if (validarPassword($passwordAntiguo, $row[0])){
        $passEncriptado = encriptarPassword($passwordNuevo);

        $sql = "update usuarios set pass_cuenta = ? where mail = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $passEncriptado, PDO::PARAM_STR);
        $stmt->bindParam(2, $mail, PDO::PARAM_STR);
        $stmt->execute();
    }
}

/**
 * Actualiza el campo localidad de un usuario
 * @param string $mail
 * @param string $nuevaLocalidad
 */
function actualizarLocalidad($mail, $nuevaLocalidad){
    $conn = conectar();

    $sql = "update usuarios set localidad = ? where mail = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevaLocalidad, PDO::PARAM_STR);
    $stmt->bindParam(2, $mail, PDO::PARAM_STR);

    $stmt->execute();
}

/**
 * Actualiza el campo provincia de un usuario
 * @param string $mail
 * @param string $nuevaProvincia
 */
function actualizarProvincia($mail, $nuevaProvincia){
    $conn = conectar();

    $sql = "update usuarios set provincia = ? where mail = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevaProvincia, PDO::PARAM_STR);
    $stmt->bindParam(2, $mail, PDO::PARAM_STR);

    $stmt->execute();
}

/**
 * Establece un nuevo password machacando el anterior.
 * PRECAUCION. SOLO IMPLEMENTAR SI REINICIO DE CONTRASEÑA FORZOSO
 * @param string $mail
 * @param string $pass
 */
function generarPassword($mail, $pass){

    $passEncriptado = encriptarPassword($pass);

    $conn = conectar();
    $sql = "update usuarios set pass_cuenta = ? where mail = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $passEncriptado);
    $stmt->bindParam(2, $mail);
    if ($stmt->execute())
        return TRUE;
    else
        return FALSE;
}
