<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Post {
    
    private $id;
    private $fecha;
    private $texto;
    private $autor;
    private $active;

    public function getId() {
        return $this->id;
    }

    public function getFecha() {
        return $this->fecha;
    }
    
    public function getTexto() {
        return $this->texto;
    }
    
    public function getAutor() {
        return $this->autor;
    }
    
    public function getActive() {
        return $this->active;
    }
    
    public function setId($id) {
        //Id es de sólo lectura
        return false;
    }
    
    public function setFecha($fecha) {
        $this->fecha=$fecha;
    }
    
    public function setTexto($texto) {
        $this->texto=$texto;
    }
    
    public function setAutor($autor) {
        $this->autor=$autor;
    }
    
    public function setActive($active) {
        $this->active=$active;
    }
}

/* End of file Someclass.php */
