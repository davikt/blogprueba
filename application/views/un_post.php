<div class="post">
    <div class="postInfo">
        <div class="dia"><?=$elPost->getDia()?></div>
        <div class="mes"><?=$elPost->getMes()?></div>
        <div class="botonEditar">Editar</div>
    </div>
    <div class="postTexto">
        <div class="mensaje"><?=$elPost->getTexto()?></div>
        <div class="dispositivo">Escrito desde: <?=$elPost->getDispositivo()?></div>
    </div>
</div>