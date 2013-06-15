<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>
    </head>
    <body>
        <div data-role="page" id="loginPage">
            <div data-role="header">
                <h2>Inicia Sesión</h2>
            </div>
            <div data-role="content">
                <p id="mensaje">Ingresa el email para registrarte o introduce también tu contraseña para iniciar sesión</p>
                <form action="javascript: loginForm();" method="post" id="datosLogin">
                    <fieldset data-role="controlgroup" data-type="horizontal" id="eligeOpcion">
                        <input type="radio" 
                               name="eligeOpcion" 
                               id="inicia_sesion" 
                               value="inicia_sesion" 
                               checked="" 
                               >
                        <label for="inicia_sesion">Inicia Sesión</label>
                        <input type="radio" 
                               name="eligeOpcion" 
                               id="registrate" 
                               value="registrate" 
                               >
                        <label for="registrate">Regístrate</label>
                    </fieldset>
                    <fieldset data-role="fieldcontain">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" value="">
                        <br /><br />
                        <label for="pass">Contraseña: </label>
                        <input type="password" name="pass" id="pass" value="" autocomplete="off">
                        <input type="submit" value="Entrar" data-mini="true" data-theme="a">
                    </fieldset>
                </form>
                <script src="/js/login_form.js"></script>
            </div>
        </div>
    </body>
</html>

