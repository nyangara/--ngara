<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Manager extends Clases {
    
    private $id;
    private $creditos;
    private $puntaje;
    private $usuario;

    public function __construct($datos){
        $this->creditos = (isset($datos['creditos'])) ? $datos['creditos'] : -1; 
        $this->puntaje = (isset($datos['puntaje'])) ? $datos['puntaje'] : -1;
        $this->usuario = (isset($datos['usuario'])) ? $datos['usuario'] : -1;
        $this->id = (isset($datos['id'])) ? $datos['id'] : -1;
    }

    public function reload($datos){
        $this->creditos = (isset($datos['creditos'])) ? $datos['creditos'] : $this->creditos; 
        $this->puntaje = (isset($datos['puntaje'])) ? $datos['puntaje'] : $this->puntaje;
        $this->usuario = (isset($datos['usuario'])) ? $datos['usuario'] : $this->usuario;
        $this->id = (isset($datos['id'])) ? $datos['id'] : $this->id;
    }       

    public function get(){
        return get_object_vars($this);
    }    
    
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }     
}    
?>
