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
                <h2>Añada un Post</h2>
            </div>
            <div data-role="content">
                <p id="mensaje">Escriba algo ingenioso... :)</p>
                <form action="javascript: sendPost();" method="post" id="datosPost">
                    <textarea name="textoPost" id="textoPost"></textarea>
                    <p>Le quedan <span style="color:red" id="caracteres">600</span> caracteres.</p>
                    <input type="submit" value="Publicar" data-mini="true" data-theme="a">
                </form>
                <script src="/js/addpost_form.js"></script>
            </div>
        </div>
    </body>
</html>