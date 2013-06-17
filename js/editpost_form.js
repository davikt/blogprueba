/**
 * =========================================================================
 * Función que recoge la información modificada de un Post del DOM y la
 * transfiere a la función que la guardará en la BD. Durante el proceso
 * muestra un gif loader.
 * 
 * @return Devuelve el flujo a la página de inicio o a la de administración.
 * @return Devuelve el error de PHP o el error de AJAX.
 * =========================================================================
 */
function editPost() {
    var mensaje = $('#textoPost').val();
    var id = $('#textoPost').attr('data-id');
    
    $('#mensaje').html('<img src="/img/loading.gif" width="50"></img>').css('text-align','center')
    
    $.ajax({
        dataType: "text",
        url: "/posts/editPost/"+id,
        type: "post",
        data: "textoPost="+encodeURI(mensaje)
    }).done(function(e) {
        var resp = $.trim(e);
        if (resp=="guardado") {
            if(/managePosts/.test(window.location.href)) {
                window.location.href="/admin/managePosts";
            } else {
                window.location.href="/";
            }
        } else {
            $('#mensaje').addClass('error');
            $('#mensaje').text(resp);
            $('#textoPost').focus();
        }
    }).fail(function() {
        console.log("fail(edit-post)");
    });
}

$(document).ready(function() {
    /**
     * Contador de Caracteres. :D
     */
    $('#caracteres').text(900-$('#textoPost').val().length);
    $('#textoPost').on('keyup', function() {
        var caract=900-$('#textoPost').val().length;
        $('#caracteres').text(caract);
    });
    
});


