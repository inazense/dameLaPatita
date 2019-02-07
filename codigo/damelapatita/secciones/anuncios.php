<?php
    // Librerias
    include '../lib/conexion.php';
    session_start();
?>

<h4 id="patrocinadores">Publicidad</h4>

<?php
    
    try{
        $baseDatos = conectar();
        $sql = "call verAnuncios()";
        $stmt = $baseDatos->prepare($sql);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
            echo '<a href="' . $row['enlace'] . '" class="linkPublicidad" target="_blank">'
                . '<div class="anuncio">'
                . '<img src="http://127.0.0.1/img/' . $row['imagen'] . '" alt="" class="img-responsive">'
                . '<h5>' . $row['titulo'] . '</h5>'
                . '</div>'
                . '</div>';
        } // Fin while
    } 
    catch (PDOException $ex) {
        echo $ex->getMessage();
    }
    finally {
        desconectar($baseDatos);
    }

?>