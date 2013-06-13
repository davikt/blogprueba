<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Post {
    
    private $id;
    private $fecha;
    private $texto;
    private $autor;
    private $active;
    private $dispositivo;
    private $dia;
    private $mes;
    
    /**
     * Definiendo los Getters de las variables
     * @return var
     */

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
    
    public function getDispositivo() {
        return $this->dispositivo;
    }
    
    public function getDia() {
        return $this->dia;
    }
    
    public function getMes() {
        return $this->mes;
    }
    
    /**
     * Definiendo los Setters
     * @param var
     */
    
    public function setId($id) {
        $this->id=$id;
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
    
    public function setDispositivo($dispositivo) {
        $this->dispositivo=$dispositivo;
    }
    
    public function setDia($dia) {
        $this->dia=$dia;
    }
    
    public function setMes($mes) {
        $this->mes=$mes;
    }
}

/* End of file post.php */
