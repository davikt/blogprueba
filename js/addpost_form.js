

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
    $('#caracteres').text(900-$('#textoPost').val().length);
    $('#textoPost').on('keyup', function() {
        var caract=900-$('#textoPost').val().length;
        $('#caracteres').text(caract);
    });
    
});
