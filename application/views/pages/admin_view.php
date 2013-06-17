<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>
    </head>
    <body>
        <div data-role="page" id="admin">
            <div id="cuerpo">
                <div id="home">
                    <a href="/" rel="external">
                        <img src="/img/home-blank.png" alt="casa" />Ir al inicio</a>
                </div>
                <?php if(isset($losPosts)) { ?>
                <div id="tablaPosts">
                    <table id="losPosts">
                        <thead>
                            <tr>
                                <th>Activo</th>
                                <th>Fecha</th>
                                <th>Texto</th>
                                <th>Editar</th>
                                <th>Autor</th>
                                <th>Dispositivo</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php foreach($losPosts as $elPost) { ?>
                            <tr>
                                <td>
                                    <div data-role="fieldcontain" data-id="<?=$elPost->getId()?>">
                                        <select name="active" id="active-switch" data-role="slider">
                                            <option value="0" <?=($elPost->getActive()==='1') ? "selected" : "" ?> />Off</option>
                                            <option value="1" <?=($elPost->getActive()==='1') ? "selected" : "" ?> />On</option>
                                        </select>
                                    </div>
                                </td>
                                <td><?=$elPost->getFecha()?></td>
                                <td><?=$elPost->getTexto()?></td>
                                <td><span class="botonEditar">
                                    <a href="/posts/editForm/<?=$elPost->getId()?>" data-rel="dialog">
                                        <img src="/img/pencil.png" alt="lapicero" />
                                    </a>
                                </span></td>
                                <td><?=$elPost->getAutor()?></td>
                                <td><?=$elPost->getDispositivo()?></td>
                            </tr>
                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                <?php if(isset($losUsuarios)) { ?>
                <div id="tablaUsuarios">
                    <table id="losUsuarios">
                        <thead>
                            <tr>
                                <th>Activo</th>
                                <th>email</th>
                                <th>Reset Password</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php foreach($losUsuarios as $elUsuario) { ?>
                            <tr>
                                <td>
                                    <div data-role="fieldcontain" data-id="<?=$elUsuario["email"]?>">
                                        <select name="active" id="active-switch" data-role="slider">
                                            <option value="0" <?=($elUsuario["active"]==='1') ? "selected" : "" ?> />Off</option>
                                            <option value="1" <?=($elUsuario["active"]==='1') ? "selected" : "" ?> />On</option>
                                        </select>
                                    </div>
                                </td>
                                <td><?=$elUsuario["email"]?></td>
                                <td><input type="button" value="Resetear Contraseña" data-id="<?=$elUsuario["email"]?>" onclick="resetPassword(this)"/></td>
                            </tr>
                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } ?>
                <!-- El menu -->
                <?php if($this->session->userdata('autorizacion')=="autorizado") { ?>
                    <div id="botonAdd">
                        <a href="/posts/addForm" data-rel="dialog">
                            <img src="/img/plus.png" alt="signo mas"/>
                        </a>
                    </div>
                    <div id="botonLogin">
                        <a href="/login/doLogout">
                            <img src="/img/logout.png" alt="salir"/>
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
                                <img src="/img/gear.png" alt="rueda" />
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