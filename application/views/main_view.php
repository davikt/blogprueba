<!DOCTYPE html>
<html>
    <head>
        <title><?=$titulo?> | MicroBlog D4P3R</title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?=$this->config->item('charset')?>">
        
        <!-- Importar Normalize.css -->
        <link href="normalize.css" rel="stylesheet" type="text/css">
        
        <!-- JQuery Mobile CSS -->
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
        
        <!-- Css de la Página definido por el controlador -->
        <link href="css/<?=$css?>" rel="stylesheet" type="text/css">
        
        <!-- JQuery y JQuery Mobile JS (CDN-hosted files) -->
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>
        
    </head>
    <body>
        <div><?=$device?></div>
    </body>
</html>