<?php if($elPost->getAutor()==$this->session->userdata('usuario')) { ?>
        <div class="botonEliminar" onclick="eliminarPost(this)">
            <img src="/img/delete.png" alt="eliminar" />
        </div>
    <?php } ?>
<table class="post" data-id="<?=$elPost->getId()?>">
    <tr >
        <td class="postInfo">
            <span class="dia"><?=$elPost->getDia()?></span><br>
            <span class="mes"><?=$elPost->getMes()?></span>
            <?php if($elPost->getAutor()==$this->session->userdata('usuario')) { ?>
                <br><br><br><span class="botonEditar">
                    <a href="/posts/editForm/<?=$elPost->getId()?>" data-rel="dialog">
                        <img src="/img/pencil.png" alt="lapicero" />
                    </a>
                </span>
            <?php } ?>
        </td>
        <td class="postTexto">
            <?=$elPost->getTexto()?>
        </td>
    </tr>
</table>
<div class="dispositivo">
    Escrito por: <?=$elPost->getAutor()?> desde su <?=$elPost->getDispositivo()?>
</div>