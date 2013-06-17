/**
 * Cargamos los CSS de JQuery DataTables
 */
$('head').append('<!-- Stylesheet para DataTables -->');
$('head').append('<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css" type="text/css" />')
$('head').append('<link rel="stylesheet" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables_themeroller.css" type="text/css" />');


/**
 * Función que recibe un fieldcontainer de JQuery, lo evalúa y activa
 * o desactiva el post indicado.
 */
function evalField(container) {
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
            console.log("fail(edit-post)");
        });
    }
}


var slideElement;
function setUpSliders() {
    
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
            evalField(slideElement);
            slideElement="";
        }
    });
}


$(document).ready(function() {
    
    $('#losPosts').dataTable();
    
    setUpSliders();
    
    $('div.dataTables_paginate').each(function(index,element) {
        $(element).bind('click',function() {
            setUpSliders();
        });
    });
    
    $('select[name=losPosts_length]').bind('change',function() {
        setUpSliders();
    });
    
});


