<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>
    </head>
    <body>
        <div data-role="page" id="addPostPage">            
            <div data-role="header">
                <h2>Edite su Post</h2>
            </div>
            <div data-role="content">
                <p id="mensaje">¿Escribió algo mal? Edite su post.</p>
                <form action="javascript: editPost();" method="post" id="datosPost">
                    <textarea name="textoPost" id="textoPost" data-id="<?=$id?>"><?=$mensaje?></textarea>
                    <p>Le quedan <span style="color:red" id="caracteres">600</span> caracteres</p>
                    <input type="submit" value="Guardar" data-mini="true" data-theme="a">
                </form>
                <script src="/js/editpost_form.js"></script>
            </div>
        </div>
    </body>
</html>