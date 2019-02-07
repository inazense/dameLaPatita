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
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/publicacion.css" media="screen">


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

                            <!-- FORMULARIO DE PUBLICACIÓN -->
                            <form enctype="multipart/form-data" action="/damelapatita/llamadasPHP/publicarAnimal.php" method="post" class="form-horizontal">

                                <!-- Tipo de anuncio -->
                                <div class="form-group">

                                    <h5 class="formSectionTitle">Tipo de anuncio</h5>
                                    <div class="col-md-12">
                                        <select name="tipoAnuncio" id="tipoAnuncio" class="form-control" required>
                                            <option value="" disabled selected>Elige tu tipo de anuncio</option>
                                            <option value="2">Animal en adopción</option>
                                            <option value="3">He perdido un animal</option>
                                            <option value="4">Me encontré un animal</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Fin tipo de anuncio -->

                                <!-- Localización -->
                                <div class="form-group" id="formLocalizacion">

                                    <h5 class="formSectionTitle">Localización</h5>

                                    <!-- Calle -->

                                    <div class="col-md-12">
                                        <input type="text" class="form-control espacio" name="calle" id="calle" placeholder="Calle">
                                    </div>

                                    <!-- Localidad -->
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="localidad" id="localidad" placeholder="Localidad" required>
                                    </div>

                                    <!-- Provincia -->
                                    <div class="col-md-6">
                                        <select name="provincia" id="provincia" class="form-control" required>
                                            <option value="" disabled selected>Elige tu provincia</option>
                                            <?php
                                                $optionProvincas = devolverProvincias();
                                                for ($i = 0; $i < count($provincias) ; $i++) {
                                                    echo '<option value="' . $provincias[$i] . '">' . $provincias[$i] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!--  Fin localizacion -->

                                <!-- Datos animal -->
                                <div class="form-group">

                                    <h5 class="formSectionTitle">Datos del animal</h5>

                                    <!-- Nombre -->
                                    <div class="col-md-12 espacio">
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                                    </div>

                                    <!-- Tipo de animal -->
                                    <label for="tipoAnimal" class="control-label col-md-1">Tipo: </label>
                                    <div class="col-md-5">
                                        <select class="form-control" name="tipoAnimal" id="tipoAnimal" required>
                                            <option value="" disabled selected>Elige uno</option>
                                            <?php
                                                $stmt = tiposAnimales();
                                                $stmt->execute();

                                                while ($row = $stmt->fetch()){

                                                    echo '<option value="' . $row['id'] . '">' . $row['tipo'] . '</option>';

                                                } // Fin del while
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Sexo -->
                                    <label for="sexo" class="control-label col-md-1">Sexo:</label>
                                    <div class="col-md-5 espacio">
                                        <select name="sexo" id="sexo" class="form-control">
                                            <option value="Macho">Macho</option>
                                            <option value="Hembra">Hembra</option>
                                            <option value="Indefinido" selected>Indefinido</option>
                                        </select>
                                    </div>

                                    <!-- Edad -->
                                    <div class="col-md-4 espacio">
                                        <input type="text" class="form-control" name="edad" id="edad" placeholder="Edad (en meses)">
                                    </div>

                                    <!-- Peso -->
                                    <div class="col-md-4 espacio">
                                        <input type="text" class="form-control" name="peso" id="peso" placeholder="Peso (en kilogramos)">
                                    </div>

                                    <!-- Altura -->
                                    <div class="col-md-4 espacio">
                                        <input type="text" class="form-control" name="altura" id="altura" placeholder="Altura (en centimetros)">
                                    </div>

                                    <!-- Caracter -->
                                    <div class="col-md-12 espacio">
                                        <input type="text" class="form-control" name="caracter" id="caracter" placeholder="Carácter">
                                    </div>

                                    <div class="col-md-12">
                                        <textarea name="informacion" id="informacion" class="form-control" rows="5"></textarea>
                                    </div>
                                </div>
                                <!-- Fin datos del animal -->

                                <!-- Fotografías -->
                                <div class="form-group">

                                    <h5>Imágenes</h5>

                                    <div class="col-md-12">
                                        <input type="file" class="espacio" name="archivo[]" accept="image/*" multiple="multiple">
                                    </div>
                                </div>
                                <!-- Fin fotografias -->

                                <!-- Contacto -->
                                <div class="form-group">

                                    <h5>Contacto</h5>

                                    <!-- Telefono 1 -->
                                    <div class="col-md-6 espacio">
                                        <input type="tel" class="form-control" name="tlfn1" id="tlfn1" placeholder="Teléfono 1">
                                    </div>

                                    <!-- Telefono 2 -->
                                    <div class="col-md-6 espacio">
                                        <input type="tel" class="form-control" name="tlfn2" id="tlfn2" placeholder="Teléfono 2">
                                    </div>
                                </div>

                                <!-- Botón de enviar -->
                                <div class="form-group">
                                    <div class="col-md-12 envio">
                                        <input type="submit" id="btnEnviado" name="submit" class="btn btn-danger" value="Publicar" class="text-right">
                                    </div>
                                </div>
                                <!--  Fin botón enviar -->

                            </form><!-- Fin formulario -->
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
