/**
 * =======================================================================
 * Utilizada en el formulario para añadir posts, recoge la información del
 * nuevo post del DOM y la envía por ajax a la función correspondiente
 * para que la guarde en BD
 * 
 * @returns "guardado" || Error de PHP || "fail" (error de ajax)
 * =======================================================================
 */
function sendPost() {
    var textarea=$('#textoPost');
    
    $.ajax({
        dataType: "text",
        url: "/posts/savePost",
        type: "post",
        data: "textoPost="+encodeURI(textarea.val())
    }).done(function(e) {
        var resp = $.trim(e);
        if (resp=="guardado") {
            window.location.href="/";
        } else {
            $('#mensaje').addClass('error');
            $('#mensaje').text(resp);
            textarea.focus();
        }
    }).fail(function() {
        console.log("fail");
    });
    
}

$(document).ready(function() {
    
    //$('#textoPost').jqte();
    /**
     * Crea el contador de caracteres en los editores.
     */
    $('#caracteres').text(900-$('#textoPost').val().length);
    $('#textoPost').on('keyup', function() {
        var caract=900-$('#textoPost').val().length;
        $('#caracteres').text(caract);
    });
    
});
