<!DOCTYPE html>
<?php
    error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
    session_start();

    if ($now > $_SESSION['expire']){
        session_destroy();
        header('location: /damelapatita/paginas/finSesion.html');
    }

    include("../lib/gestionAnimales.php");
    include("../lib/formatos.php");
    include("../lib/provincias.php");

    if (isset($_GET['pos']))
        $ini = $_GET['pos'];
    else
        $ini = 1;

    if(isset($_GET['tipo'])){
        $tipoBusqueda = $_GET['tipo'];
    }
    else{
        $tipoBusqueda = NULL;
    }

    if (isset($_GET['provincia'])){
        $provinciaBusqueda = "'" . $_GET['provincia'] . "'";
    }
    else{
        $provinciaBusqueda = NULL;
    }
?>
<html lang="es" data-ng-app="secciones" itemscope itemtype="http://schema.org/Organization">

    <head>

        <!-- Medatadatos -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!-- Metadatos para Facebook -->
        <meta property="og:url" content="http://127.0.0.1:8080/index.php" />
        <meta property="og:title" content="Dame la patita" />
        <meta property="og:description" content="Web para la adopcion y busqueda de animales perdidos" />
        <meta property="og:image" content="img/logoOriginal.png" />

        <!-- Metadatos para Google+ -->
        <meta itemprop="name" content="Dame la patita">
        <meta itemprop="description" content="Web para adopcion y busqueda de animales perdidos">
        <meta itemprop="image" content="img/logoOriginal.png">

        <!-- Título -->
        <title>Dame la patita</title>

        <!-- Hojas de estilo -->
        <link rel="shortcut icon" href="/damelapatita/img/favicon.ico" />
        <link href="/damelapatita/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/estilosPrincipales.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/cabecera.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/informacion.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/redesSociales.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/anuncios.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/adoptables.css" media="screen">


        <!-- Ficheros JavaScript -->
        <script src="/damelapatita/js/jquery-2.2.3.min.js"></script>
        <script src="/damelapatita/js/angular.min.js"></script>
        <script src="/damelapatita/js/bootstrap.min.js"></script>
        <script src="/damelapatita/js/acciones/redesSociales.js"></script>
        <script src="/damelapatita/js/directivas/seccionesDirectivas.js"></script>

    </head>

    <body>

        <!-- Menú superior -->
        <div class="container">

            <?php
            if (isset($_SESSION['loggedin']) & $_SESSION['loggedin'] == true){
                echo "<cabeceraconlogin></cabeceraconlogin>";
            }
            else{

                echo "<cabecerasinlogin></cabecerasinlogin>";
            }
            ?>
            <!-- Cabeceras -->


        </div> <!-- Fin Menú superior -->

        <!-- Contenedor general -->
        <div id="wrapper">

            <!-- Sidebar extra -->
            <div id="sidebar-wrapper" class="hidden-xs">
                <ul class="sidebar-nav">

                    <!-- Acordeón -->
                    <li>
                        <informacion></informacion>
                    </li>

                    <!-- Redes sociales -->
                    <div class="caja-redes">

                        <!-- Twitter -->
                        <a href="http://twitter.com/share?text=Dame%20la%20patita" class="icon-button twitter" id="twitter-popup">
                            <i class="icon-twitter"></i>
                            <span></span>
                        </a>

                        <!-- Facebook -->
                        <a href="http://www.facebook.com/sharer.php?u=http://127.0.0.1:15051/index.html" class="icon-button facebook" id="facebook-popup">
                            <i class="icon-facebook"></i>
                            <span></span>
                        </a>

                        <!-- Google Plus -->
                        <a href="https://plus.google.com/share?url=http://127.0.0.1:15051/index.html" class="icon-button google-plus" id="plus-popup">
                            <i class="icon-google-plus"></i>
                            <span></span>
                        </a>

                    </div> <!-- Fin Redes sociales -->

                </ul>
            </div> <!-- Fin sidebar extra -->

            <!-- Contenido principal -->
            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-9" id="barrica">

                            <h5>Filtrar resultados</h5>

                            <!-- Formulario de busqueda -->
                            <form action="" method="get" class="form-horizontal" id="filtroForm">

                                <div class="col-md-6">
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="" disabled selected>Tipo de animal</option>
                                        <?php
                                            $stmt = tiposAnimales();
                                            $stmt->execute();

                                            while ($row = $stmt->fetch()){

                                                echo '<option value="' . $row['id'] . '">' . $row['tipo'] . '</option>';

                                            } // Fin del while
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <select class="form-control" name="provincia" id="provincia">
                                        <option value="" disabled selected>Provincia</option>

                                        <?php
                                            $optionProvincas = devolverProvincias();
                                            for ($i = 0; $i < count($provincias) ; $i++) {
                                                echo '<option value="' . $provincias[$i] . '">' . $provincias[$i] . '</option>';
                                            }
                                        ?>

                                    </select>
                                </div>

                                <div class="col-xs-12 pull-right" id="contenedorSubmit">
                                    <input type="submit" id="btnEnviar" name="submit" class="btn btn-danger col-xs-12">
                                </div>

                            </form>

                            <?php

                            // Variables
                            $url = basename($_SERVER["PHP_SELF"]);
                            $limit_end = 9;
                            $init = ($ini - 1) * $limit_end;

                            try{
                                // Calculo el numero de paginas
                                $num = cantidadAnimalesAdoptados(4, $tipoBusqueda, $provinciaBusqueda);
                                $num->execute();
                                $x = $num->fetch();
                                $total = ceil($x[0] / $limit_end);

                                // Consulta para presentar los animales
                                $animalicos = animalesAdopcion(4, $init, $limit_end, $tipoBusqueda, $provinciaBusqueda);
                                $animalicos->execute();

                                // Presento los animales
                                while ($resultado = $animalicos->fetch()){
                                    echo '<a href="http://localhost/damelapatita/paginas/fichaAnimal.php?id=' . $resultado['id'] . '"><div class="casilla">';
                                    echo '<div class="fondo" style="background-image: url(' . crearRutaImagen($resultado['ruta_imagen']) . ');"></div>';
                                    echo '<div class="content">';
                                    echo '<div class="table">';
                                    echo '<div class="table-cell">';
                                    echo $resultado['calle'] . ', ' . $resultado['localidad'];
                                    echo '</div>'; // Fin table-cell
                                    echo '</div>'; // Fin table
                                    echo '</div>'; // Fin content
                                    echo '</div></a>'; // Fin casilla
                                }

                                // Genero la paginacion
                                echo '<div class="text-center col-md-12">';

                                echo '<ul class="pagination pagination-lg">';

                                if (($ini - 1) == 0){
                                    echo "<li><a href='#'>&laquo;</a></li>";
                                }
                                else{
                                    echo "<li><a href='$url?pos=".($ini-1)."'><b>&laquo;</b></a></li>";
                                }

                                for ($k = 1; $k <= $total; $k++){
                                    if ($ini == $k){
                                        echo "<li><a href='#'><b>".$k."</b></a></li>";
                                    }
                                    else{
                                       echo "<li><a href='$url?pos=$k'>".$k."</a></li>";

                                    }
                                } // Fin de for

                                if ($ini == $total){
                                    echo "<li><a href='#'>&raquo;</a></li>";
                                }
                                else{
                                    echo "<li><a href='$url?pos=".($ini+1)."'><b>&raquo;</b></a></li>";
                                }

                                echo "</ul>";
                                echo "</div>";
                            } catch (PDOException $ex) {
                                echo $ex->getMessage();
                            }
                            finally{
                                desconectar($resultado);
                                desconectar($animalicos);
                                desconectar($baseDatos);
                            }
                            ?>

                        </div> <!-- Fin información central -->

                        <!-- Sidebar publicidad -->
                        <div class="col-xs-12 col-md-3">

                            <anuncios></anuncios>

                        </div> <!-- Sidebar publicidad -->

                    </div> <!-- Fin div row -->
                </div> <!-- Fin div container-fluid -->
            </div> <!-- Fin contenido principal -->

        </div> <!-- Fin contenedor general -->

    </body>
</html>
