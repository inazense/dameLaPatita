<?php

include_once 'conexion.php';
include_once 'gestionUsuarios.php';

/**
 * Prepara la consulta para cargar los animales
 * perdidos y encontrados en el mapa de Google
 * @return Statment PDO listo para ejecutar
 */
function animalesMaps(){

    $conn = conectar();
    $sql = "SELECT id, nombre, estado, informacion, latitud, longitud FROM animales WHERE estado = 3 OR estado = 4;";

    $stmt = $conn->prepare($sql);
    return $stmt;
}

/**
 * Devuelvo el listado de animales segun su estado, con limites
 * @param int $estado
 * @param int $init
 * @param int $limit_end
 * @return Statment PDO ya ejecutado
 */
function animalesAdopcion($estado, $init, $limit_end, $tipoBusqueda, $provinciaBusqueda){

    $conn = conectar();

    if ($tipoBusqueda != NULL && $provinciaBusqueda != NULL){
        $sql = "select distinct a.id, nombre, edad, ruta_imagen, calle, localidad "
            . "from animales a, fotos_animales f "
            . "where a.estado = ? and tipo = $tipoBusqueda and provincia like $provinciaBusqueda and ruta_imagen = ( "
                . "select ruta_imagen "
                . "from fotos_animales fa "
                . "where fa.animal = a.id "
                . "order by id limit 1 ) "
            . "order by a.id desc "
            . "limit ?,?";
    }
    else if ($tipoBusqueda != NULL && $provinciaBusqueda == NULL){
        $sql = "select distinct a.id, nombre, edad, ruta_imagen, calle, localidad "
            . "from animales a, fotos_animales f "
            . "where a.estado = ? and tipo = $tipoBusqueda and ruta_imagen = ( "
                . "select ruta_imagen "
                . "from fotos_animales fa "
                . "where fa.animal = a.id "
                . "order by id limit 1 ) "
            . "order by a.id desc "
            . "limit ?,?";
    }
    else if ($tipoBusqueda == NULL && $provinciaBusqueda != NULL){
        $sql = "select distinct a.id, nombre, edad, ruta_imagen, calle, localidad "
            . "from animales a, fotos_animales f "
            . "where a.estado = ? and provincia like $provinciaBusqueda  and ruta_imagen = ( "
                . "select ruta_imagen "
                . "from fotos_animales fa "
                . "where fa.animal = a.id "
                . "order by id limit 1 ) "
            . "order by a.id desc "
            . "limit ?,?";
    }
    else{
        $sql = "select distinct a.id, nombre, edad, ruta_imagen, calle, localidad "
            . "from animales a, fotos_animales f "
            . "where a.estado = ? and ruta_imagen = ( "
                . "select ruta_imagen "
                . "from fotos_animales fa "
                . "where fa.animal = a.id "
                . "order by id limit 1 ) "
            . "order by a.id desc "
            . "limit ?,?";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $estado, PDO::PARAM_INT);
    $stmt->bindParam(2, $init, PDO::PARAM_INT);
    $stmt->bindParam(3, $limit_end, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

/**
 * Devuelvo el numero de animales de cada estado
 * @param int $estado
 * @return Statment PDO listo para ejecutar
 */
function cantidadAnimalesAdoptados($estado, $tipoBusqueda, $provinciaBusqueda){

    $conn = conectar();
    if ($tipoBusqueda != NULL and $provinciaBusqueda != NULL){
        $sql = "select count(id) "
            . "from animales "
            . "where estado = ? and tipo = $tipoBusqueda and provincia like $provinciaBusqueda;";
    }
    else if ($tipoBusqueda != NULL and $provinciaBusqueda == NULL){
        $sql = "select count(id) "
            . "from animales "
            . "where estado = ? and tipo = $tipoBusqueda;";
    }
    else if ($tipoBusqueda == NULL and $provinciaBusqueda != NULL){
        $sql = "select count(id) "
            . "from animales "
            . "where estado = ? and provincia like $provinciaBusqueda;";
    }
    else{
        $sql = "select count(id) "
            . "from animales "
            . "where estado = ?;";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $estado, PDO::PARAM_INT);
    return $stmt;
}

/**
 * Listo los tipos de animales guardados
 * @return Statment PDO listo para ejecutar
 */
function tiposAnimales(){
    $conn = conectar();
    $sql = "SELECT id, tipo FROM tipo_animal";

    $stmt = $conn->prepare($sql);
    return $stmt;
}

/**
 * Listo todos los campos de un animal
 * @param type $idAnimal
 * @return Statment PDO listo para ejecutar
 */
function verAnimal($idAnimal){

    $conn = conectar();
    $sql = "select * "
            . "from animales "
            . "where id = ?;";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $idAnimal, PDO::PARAM_INT);
    return $stmt;
}

/**
 * Devuelvo el mail del usuario que publico el animal
 * @param type $idAnimal
 * @return string mail del usuario
 */
function verPublicador($idAnimal){

    $stmt = verAnimal($idAnimal);
    $stmt->execute();
    $row = $stmt->fetch();

    $stmt = verUsuario($row['usuario']);
    $stmt->execute();
    $row = $stmt->fetch();

    return $row['mail'];
}

/**
 * Listo las fotos de un animal
 * @param int $idAnimal
 * @return Statement PDO listo para ejecutar
 */
function verFotosAnimales($idAnimal){

    $conn = conectar();
    $sql = "select * "
            . "from fotos_animales "
            . "where animal = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $idAnimal, PDO::PARAM_INT);
    return $stmt;
}

/**
 * Devuelve todos los animales que coincidan con una palabra clave
 * @param int $estado
 * @param string $palabraClave
 * @return Statment PDO listo para ejecutar
 */
function listarAnimalesBusquedaCampos($estado, $palabraClave){

    $conn = conectar();
    $sql = "select distinct a.id, nombre, edad, ruta_imagen, calle, localidad "
            . "from animales a, fotos_animales f "
            . "where a.estado = ? and "
            . "(localidad like ? or provincia like ? or nombre like ? or calle like ? or tipo = (select id from tipo_animal where tipo like ?)) "
            . "and ruta_imagen = ( "
                . "select ruta_imagen "
                . "from fotos_animales fa "
                . "where fa.animal = a.id "
                . "order by id limit 1 )";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $estado, PDO::PARAM_INT);
    $stmt->bindParam(2, $palabraClave, PDO::PARAM_STR);
    $stmt->bindParam(3, $palabraClave, PDO::PARAM_STR);
    $stmt->bindParam(4, $palabraClave, PDO::PARAM_STR);
    $stmt->bindParam(5, $palabraClave, PDO::PARAM_STR);
    $stmt->bindParam(6, $palabraClave, PDO::PARAM_STR);


    return $stmt;
}

/**
 * Muestra los anuncios que ha publicado un usuario en concreto
 * @param int $estado
 * @param string $mailUsuario
 * @return Statement PDO con los resultados o NULL si hay algun fallo
 */
function verAnunciosPropios($estado, $mailUsuario){

    $stmt = verUsuarioDesdeMail($mailUsuario);
    $stmt->execute();
    $row = $stmt->fetch();

    $idUsuario = $row['id'];

    $conn = conectar();

    $sql = "SELECT * FROM animales WHERE estado = ? AND usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $estado, PDO::PARAM_INT);
    $stmt->bindParam(2, $idUsuario, PDO::PARAM_INT);

    return $stmt;
}

/**
 * Actualiza el estado de un animal
 * @param int $idAnimal
 * @param int $nuevoEstado
 */
function actualizarEstado($idAnimal, $nuevoEstado){
    $conn = conectar();

    $sql = "update animales set estado = ? where id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevoEstado, PDO::PARAM_STR);
    $stmt->bindParam(2, $idAnimal, PDO::PARAM_INT);

    $stmt->execute();
}

/**
 * Actualiza el nombre de un animal
 * @param int $idAnimal
 * @param string $nuevoNombre
 */
function actualizarNombreAnimal($idAnimal, $nuevoNombre){
    $conn = conectar();
    
    $sql = "update animales set nombre = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevoNombre, PDO::PARAM_STR);
    $stmt->bindParam(2, $idAnimal, PDO::PARAM_INT);

    $stmt->execute();
}

/**
 * Actualiza el peso de un animal
 * @param int $idAnimal
 * @param double $nuevoPeso
 */
function actualizarPesoAnimal($idAnimal, $nuevoPeso){
    $conn = conectar();
    
    $sql = "update animales set peso = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevoPeso);
    $stmt->bindParam(2, $idAnimal);

    $stmt->execute();
}

/**
 * Actualiza la altura de un animal
 * @param int $idAnimal
 * @param int $nuevaAltura
 */
function actualizarAlturaAnimal($idAnimal, $nuevaAltura){
    $conn = conectar();
    
    $sql = "update animales set altura = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevaAltura);
    $stmt->bindParam(2, $idAnimal);

    $stmt->execute();
}

/**
 * Actualiza el sexo de un animal
 * @param int $idAnimal
 * @param string $nuevoSexo
 */
function actualizarSexoAnimal($idAnimal, $nuevoSexo){
    $conn = conectar();
    
    $sql = "update animales set sexo = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevoSexo);
    $stmt->bindParam(2, $idAnimal);

    $stmt->execute();
}

/**
 * Actualiza el caracter de un animal
 * @param int $idAnimal
 * @param string $nuevoCaracter
 */
function actualizarCaracterAnimal($idAnimal, $nuevoCaracter){
    $conn = conectar();
    
    $sql = "update animales set caracter = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevoCaracter);
    $stmt->bindParam(2, $idAnimal);

    $stmt->execute();
}

/**
 * Actualiza informacion de un animal
 * @param int $idAnimal
 * @param string $nuevaInformacion
 */
function actualizarInformacionAnimal($idAnimal, $nuevaInformacion){
    $conn = conectar();
    
    $sql = "update animales set informacion = ? where id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $nuevaInformacion);
    $stmt->bindParam(2, $idAnimal);

    $stmt->execute();
}

/**
 * Devuelve el ultimo ID
 * @return int ultimo id insertado
 */
function cantidadAnimalesTotal(){

    $conn = conectar();

    $sql = "select id from animales order by id desc limit 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch();
    return $row[0];
}

/**
 * Inserta un nuevo animal en la base de datos (fotografias no)
 * @param int $tipoAnimal
 * @param string $usuario
 * @param string $nombre
 * @param string $sexo
 * @param int $edad
 * @param string $caracter
 * @param string $informacion
 * @param double $peso
 * @param altura $altura
 * @param string $calle
 * @param string $localidad
 * @param string $provincia
 * @param double $latitud
 * @param double $longitud
 * @param string $tlfn1
 * @param string $tlfn2
 * @param int $estado
 */
function insertarNuevoAnimal($tipoAnimal, $usuario, $nombre, $sexo, $edad, $caracter, $informacion, $peso, $altura,
        $calle, $localidad, $provincia, $latitud, $longitud, $tlfn1, $tlfn2, $estado){

    $conn = conectar();
    $sql = "insert into animales(tipo, usuario, nombre, sexo, edad, caracter, informacion, "
            . "peso, altura, calle, localidad, provincia, latitud, longitud, tlfn1, tlfn2, estado) "
            . "values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $tipoAnimal);
    $stmt->bindParam(2, $usuario);
    $stmt->bindParam(3, $nombre);
    $stmt->bindParam(4, $sexo);
    $stmt->bindParam(5, $edad);
    $stmt->bindParam(6, $caracter);
    $stmt->bindParam(7, $informacion);
    $stmt->bindParam(8, $peso);
    $stmt->bindParam(9, $altura);
    $stmt->bindParam(10, $calle);
    $stmt->bindParam(11, $localidad);
    $stmt->bindParam(12, $provincia);
    $stmt->bindParam(13, $latitud);
    $stmt->bindParam(14, $longitud);
    $stmt->bindParam(15, $tlfn1);
    $stmt->bindParam(16, $tlfn2);
    $stmt->bindParam(17, $estado);

    $stmt->execute();
}

/**
 * Inserto una relacion foto / animal en la BD
 * @param int $idAnimal
 * @param string $ruta
 */
function insertarFoto($idAnimal, $ruta){
    $conn = conectar();
    $sql = "insert into fotos_animales(animal, ruta_imagen) values(?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $idAnimal);
    $stmt->bindParam(2, $ruta);
    $stmt->execute();
}

/**
 * Genera una entrada en la seccion denuncias para avisar de un uso inadecuado de la web
 * @param int $idAnimal
 * @param string $denunciante
 * @param string $mail
 * @param string $mensaje
 */
function generarDenuncia($idAnimal, $denunciante, $mail, $mensaje){
    $conn = conectar();
    $sql = "insert into denuncias(animal, denunciante, mail, mensaje) values(?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $idAnimal);
    $stmt->bindParam(2, $denunciante);
    $stmt->bindParam(3, $mail);
    $stmt->bindParam(4, $mensaje);
    $stmt->execute();
}
