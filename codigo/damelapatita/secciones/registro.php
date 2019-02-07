<?php
    error_reporting(E_ALL- E_NOTICE - E_DEPRECATED);
    include("../lib/provincias.php");
?>

<script src="/damelapatita/js/acciones/registro.js"></script>
<script src="/damelapatita/js/acciones/validaciones.js"></script>
<script src="/damelapatita/js/prototype.js"></script>
<form action="/damelapatita/llamadasPHP/registrarUsuario.php" method="post" class="form-horizontal">

    <!-- Form-group nombre -->
    <div class="form-group">

        <label for="nombreUsuario" class="control-label col-md-2">Nombre:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" placeholder="Nombre" required>
        </div>

        <label for="apellidosUsuario" class="control-label col-md-2">Apellido:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="apellidosUsuario" id="apellidosUsuario" placeholder="Apellido" required>
        </div>

    </div> <!-- Fin form-group nombre -->

    <!-- Form-group mail -->
    <div class="form-group">

        <label for="mailUsuario" class="control-label col-xs-12 col-md-2">Email:</label>
        <div class="col-xs-10 col-md-8">
            <input type="email" onblur="validarusuario(this)" class="form-control" name="mailUsuario" id="mailUsuario" placeholder="Email" required>
        </div>
        <div id="comprobarusuario" class="col-xs-2 col-md-2"></div>

    </div> <!-- Fin form-group mail -->

    <!-- Form-group Password -->
    <div class="form-group">

        <label for="password1Usuario" class="control-label col-md-2">Contraseña:</label>
        <div class="col-md-10">
            <input type="password" class="form-control" name="passwordUsuario" id="password1Usuario" placeholder="Contraseña" required>
        </div>

    </div> <!-- Fin form-group password -->

    <!-- Form-group Validar password -->
    <div class="form-group">

        <label for="password2Usuario" class="control-label col-md-2">Repite:</label>
        <div class="col-md-10">
            <input type="password" class="form-control" name="password2Usuario" id="password2Usuario" placeholder="Repite la contraseña" required>
        </div>

    </div> <!-- Fin form-group Validar password -->

    <!-- Form-group fecha nacimiento -->
    <div class="form-group">

        <label for="nacimientoUsuario" class="control-label col-md-2">Nacimiento:</label>
        <div class="col-md-10">
            <input type="date" class="form-control" name="nacimientoUsuario" id="nacimientoUsuario" required>
        </div>

    </div> <!-- Fin form-group fecha nacimiento -->

    <!-- Form-group vivienda -->
    <div class="form-group">

        <label for="localidadUsuario" class="control-label col-md-2">Localidad:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="localidadUsuario" id="localidadUsuario" placeholder="Localidad" required>
        </div>

        <label class="control-label col-md-2">Provincia:</label>
        <div class="col-md-4">
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
    </div> <!-- Fin form-group vivienda -->

    <!-- Form-group Genero -->
    <div class="form-group">

        <label class="control-label col-md-2">Género:</label>
        <div class="col-md-10">
            <select name="sexo" id="sexo" class="form-control" required>
                <option value="" disabled selected>Elige tu sexo</option>
                <option value="Hombre">Hombre</option>
                <option value="Mujer">Mujer</option>
                <option value="Otro">Otro</option>
            </select>
        </div>

    </div> <!-- Fin form-group genero -->

    <div class="form-group">
        <div class="col-md-12 diestra">
            <label class="checkbox col-md-12">
                <input type="checkbox" name="" id="checkTerminos" class="pull-right">Acepto los <a href="#registroModal" data-toggle="modal">términos y condiciones de uso</a>
            </label>
        </div>

    </div>

    <div class="form-group">

        <div class="col-md-12 diestra">
            <input type="button" id="btnLimpia" class="btn btn-default" value="Limpiar campos">
            <input type="submit" id="btnEnviar" name="submit" class="btn btn-danger">
        </div>
    </div> <!-- Fin form-group genero -->

</form> <!-- Fin formulario -->

<!-- VENTANA MODAL PARA LOS TERMINOS Y CONDICIONES -->
<div class="modal face" id="registroModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- Header de la ventana -->
            <div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Términos y condiciones de uso</h4>
            </div> <!-- Fin div modal-header -->

            <!-- Contenido de la ventana -->
            <div class="modal-body">
                 <div class="form-group">
                     <label for="comment">Términos y condiciones de uso:</label>
                     <textarea class="form-control" rows="5" id="comment" readonly="readonly"></textarea>
                 </div>

            </div> <!-- Fin contenido de la ventana -->

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div> <!-- Fin del footer -->
        </div> <!-- Fin modal-content -->

    </div> <!-- Fin modal-dialog -->

</div>
