<!DOCTYPE html>
<?php

    error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
    session_start();

    if ($now > $_SESSION['expire']){
        session_destroy();
        header('location: /damelapatita/paginas/finSesion.html');
    }

    include_once ("../lib/gestionAnimales.php");
    include_once ("../lib/gestionUsuarios.php");
    include_once ("../lib/formatos.php");

    if (isset($_GET['id']))
        $idAnimal = $_GET['id'];
    else
        header('location: /damelapatita/index.php');

?>

<html lang="es" data-ng-app="secciones" itemscope itemtype="http://schema.org/Organization">

    <head>

        <!-- Medatadatos -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

        <!-- Metadatos para Facebook -->

        <meta property="og:url" content="http://localhost/damelapatita" />
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
        <link rel="stylesheet" href="/damelapatita/css/misEstilos/fichaAnimal.css">

        <!-- Ficheros JavaScript -->
        <script src="/damelapatita/js/jquery-2.2.3.min.js"></script>
        <script src="/damelapatita/js/angular.min.js"></script>
        <script src="/damelapatita/js/bootstrap.min.js"></script>
        <script src="/damelapatita/js/acciones/redesSociales.js"></script>
        <script src="/damelapatita/js/directivas/seccionesDirectivas.js"></script>
        <script src="https://use.fontawesome.com/51512c0054.js"></script>
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

                            <?php
                            // Creo la consulta
                            $stmt = verAnimal($idAnimal);
                            $stmt->execute();

                            // Me traigo los campos
                            $row = $stmt->fetch();

                            // Los formateo, para mayor comodidad
                            $nombreAnimal = cambiarCadenasNulas($row['nombre'], "Nombre desconocido");
                            if ($row['edad'] == null){
                                $edadAnimal = "edad desconocida";
                            }
                            else{
                                $edadAnimal = cadenaEdad($row['edad']);
                            }

                            if ($row['calle'] == NULL){
                                $situacion = "Localización: " . $row['localidad'] . ", " . $row['provincia'];
                            }
                            else{
                                $situacion = "Localización: " . $row['calle'] . ", " . $row['localidad'] . ", " . $row['provincia'];
                            }
                            $alturaAnimal = indicarAltura($row['altura']);
                            $pesoAnimal = indicarPeso($row['peso']);
                            $caracterAnimal = cambiarCadenasNulas($row['caracter'], "Caracter desconocido");
                            $informacionAnimal = utf8_decode(cambiarCadenasNulas($row['informacion'], "Sin descripcion"));
                            $usuarioAnimal = $row['usuario']; // Usado para el envío de mails en formulario modal
                            $tlfn1 = $row['tlfn1']; // Visible en modal
                            $tlfn2 = $row['tlfn2']; // Visible en modal

                            // Comienza la impresión de texto

                            // Nombre y edad
                            echo '<div class="col-xs-12 fondoSeccion" id="nombre">';
                            echo '<h5>' . $nombreAnimal . ', ' . $edadAnimal .'</h5>';
                            echo '</div>';

                            // Situacion
                            echo '<div class="col-xs-12 fondoSeccion" id="ubicacion">';
                            echo '<h5>' . $situacion .'</h5>';
                            echo '</div>';

                            // Altura
                            echo '<div class="col-xs-6 fondoSeccion" id="altura">';
                            echo '<h5>' . $alturaAnimal . '</h5>';
                            echo '</div>';

                            // Peso
                            echo '<div class="col-xs-6 fondoSeccion" id="peso">';
                            echo '<h5>' . $pesoAnimal . '</h5>';
                            echo '</div>';

                            // Caracter titulo
                            echo '<div class="col-xs-12 fondoSeccion" id="caracteristicasTitulo">';
                            echo '<h5>Carácter</h5>';
                            echo '</div>';

                            // Caracter contenido
                            echo '<div class="col-xs-12" id="caracteristicasContenido">';
                            echo '<p>' . $caracterAnimal .'</p>';
                            echo '</div>';

                            // Informacion título
                            echo '<div class="col-xs-12 fondoSeccion" id="descripcionTitulo">';
                            echo '<h5>Información</h5>';
                            echo '</div>';

                            // Informacion contenido
                            echo '<div class="col-xs-12" id="descripcionContenido">';
                            echo '<p>' . $informacionAnimal . '</p>';
                            echo '</div>';

                            /*********************************
                                   CAROUSEL DE IMAGENES
                            *********************************/

                            $stmt = verFotosAnimales($idAnimal);
                            $stmt->execute();

                            $contador = $stmt->rowCount();

                            if ($contador > 0){
                            ?>

                            <!-- CONTENEDOR CAROUSEL DE IMAGENES -->
                            <div class="col-xs-12">

                                <div id="carousel-1" class="carousel slide" data-ride="carousel">

                                    <!-- Contenedor de los slides -->
                                    <div class="carousel-inner" role="listbox">

                                    <?php
                                        $primeraImagen = TRUE;

                                        while($row = $stmt->fetch()){
                                            $urlImage = "http://localhost/img/" . $row['ruta_imagen'];

                                            if ($primeraImagen){
                                                echo '<div class="item active">';
                                                echo '<img src="' . $urlImage . '" alt="" class="img-responsive">';
                                                echo '</div>';
                                                $primeraImagen = FALSE;
                                            }
                                            else{
                                                echo '<div class="item">';
                                                echo '<img src="' . $urlImage . '" alt="" class="img-responsive">';
                                                echo '</div>';
                                            }
                                        } // Fin while
                                    ?>
                                    </div> <!-- Fin contenedor sliders -->

                                    <!-- Controles -->
                                    <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Anterior</span>
                                    </a>

                                    <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>

                                </div>
                            </div> <!-- Fin contenedor carousel imagenes -->

                            <?php
                            // CIERRO EL IF PARA EL CAROUSEL
                            }
                            ?>
                            <!-- Seccion de contactos -->
                            <div class="col-xs-12 fondoSeccion" id="contacto">

                                <!-- BOTON PARA CONTACTAR -->
                                <div class="col-xs-12 col-sm-4 col-md-4" id="contactoAdopcion">
                                    <a href="#contactoModal" data-toggle="modal" id="enlaceModal">
										<span class="glyphicon glyphicon-envelope"></span>
										<span class="glyphicon glyphicon-earphone"></span> Contacto
                                    </a>
                                </div>

                                <!-- ICONOS REDES SOCIALES -->
                                <div class="col-xs-12 col-sm-4 col-md-4" id="contactoSocial">

                                    <a href="http://twitter.com/share?text=Dame%20la%20patita" target="_blank" id="twitter-popup">
                                        <i class="icon-twitter"></i>
                                    </a>

                                    <?php
                                    echo '<a href="http://www.facebook.com/sharer.php?u=http://localhost/damelapatita/paginas/fichaAnimal.php?id=' . $idAnimal . '" target="_blank" id="facebook-popup">'
                                            . '<i class="icon-facebook"></i>'
                                            . '</a>';

                                    echo '<a href="https://plus.google.com/share?url=http://localhost/damelapatita/paginas/fichaAnimal.php?id=' . $idAnimal . '" target="_blank" id="plus-popup">'
                                            . '<i class="icon-google-plus"></i>'
                                            . '</a>';

                                    echo '<a href="whatsapp://send?text=http://localhost/damelapatita/paginas/fichaAnimal.php?id=' . $idAnimal . '" data-action="share/whatsapp/share" id="envioWhatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>';
                                    ?>

                                </div>

                                <!-- BOTON PARA DENUNCIAR -->

                                <div class="col-xs-12 col-sm-4 col-md-4" id="contactoDenunciar">
                                    <a href="#denunciaModal" data-toggle="modal" id="enlaceModal2">
                                        <span class="glyphicon glyphicon-warning-sign"></span> Denunciar
                                    </a>
                                </div>

                            </div> <!-- Fin seccion contactos -->

                            <!-- PANEL MODAL CONTACTO -->

                            <div class="modal face" id="contactoModal">

                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <form action="/damelapatita/llamadasPHP/enviarCorreo.php" class="form-horizontal" method="post">
                                            <!-- Header de la ventana -->
                                            <div class="modal-header">
                                                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Contactar</h4>
                                            </div> <!-- Fin div modal-header -->

                                            <!-- Contenido de la ventana -->
                                            <div class="modal-body">

                                                <?php

                                                    $stmt = verUsuario($usuarioAnimal);
                                                    $stmt->execute();

                                                    $row= $stmt->fetch();
                                                    $mailRecibidor = $row['mail']; // Guardo el mail para el formulario

                                                    echo '<p id="nombreAnunciante">' . $row['nombre'] . '</p>';
                                                    echo '<p id="telefonoAnunciante">';
                                                    echo '<span id="tituloTelefono">Teléfono:</span>';
                                                    echo '<span class="tlfnAnunciante">' . $tlfn1 . '</span>';
                                                    echo '<span class="tlfnAnunciante">' . $tlfn2 . '</span>';
                                                    echo '</p>';
                                                ?>
                                                <span id="tituloEscribirMail" class="col-xs-12">Enviar mail:</span>

                                                <div id="formularioOculto">
                                                    <!-- Nombre del que envia -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Nombre:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" id="nombreSender" name="nombreSender" placeholder="Nombre" required>

                                                        </div>
                                                    </div> <!-- Fin div form-group nombre -->

                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Email:</label>
                                                        <div class="col-md-10">
                                                            <input type="email" class="form-control" id="mailSender" name="mailSender" placeholder="Email" required>
                                                        </div>
                                                    </div> <!-- Fin div form-group email -->

                                                    <!-- Telefono del que envia -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Teléfono (opcional):</label>
                                                        <div class="col-md-10">
                                                            <input type="tel" class="form-control" id="tel" name="telSender" placeholder="Teléfono">
                                                        </div>
                                                    </div> <!-- Fin div form-group telefono -->

                                                    <!-- Mensaje a enviar -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Mensaje:</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="mensajeSender" name="mensajeSender" rows="7"></textarea>
                                                        </div>
                                                    </div> <!-- Fin div form-group Mensaje -->

                                                    <?php
                                                    echo '<textarea class="form-control hidden" id="idAnimalSender" name="idAnimalSender">' . $idAnimal . '</textarea>';
                                                    ?>
                                                    <!-- Footer con los submit -->
                                                    <div class="footerBotones">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCancelar">Cancelar</button>
                                                        <input type="submit" class="btn btn-danger">
                                                    </div>
                                                </div>
                                            </div> <!-- Fin div modal-body -->
                                        </form>
                                    </div> <!-- Fin div modal-content -->

                                </div> <!-- Fin div modal-dialog -->
                            </div> <!-- Fin div modal-->

                            <!-- PANEL MODAL PARA DENUNCIAR -->
                            <div class="modal face" id="denunciaModal">

                                <div class="modal-dialog">

                                    <div class="modal-content">
                                        <form action="/damelapatita/llamadasPHP/enviarDenuncia.php" class="form-horizontal" method="post">
                                            <!-- Header de la ventana -->
                                            <div class="modal-header">
                                                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                <h4 class="modal-title">Denunciar publicación</h4>
                                            </div> <!-- Fin div modal-header -->

                                            <!-- Contenido de la ventana -->
                                            <div class="modal-body">

                                                <div id="formularioOculto">
                                                    <!-- Nombre del que envia -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Nombre:</label>
                                                        <div class="col-md-10">
                                                            <input type="text" class="form-control" id="nombreDenunciante" name="nombreDenunciante" placeholder="Nombre" required>

                                                        </div>
                                                    </div> <!-- Fin div form-group nombre -->

                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Email:</label>
                                                        <div class="col-md-10">
                                                            <input type="email" class="form-control" id="mailDenunciante" name="mailDenunciante" placeholder="Email" required>
                                                        </div>
                                                    </div> <!-- Fin div form-group email -->

                                                    <!-- Mensaje a enviar -->
                                                    <div class="form-group">
                                                        <label class="control-label col-md-2">Mensaje:</label>
                                                        <div class="col-md-10">
                                                            <textarea class="form-control" id="mensajeDenunciante" name="mensajeDenunciante" rows="7"></textarea>
                                                        </div>
                                                    </div> <!-- Fin div form-group Mensaje -->

                                                    <?php
                                                    echo '<textarea class="form-control hidden" id="idAnimalDenunciante" name="idAnimalDenunciante">' . $idAnimal . '</textarea>';
                                                    ?>
                                                    <!-- Footer con los submit -->
                                                    <div class="footerBotones">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <input type="submit" class="btn btn-danger">
                                                    </div>
                                                </div>
                                            </div> <!-- Fin div modal-body -->
                                        </form>
                                    </div> <!-- Fin div modal-content -->

                                </div> <!-- Fin div modal-dialog -->
                            </div>
                            <!-- FIN PANEL MODAL PARA DENUNCIAR -->

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
