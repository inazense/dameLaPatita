jQuery(document).ready(function () {

    // Si el campo de password viejo está relleno significa que queremos cambiarlo.
    // Si el campo de nueva contraseña está vacío, el botón Enviar se deshabilita
    jQuery("#passwordViejo").focusout(function () {
        if (jQuery("#passwordViejo").val().length > 0 && jQuery("#passwordNuevo1").val().length === 0){
            jQuery("#btnEnviar").attr("disabled", true);
        }
        else{
            jQuery("#btnEnviar").attr("disabled", false);
        }
    });
    
    // Compruebo si las nuevas contraseñas coinciden
    // Si no es así, deshabilito el botón de enviar
    jQuery("#passwordNuevo1").focusout(function () {
        if (jQuery("#passwordNuevo1").val() === jQuery("#passwordNuevo2").val()) {
            if (jQuery("#passwordViejo").val().length > 0){
                jQuery("#btnEnviar").attr("disabled", false);
            }
            else{
                jQuery("#btnEnviar").attr("disabled", true);
            }
        } else {
            jQuery("#btnEnviar").attr("disabled", true);
        }
    });
    
    jQuery("#passwordNuevo2").focusout(function () {
        if (jQuery("#passwordNuevo1").val() === jQuery("#passwordNuevo2").val()) {
            if (jQuery("#passwordViejo").val().length > 0){
                jQuery("#btnEnviar").attr("disabled", false);
            }
            else{
                jQuery("#btnEnviar").attr("disabled", true);
            }
        } else {
            jQuery("#btnEnviar").attr("disabled", true);
        }
    });
    
});