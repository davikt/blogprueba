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
                <div id="cargarMas">Cargar Más Posts</div>
                <?php if($this->session->userdata('autorizacion')=="autorizado") { ?>
                    <div id="botonAdd">
                        <a href="/posts/addForm" data-rel="dialog">
                            <img src="/img/plus.png" alt="signo mas"/>
                        </a>
                    </div>
                    <div id="botonLogin">
                        <a href="/login/doLogout">
                            <img src="/img/logout.png" alt="puerta"/>
                        </a>
                    </div>
                    <div id="botonHerramientas">
                        <a href="/user/editForm" data-rel="dialog">
                            <img src="/img/lock.png" alt="candado"/>
                        </a>
                    </div>
                    <?php if($this->session->userdata('administrador')=='autorizado') { ?>
                        <div id="botonCensura">
                            <a href="/admin/managePosts" rel="external">
                                <img src="/img/gear.png" alt="candado" />
                            </a>
                        </div>
                        <div id="botonUsuarios">
                            <a href="/admin/manageUsers" rel="external">
                                <img src="/img/group.png" alt="usuarios" />
                            </a>
                        </div>
                    <?php } ?>
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