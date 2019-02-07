<?php

error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
session_start();

if (!$_SESSION['loggedin']){
    header('location: /damelapatita/index.php');
}

if ($now > $_SESSION['expire']){
    session_destroy();
    header('location: /damelapatita/paginas/finSesion.html');
}

include("../lib/gestionAnimales.php");
include("../lib/provincias.php");

$idAnimalPasado = $_GET['anuncio'];
$stmt = verAnimal($idAnimalPasado);
$stmt->execute();
$row = $stmt->fetch();

$nombre = $row['nombre'];
$sexo = $row['sexo'];
$altura = $row['altura'];
$peso = $row['peso'];
$caracter = $row['caracter'];
$informacion = $row['informacion'];
$tlfn1 = $row['tlfn1'];
$tlfn2 = $row['tlfn2'];

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
        <link rel="shortcut icon" href="/damelapatita/img/favicon.ico" />
        <link href="/damelapatita/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/estilosPrincipales.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/cabecera.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/informacion.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/redesSociales.css" media="screen">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/anuncios.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/fichaAnimal.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/configuracion.css">

        <!-- Ficheros JavaScript -->
        <script src="/damelapatita/js/jquery-2.2.3.min.js"></script>
        <script src="/damelapatita/js/angular.min.js"></script>
        <script src="/damelapatita/js/bootstrap.min.js"></script>
        <script src="/damelapatita/js/acciones/redesSociales.js"></script>
        <script src="/damelapatita/js/directivas/seccionesDirectivas.js"></script>
        <script src="/damelapatita/js/acciones/configuracion.js"></script>

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

                            <h4>Editar animal</h4>
                            <form action="/damelapatita/llamadasPHP/modificacionAnimal.php" method="post" class="form-horizontal">

                                <?php
                                // Paso el id en un formulario invisible
                                echo '<input type="text" class="form-control disable hidden" name="idFormAn" '
                                . 'id="idFormAn" placeholder="Nombre"  value="' . $idAnimalPasado . '" '
                                . '>';
                                ?>
                                <!-- Form-group nombre -->
                                <div class="form-group">

                                    <h5 class="col-md-12">Nombre:</h5>
                                    <div class="col-md-6">
                                        <?php
                                        echo '<input type="text" class="form-control disable" name="nombreUsuario" '
                                        . 'id="nombreAnimal" placeholder="Nombre"  value="' . $nombre . '" '
                                        . 'required disabled>';
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nuevoNombre" id="nuevoNombre" placeholder="Nuevo nombre">
                                    </div>

                                </div> <!-- Fin form-group nombre -->

                                <!-- Form-group sexo -->
                                <div class="form-group">

                                    <h5 class="col-md-12">Sexo:</h5>
                                    <div class="col-md-6">
                                        <?php
                                        echo '<input type="text" class="form-control disable" name="sexoAnimal" '
                                        . 'id="sexoAnimal" placeholder="Sexo"  value="' . $sexo . '" '
                                        . 'required disabled>';
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="nuevoSexo" id="nuevoSexo" class="form-control">
                                            <?php echo '<option value="' . $sexo . '" selected>' . $sexo . '</option>'; ?>
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                            <option value="Indefinido">Indefinido</option>
                                        </select>
                                    </div>

                                </div> <!-- Fin form-group sexo -->

                                <!-- Form-group altura -->
                                <div class="form-group">

                                    <h5 class="col-md-12">Altura:</h5>
                                    <div class="col-md-6">
                                        <?php
                                        echo '<input type="text" class="form-control disable" name="alturaAnimal" '
                                        . 'id="alturaAnimal" placeholder="Altura"  value="' . $altura . '" '
                                        . 'required disabled>';
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nuevaAltura" id="nuevaAltura" placeholder="Nueva altura (cm)">
                                    </div>

                                </div> <!-- Fin form-group altura -->

                                <!-- Form-group peso -->
                                <div class="form-group">

                                    <h5 class="col-md-12">Peso:</h5>
                                    <div class="col-md-6">
                                        <?php
                                        echo '<input type="text" class="form-control disable" name="pesoAnimal" '
                                        . 'id="pesoAnimal" placeholder="Peso"  value="' . $peso . '" '
                                        . 'required disabled>';
                                        ?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="nuevoPeso" id="nuevoPeso" placeholder="Nuevo peso (kg)">
                                    </div>

                                </div> <!-- Fin form-group peso -->

                                <!-- Caracter -->
                                <div class="form-group">
                                    <h5 class="col-md-12">Caracter:</h5>
                                    <div class="col-md-12 espacio">
                                        <?php echo '<input type="text" class="form-control" name="nuevoCaracter" id="nuevoCaracter" placeholder="Carácter" value="' . $caracter . '">'; ?>
                                    </div>
                                </div>

                                <!-- Informacion -->
                                <div class="form-group">
                                    <h5 class="col-md-12">Información:</h5>
                                    <div class="col-md-12">
                                        <?php echo '<textarea name="nuevaInformacion" id="nuevaInformacion" class="form-control" rows="5">' . $informacion . '</textarea>'; ?>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="form-group">

                                    <div class="col-md-12 diestra">
                                        <input type="submit" id="btnEnviar" name="submit" class="btn btn-danger">
                                    </div>
                                </div> <!-- Fin form-group genero -->

                            </form> <!-- Fin formulario -->

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
