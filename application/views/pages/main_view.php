<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>
    </head>
    <body>
        <div data-role="page" id="main">
            <div id="cuerpo">
                <div id="losPosts">
                    <?php 
                        foreach($posts as $post) {
                            $setUpPosts = array(
                                'elPost' => $post
                            );
                            $this->load->view('un_post', $setUpPosts);
                        }
                    ?>
                </div>
                <?php if($this->session->userdata('autorizacion')=="autorizado") { ?>
                    <div id="botonAdd">
                        <a href="/post/addForm" data-rel="dialog">
                            <img src="/img/plus.png" alt="llave"/>
                        </a>
                    </div>
                    <div id="botonLogin">
                        <a href="/login/doLogout">
                            <img src="/img/logout.png" alt="llave"/>
                        </a>
                    </div>
                    <div id="botonHerramientas">
                        <a href="/user/editForm" data-rel="dialog">
                            <img src="/img/gear.png" alt="llave"/>
                        </a>
                    </div>
                <?php } else { ?>
                    <div id="botonLogin">
                        <a href="/login/loginForm" data-rel="dialog">
                            <img src="/img/key.png" alt="llave"/>
                        </a>
                    </div>
                <?php } ?>
            </div>
            <div id="alerts"><?php if(!isset($alert)) {$alert=null;} else {echo $alert;} ?></div>
        </div>
    </body>
</html>