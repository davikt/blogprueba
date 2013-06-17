/**
 * ==========================================================================
 * Acciones que se ejecutarán cuando la página se haya renderizado
 * ==========================================================================
 */

/**
 * Llama a la función de desactivar post de PHP para desactivarlo.
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
    
    /**
     * =======================================================================
     * Botón de Cargar Más. Pregunta a la función de PHP mediante AJAX y 
     * carga los resultados. Cuando no hay más resultados muestra un men-
     * saje de "No hay mas Posts".
     * =======================================================================
     */
    $('#cargarMas').click(function() {
        var actual=$('.post').length;
        
        $(this).html('<img src="/img/loading.gif" height="30" alt="cargando" />')
        
        $.ajax({
            dataType: "html",
            url: "/posts/cargarHtmlPosts/"+actual+"/5",
            type: "post"
        }).done(function(e) {
            var resp = $.trim(e);
            $('#losPosts').append(resp);
            $("#cargarMas").html('Cargar Más Posts');
            
            if(resp=="") {
                $('#cargarMas').html('No hay mas Posts').unbind('click');
            }
        }).fail(function() {
            console.log("fail(cargar-mas)");
        });
    });
    
});
