/**
 * Hacer llamada AJAX para validar el usuario
 * @param {string} mailUsuario
 */
function validarusuario(mailUsuario){
    var url = '/damelapatita/llamadasPHP/validarusuario.php';
    var parametro = 'mailUsuario='+mailUsuario.value;
    var ajax = new Ajax.Updater('comprobarusuario', url, {method: 'post', parameters: parametro});
}
