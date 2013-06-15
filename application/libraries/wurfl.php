<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Wurfl {
    
    private $wurflObj;
    
    public function Wurfl() {
        require_once('./wurfl/TeraWurfl.php');
        
        $this->wurflObj = new TeraWurfl();
        $this->wurflObj->getDeviceCapabilitiesFromRequest();
        
    }
    
    public function obtenerModelo() {
        return $this->wurflObj->getDeviceCapability('model_name');
    }
    
    public function obtenerMarca() {
        return $this->wurflObj->getDeviceCapability('brand_name');
    }
    
    public function obtenerStringDispositivo() {
        $device="Escrito desde: ";
        $device.=$this->wurflObj->getDeviceCapability('model_name');
        $device.=" (".$this->wurflObj->getDeviceCapability('brand_name').")";
        return $device;
    }
    
    public function obtenCaract($caract) {
        return $this->wurflObj->getDeviceCapability($caract);
    }
}


/* End of file wurfl.php */