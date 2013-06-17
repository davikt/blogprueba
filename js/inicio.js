/**
 * ==========================================================================
 * Acciones que se ejecutarán cuando la página se haya renderizado
 * ==========================================================================
 */

function eliminarPost(element) {
    var id=$(element).next().attr('data-id');
    //$(element).find('img').attr('src','/img/loading.gif').attr('width','25');

    $.ajax({
        dataType: "html",
        url: "/posts/eliminarPost/"+id,
        type: "post"
    }).done(function(e) {
        var resp = $.trim(e);

        if(resp=="borrado-correcto") {
            $(element).next().next().remove();
            $(element).next().remove();
            $(element).remove();
            //$('.post[data-id='+id+']').remove();
        } else {
            $(element).children('span').remove();
            $(element).find('img').attr('src','/img/delete.gif');
            $(element).append('<span style="margin-top:-3px">Error al borrar.</span>')
            setTimeout(function() {$(element).children('span').remove();},1000);
        }
    }).fail(function() {
        console.log("fail(cargar-mas)");
    });
}



$(document).ready(function() {
    
    $('#cargarMas').click(function() {
        var actual=$('.post').length;
        
        $(this).html('<img src="/img/loading.gif" height="30" alt="cargando" />')
        
        $.ajax({
            dataType: "html",
            url: "/posts/cargarHtmlPosts/"+actual+"/5",
            type: "post"
        }).done(function(e) {
            var resp = $.trim(e);
            
//            $(resp).children('#botonEliminar').each(function(index,element) {
//                eliminarPost(element);
//            });
            
            $('#losPosts').append(resp);
            $("#cargarMas").html('Cargar Más Posts');
            
            if(resp=="") {
                $('#cargarMas').html('No hay mas Posts').unbind('click');
            }
        }).fail(function() {
            console.log("fail(cargar-mas)");
        });
    });

    
//    $('.botonEliminar').each(function(index, element) {
//        $(element).click(function() {
//            var id=$(this).next().attr('data-id');
//            $(element).find('img').attr('src','/img/loading.gif').attr('width','25');
//            
//            $.ajax({
//                dataType: "html",
//                url: "/posts/eliminarPost/"+id,
//                type: "post"
//            }).done(function(e) {
//                var resp = $.trim(e);
//
//                if(resp=="borrado-correcto") {
//                    $(element).next().next().remove();
//                    $(element).next().remove();
//                    $(element).remove();
//                    //$('.post[data-id='+id+']').remove();
//                } else {
//                    $(element).children('span').remove();
//                    $(element).find('img').attr('src','/img/delete.gif');
//                    $(element).append('<span style="margin-top:-3px">Error al borrar.</span>')
//                    setTimeout(function() {$(element).children('span').remove();},1000);
//                }
//            }).fail(function() {
//                console.log("fail(cargar-mas)");
//            });
//        });
//    });
    
});
