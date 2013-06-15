
/**
 * ==========================================================================
 * Función que toma los datos de login y los comprueba.
 * 
 * Tiene tres posibles salidas:
 *      - Que la petición ajax no llegue, por lo que sea.
 *      - Que devuelva "denegado", con lo que se altera el aspecto, se borran
 *          los inputs, y se hace focus en el email.
 *      - Que devuelva "permitido", se cierra el diálogo.
 * ==========================================================================
 */
function compruebaLogin() {
    var email = $('#email');
    var pass = $('#pass');
    
    $.ajax({
        dataType: "text",
        url: "/login/doLogin",
        type: "post",
        data: "email="+email.val()+"&pass="+$.sha1(pass.val())
    }).done(function(e) {
        var resp = $.trim(e);
        if(resp=="no-autorizado") {
            email.val('');
            pass.val('');
            $('#mensaje').addClass('error');
            $('#mensaje').text('Datos erróneos, pruebe de nuevo');
            email.focus();
        } else if (resp=="autorizado") {
            window.location.href="/";
        }
    }).fail(function() {
        console.log("fail(comprueba-login)");
    });

}

function hazRegistro() {
    var email = $('#email');
    
    $.ajax({
        dataType: "text",
        url: "/user/guardarRegistro",
        type: "post",
        data: "email="+email.val()
    }).done(function(e) {
        var resp = $.trim(e);
        //console.log(resp);
        if (resp=="usuario-registrado") {
            $('#loginPage div[data-role=content]').children('*').remove();
            $('#loginPage div[data-role=content]').append('\
                <p>El registro ha sido satisfactorio, se le ha enviado una\n\
                contraseña a su dirección de correo. Compruébelo y vuelva para\n\
                iniciar sesión. </p>\n\
                <p style="text-align:center;font-weight:bold">\n\
                Gracias por registrarse.</p>\n\
            ');
        } else if (resp=="usuario-ya-registrado") {
            $('#mensaje').addClass('error');
            $('#mensaje').text(email.val()+' ya ha sido registrado. Pruebe con otro.');
            email.val('').focus();
        } else {
            $('#mensaje').addClass('error');
            $('#mensaje').text('Ha ocurrido un error, pruebe de nuevo.');
        }
    }).fail(function() {
        console.log("fail(haz-registro)");
    });
}

/**
 * =========================================================================
 * Función que decidirá si se hará un registro o se iniciará sesión.
 * 
 * Para ello navega por el DOM para seleccionar el radioButton que se
 * encuentre marcado e inspecciona su valor.
 * =========================================================================
 */

function loginForm() {
    /* Se mapean los campos del formulario y define el regex para el email */
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var radio = $('#eligeOpcion label[data-icon=radio-on]').prev('input').val();
    var email = $('#email');
    var pass = $('#pass');
    
    $('#mensaje').html('<img src="/img/loading.gif" width="50"></img>').css('text-align','center')
    
    
    /* Se hacen todas las comprobaciones necesarias con el campo email */
    if (email.val()=="") {
        $('#mensaje').addClass('error');
        $('#mensaje').text('El email no puede estar vacío.');
    } else if(!regex.test(email.val())) {
        $('#mensaje').addClass('error');
        $('#mensaje').text('El email no es válido.');
    } else {
        
        /* Se comprueba el valor del radioButton y se decide si es login o registro */
        if (radio=="inicia_sesion") {
            
            /* Si existe el input de contraseña, se comprueba que no esté vacío */
            if (pass.val()=="") {
                $('#mensaje').addClass('error');
                $('#mensaje').text('La contraseña no puede estar vacía.');
            } else {
                
                /* Si no está vacío se ejecuta el login */
                compruebaLogin();
            }
        } else if (radio=="registrate") {
            hazRegistro();
        }
    }
}



/**
 * ==========================================================================
 * Acciones que se ejecutarán cuando la página se haya renderizado
 * ==========================================================================
 */

$(document).ready(function() {
    
    /**
     * ======================================================================
     * Las dos acciones siguientes sirven para que al hacer click en los 
     * radioButtons de "Inicia Sesión" y "Regístrate" cambie la apariencia
     * del formulario.
     * ======================================================================
     */
    
    $('label[for=inicia_sesion]').click(function() {
        $('h2[class=ui-title][role=heading]').text('Inicia Sesión');
        $('label[for=pass]').next().css('display','inline-block');
        $('label[for=pass]').css('display','inline-block');
        $('#datosLogin .ui-submit .ui-btn-text').text('Entrar');
    });
    
    $('label[for=registrate]').click(function() {
        $('h2[class=ui-title][role=heading]').text('Regístrate');
        $('label[for=pass]').next().css('display','none');
        $('label[for=pass]').css('display','none');
        $('#datosLogin .ui-submit .ui-btn-text').text('Registrarme');
    });
    
});

