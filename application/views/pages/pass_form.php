<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>
    </head>
    <body>
        <div data-role="page" id="passwordPage">
            <div data-role="header">
                <h2>Cambiar la Contraseña</h2>
            </div>
            <div data-role="content">
                <p id="mensaje">Formulario para cambiar la contraseña, rellena los campos y pulsa en "Cambiar".</p>
                <form action="javascript: passwordForm();" method="post" id="datosPass">
                    <fieldset data-role="fieldcontain">
                        <label for="oldPassword">Antigua Contraseña: </label>
                        <input type="password" name="oldPassword" id="oldPassword" value="">
                        <br /><br />
                        <label for="newPassword">Nueva Contraseña: </label>
                        <input type="password" name="newPassword" id="newPassword" value="" autocomplete="off">
                        <br /><br />
                        <label for="repeatPassword">Repita Contraseña: </label>
                        <input type="password" name="repeatPassword" id="repeatPassword" value="" autocomplete="off">
                        <input type="submit" value="Cambiar" data-mini="true" data-theme="a">
                    </fieldset>
                </form>
                <script src="/js/pass_form.js"></script>
            </div>
        </div>
    </body>
</html>