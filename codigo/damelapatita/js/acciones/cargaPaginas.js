$(document).ready(function() {
    
    /**
     * Cargo la sección de registro
     * en div #barrica
     */
    $("#btnRegistro").click(function(){
        
        // Uso post porque function load = deprecated
        $.post("/damelapatita/secciones/registro.php", function(htmlexterno){
            $("#barrica").html(htmlexterno);
        });
    });
    
});