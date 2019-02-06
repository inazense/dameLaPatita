<!DOCTYPE html>
<?php
    error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
    session_start();

    if ($now > $_SESSION['expire']){
        session_destroy();
        header('location: /damelapatita/paginas/finSesion.html');
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
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/central.css">
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/anuncios.css">

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

                        <!-- Información central -->
                        <div class="col-md-9" id="barrica">

                            <central></central>

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
