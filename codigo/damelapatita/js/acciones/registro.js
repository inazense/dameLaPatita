jQuery.noConflict(); // Evito conflicto con prototype.js

jQuery(document).ready(function() {
    
	/**
	 * Carga los terminos y condiciones de uso dentro del textarea en el modal
	 */
	jQuery("#comment").load("/damelapatita/termsAndUses/terminos.txt");
	
    /**
     * Activar el botón de envío solo cuando
     * se hayan aceptado los términos y condiciones.
     * Por defecto desactivado
     */
    jQuery("#btnEnviar").attr("disabled", true);
    
    jQuery("#checkTerminos").change(function () {
       if(jQuery(this).is(":checked") && jQuery("#comprobante").hasClass("success") && comprobarPassword()){
           jQuery("#btnEnviar").attr("disabled", false);
       }
       else{
           jQuery("#btnEnviar").attr("disabled", true);
       }
    });
    
    /**
     * Limpia todos los campos
     */
    jQuery("#btnLimpia").click(function () {
       jQuery("input[type='text']").val("");
       jQuery("input[type='password']").val("");
       jQuery("input[type='date']").val("");
       jQuery("input[type='email']").val("");
       jQuery("select").val("");
    });
    
    /**
     * Si las contraseñas no coinciden
     */
    function comprobarPassword(){
        var resultado = false;
        if (jQuery("#password1Usuario").val().length > 0 && jQuery("#password2Usuario").val().length > 0){
            if (jQuery("#password1Usuario").val() === jQuery("#password2Usuario").val()){
                resultado = true;
            }
        }
        
        return resultado;
    }
});