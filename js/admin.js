/**
 * Cargamos los CSS de JQuery DataTables
 */
$('head').append('<!-- Stylesheet para DataTables -->');
$('head').append('<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" type="text/css" />')
$('head').append('<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables_themeroller.css" type="text/css" />');


/**
 * =======================================================================
 * Función que recibe un fieldcontainer de JQuery, lo evalúa y activa
 * o desactiva el post indicado.
 * =======================================================================
 */
function evalPostField(container) {
    var elm = $(container);
    var postId=elm.attr('data-id');
    var labelA=$(elm.children('div[role=application].ui-slider').children('.ui-slider-label').get(0));
    var labelB=$(elm.children('div[role=application].ui-slider').children('.ui-slider-label').get(1));
    
    if(labelA.css('width')>labelB.css('width')) {
        $.ajax({
            dataType: "text",
            url: "/posts/switchPost",
            type: "post",
            data: "id="+postId+"&mode="+labelA.text().toLowerCase()
        }).done(function(e) {
            var resp = $.trim(e);
            console.log(resp);
        }).fail(function() {
            console.log("fail(edit-post)");
        });
    } else {
        $.ajax({
            dataType: "text",
            url: "/posts/switchPost",
            type: "post",
            data: "id="+postId+"&mode="+labelB.text().toLowerCase()
        }).done(function(e) {
            var resp = $.trim(e);
            console.log(resp);
        }).fail(function() {
            console.log("fail(toggle-post)");
        });
    }
}

/**
 * =======================================================================
 * Función que recibe un fieldcontainer de JQuery, lo evalúa y activa
 * o desactiva el usuario indicado.
 * =======================================================================
 */
function evalUserField(container) {
    var elm = $(container);
    var postId=elm.attr('data-id');
    var labelA=$(elm.children('div[role=application].ui-slider').children('.ui-slider-label').get(0));
    var labelB=$(elm.children('div[role=application].ui-slider').children('.ui-slider-label').get(1));
    
    if(labelA.css('width')>labelB.css('width')) {
        $.ajax({
            dataType: "text",
            url: "/user/toggleUser",
            type: "post",
            data: "usuario="+postId+"&active="+labelA.text().toLowerCase()
        }).done(function(e) {
            var resp = $.trim(e);
            console.log(resp);
        }).fail(function() {
            console.log("fail(edit-post)");
        });
    } else {
        $.ajax({
            dataType: "text",
            url: "/user/toggleUser",
            type: "post",
            data: "usuario="+postId+"&active="+labelB.text().toLowerCase()
        }).done(function(e) {
            var resp = $.trim(e);
            console.log(resp);
        }).fail(function() {
            console.log("fail(toggle-user)");
        });
    }
}

/**
 * Función que la utilizan los botones de la administración de usuario para
 * realizar la función de restaurar contraseña.
 * @param button elm
 * @returns "password-reseteada" || "fail(reset-password)" Error de AJAX
 */
function resetPassword(elm) {
    var email=$(elm).attr('data-id');
    
    $(elm).prev().children().first().html('<img src="/img/loading.gif" alt="cargando" width="20"/>');
    
    $.ajax({
            dataType: "text",
            url: "/user/resetPassword",
            data: "mail="+email,
            type: "post"
        }).done(function(e) {
            var resp = $.trim(e);
            if(resp=="password-reseteada") {
                $(elm).prev().children().first().html('<img src="/img/tick.png" alt="tick"/>Contraseña Reseteada');
            }
        }).fail(function() {
            console.log("fail(reset-password)");
        });
}

/**
 * =========================================================================
 * =========================================================================
 * Una forma un poco enrevesada de añadir los eventos de de activar/desactivar
 * a los sliders y así hacer que ejecuten las funciones de arriba. Realmente,
 * creo que no hay ninguna otra forma. Y me he pegado varias horas con esto...
 *  :)                              :)                                   :)
 * =========================================================================
 * =========================================================================
 */


var slideElement="";

function setUpPostsSliders() {
    
    /**
     * Añado a cada slider su evento para que activen y desactiven el post
     */
    $('div[data-role=fieldcontain][data-id]').each(function(index,element) {
        $(element).bind('mousedown',function() {
            slideElement=element;
        });
    });
    
    $(document).bind('mouseup',function() {
        if (slideElement!="") {
            evalPostField(slideElement);
            slideElement="";
        }
    });
}

function setUpUserSliders() {
    
    /**
     * Añado a cada slider su evento para que activen y desactiven el post
     */
    $('div[data-role=fieldcontain][data-id]').each(function(index,element) {
        $(element).bind('mousedown',function() {
            slideElement=element;
        });
    });
    
    $(document).bind('mouseup',function() {
        if (slideElement!="") {
            evalUserField(slideElement);
            slideElement="";
        }
    });
}


$(document).ready(function() {
    
    if($('#losPosts').length!=0) {
        $('#losPosts').dataTable();

        setUpPostsSliders();
        $('div.dataTables_paginate').each(function(index,element) {
            $(element).bind('click',function() {
                setUpPostsSliders();
            });
        });

        $('select[name=losPosts_length]').bind('change',function() {
            setUpPostsSliders();
        });
    }
    
    if($('#losUsuarios').length!=0) {
        $('#losUsuarios').dataTable();
        
        setUpUserSliders();
        $('div.dataTables_paginate').each(function(index,element) {
            $(element).bind('click',function() {
                setUpUserSliders();
            });
        });

        $('select[name=losUsuarios_length]').bind('change',function() {
            setUpUserSliders();
        });
    }
});


