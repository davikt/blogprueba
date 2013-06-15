
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
            window.location.href="/";
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
    
    $('#caracteres').text(900-$('#textoPost').val().length);
    $('#textoPost').on('keyup', function() {
        var caract=900-$('#textoPost').val().length;
        $('#caracteres').text(caract);
    });
    
});


