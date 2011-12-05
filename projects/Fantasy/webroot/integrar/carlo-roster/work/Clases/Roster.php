<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Roster extends Clases{
    private $id;
    private $nombre;
    private $manager;
    private $fecha_creacion;

        
    public function __construct($datos) {
        
        $this->nombre              =(isset($datos['nombre'])) ? $datos['nombre'] : -1;
        $this->manager             =(isset($datos['manager'])) ? $datos['manager'] : -1;
        $this->fecha_creacion      =(isset($datos['fecha_creacion'])) ? $datos['fecha_creacion'] : -1;
        $this->id                  =(isset($datos['id'])) ? $datos['id'] : -1;      
    }
    
    public function reload($datos){
        
        $this->nombre               =(isset($datos['nombre'])) ? $datos['nombre'] : $this->nombre;
        $this->manager              =(isset($datos['manager'])) ? $datos['manager'] : $this->manager;
        $this->fecha_creacion       =(isset($datos['fecha_creacion'])) ? $datos['fecha_creacion'] : $this->fecha_creacion;
        $this->id                   =(isset($datos['id'])) ? $datos['id'] : $this->id; 
                
    }
    
     public function get(){
        return get_object_vars($this);
    }
    
    //php provee esas funciones para realizar todos los gets y sets
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }     
    
}

?>
