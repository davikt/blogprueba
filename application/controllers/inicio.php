<?php

class Inicio extends CI_Controller {
    function index() {
        
        require_once('./wurfl/TeraWurfl.php');
        
        // instantiate a new TeraWurfl object
        $wurflObj = new TeraWurfl();
  
        // Get the capabilities of the current client.
        $wurflObj->getDeviceCapabilitiesFromRequest();
        
        $device=$wurflObj->getDeviceCapability('brand_name');
        $device.=" - ".$wurflObj->getDeviceCapability('model_name');
        
        
        $setUpPage=array(
            'titulo' => 'Inicio',
            'css' => 'inicio.css',
            'device' => $device
        );
        
        $this->load->view('main_view', $setUpPage);
    }
}


?>
