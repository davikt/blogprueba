<div class="post" data-id="<?=$elPost->getId()?>">
    <?php if($elPost->getAutor()==$this->session->userdata('usuario')) { ?>
        <div class="botonEliminar">
            <img src="/img/delete.png" alt="eliminar" />
        </div>
    <?php } ?>
    <div class="postTexto">
        <div class="postInfo">
            <div class="dia"><?=$elPost->getDia()?></div>
            <div class="mes"><?=$elPost->getMes()?></div>
            <?php if($elPost->getAutor()==$this->session->userdata('usuario')) { ?>
                <div class="botonEditar">
                    <a href="/posts/editForm/<?=$elPost->getId()?>" data-rel="dialog">
                        <img src="/img/pencil.png" alt="lapicero" />
                    </a>
                </div>
            <?php } ?>
        </div>
        <?=$elPost->getTexto()?>
    </div>
</div>
<div class="dispositivo">
    Escrito por: <?=$elPost->getAutor()?> desde su <?=$elPost->getDispositivo()?>
</div>