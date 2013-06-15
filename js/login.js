/**
 * ==========================================================================
 * Acciones que se ejecutarán cuando la página se haya renderizado
 * ==========================================================================
 */

$(document).ready(function() {
    
    $.mobile.changePage('/login/loginForm', {transition: 'pop', role: 'dialog'});
    
    // NOTA PSEUDO-MENTAL
    // :( Esto aquí no pinta nada... la página aún no ha sido cargada.
    $('#loginPage').bind('pagehide',function() {
        window.location.href="/";
        console.log('al inicio');
    });
    
});
