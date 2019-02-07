<?php
    // Librerias
    include '../lib/conexion.php';
    include '../lib/formatos.php';
?>

<div class="container" id="centralContainer">
    
    
    <!-- Sección mapa -->
    <mapa></mapa>
    
    <!-- Sección ultimos añadidos -->
    
    <h4>Buscan hogar</h4>
    
    <?php
        // Consulta
        try{
            // Creo la conexion a la base de datos
            $baseDatos = conectar();
            
            $sql = "select distinct a.id, nombre, edad, ruta_imagen "
                    . "from animales a, fotos_animales f "
                    . "where a.estado = 2 and ruta_imagen = ( "
                        . "select ruta_imagen "
                        . "from fotos_animales fa "
                        . "where fa.animal = a.id "
                        . "order by id limit 1 ) "
                    . "order by a.id desc "
                    . "limit 12;";
            
            // Preparo y ejecuto la consulta
            $stmt = $baseDatos->prepare($sql);
            $stmt->execute(); 

            // Imprimir resultados
            while($row = $stmt->fetch()){

                echo '<a href="http://localhost/damelapatita/paginas/fichaAnimal.php?id=' . $row['id'] . '"><div class="casilla">'.
                // Imagen de fondo
                '<div class="fondo" style="background-image: url(\'http://127.0.0.1/img/' . $row['ruta_imagen'] .'\');"></div>'.
                // Texto
                '<div class="content">'.
                '<div class="table">'.
                '<div class="table-cell">'.
                $row['nombre'] . ', ' . cadenaEdad($row['edad']).
                '</div>'. // Fin table-cell 
                '</div>'. // Fin table
                '</div>'. // Fin content
                '</div></a>'; // Fin casilla
            } // Fin while
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        finally{
            desconectar($row);
            desconectar($stmt);
            desconectar($baseDatos);
        }
        
    ?>
    
</div> <!-- Fin container -->


