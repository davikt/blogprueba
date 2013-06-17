/**
 * ==========================================================================
 * Acciones que se ejecutarán cuando la página se haya renderizado
 * ==========================================================================
 */

/**
 * Intento de hacer que alguien inicie sesión desde /login. Lo conseguí,
 * pero al iniciar sesión no había forma de redirigirlo al raíz y se
 * quedaba en una página en blanco... muy feo... Así que lo quité.
 * 
 * Se puede volver a revisar.
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
