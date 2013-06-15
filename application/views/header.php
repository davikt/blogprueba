<title><?=$titulo?> | MicroBlog D4P3R</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$this->config->item('charset')?>">
<meta name = "viewport" content = "width=device-width, maximum-scale = 1, minimum-scale=1" />

<!-- Importar Normalize.css -->
<link href="/css/normalize.css" rel="stylesheet" type="text/css">

<!-- JQuery Mobile CSS -->
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />

<!-- Css de la Página definido por el controlador -->
<?php
    if(!isset($css)) {$css=array();}
        foreach($css as $file) {
            echo "<link rel=\"stylesheet\" href=\"/css/".$file."\" />";
        }
?>

<!-- JQuery y JQuery Mobile JS (CDN-hosted files) -->
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

<!-- JQuery SHA1 plugin (para las contraseñas, así no se envían por red) -->
<script src="/js/jquery.sha1.js"></script>

<!-- Cargar scripts desde los controladores -->
<?php 
    if(!isset($scripts)) {$scripts=array();}
    foreach($scripts as $script) {
        echo "<script src = '/js/".$script."'></script>";
    }
?>