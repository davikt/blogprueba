
/**
 * ==========================================================================
 * Función que valida y cambia si es pertinente la contraseña del usuario
 * conduciendo la información del DOM a la función de PHP /user/cambiarPassword
 * 
 * Para que la contraseña del usuario no viajara por la red en texto plano,
 * se ha añadido un plugin de JQuery, que nos permite hacer de lado del cli-
 * ente el hasheo SHA1 del string que introduzca el usuario y así enviar, di-
 * rectamente la contraseña cifrada.
 * 
 * Devuelve si el cambio ha sido correcto.
 * ==========================================================================
 */

function passwordForm() {
    var oldPass = $('#oldPassword');
    var newPass = $('#newPassword');
    var repeatPass = $('#repeatPassword');
    
    if((newPass.val()!=repeatPass.val())||newPass.val()==""||repeatPass.val()=="") {
        
        $('#mensaje').addClass('error');
        $('#mensaje').text('No puedes dejar las contraseñas vacías o no coinciden.');
        repeatPass.val(''); newPass.val('').focus();
        
    } else {
    
        $.ajax({
            dataType: "text",
            url: "/user/cambiarPassword",
            type: "post",
            data: "oldPassword="+$.sha1(oldPass.val())+"&newPassword="+$.sha1(newPass.val())
        }).done(function(e) {
            var resp = $.trim(e);
            console.log(resp);
            if(resp=="password-incorrect") {
                $('#mensaje').addClass('error');
                $('#mensaje').text('Su contraseña actual no es correcta. Revísela.');
                oldPass.val('').focus();
            } else if(resp="password-changed") {
                $('#passwordPage div[data-role=content]').children().remove();
                $('#passwordPage div[data-role=content]').html('<p style="text-align:center">Su contraseña ha sido cambiada correctamente.</p>');
            } else {
                $('#mensaje').addClass('error');
                $('#mensaje').text('Ha habido algún error. Pruebe de nuevo.');
            }
        }).fail(function() {
            console.log("fail(password-form)");
        });
    }    
}

