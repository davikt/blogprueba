<!DOCTYPE html>
<html>
    <head>
        <?php
            $this->load->view('header');
        ?>        
    </head>
    <body><?php if(!isset($body)){$body="";} else {echo $body;}?></body>
</html>