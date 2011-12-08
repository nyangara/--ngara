<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Participa extends Clases {
    private $id;
    private $liga;
    private $manager;

    public function __construct($datos) {
            $this->id         = (isset($datos['id']))      ? $datos['id']      : -1;
            $this->liga       = (isset($datos['liga']))    ? $datos['liga']    : -1;
            $this->manager    = (isset($datos['manager'])) ? $datos['manager'] : -1;
    }

    public function reload($datos) {
            $this->id         = (isset($datos['id']))      ? $datos['id']      : $this->id;
            $this->liga       = (isset($datos['liga']))    ? $datos['liga']    : $this->liga;
            $this->manager    = (isset($datos['manager'])) ? $datos['manager'] : $this->manager;
    }

    public function get(){
        return get_object_vars($this);
    }
    
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }
}

?>
