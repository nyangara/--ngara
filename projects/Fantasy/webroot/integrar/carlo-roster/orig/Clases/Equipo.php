<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Equipo extends Clases{
//att de Equipo
    private $id; //Clave
    private $nombre;
    private $precio;
    private $siglas;
    private $fecha_fundacion;
    private $logo;
    private $home; //Foranea a estadio		

    //Funcion Constructora de la clase
    public function __construct($datos){
            $this->nombre          =(isset($datos['nombre'])) ? $datos['nombre'] : -1;
            $this->precio          =(isset($datos['precio'])) ? $datos['precio'] : -1;
            $this->siglas          =(isset($datos['siglas'])) ? $datos['siglas'] : -1;
            $this->fecha_fundacion =(isset($datos['fecha_fundacion'])) ? $datos['fecha_fundacion'] : -1;
            $this->logo            =(isset($datos['logo'])) ? $datos['logo'] : -1;;
            $this->home            =(isset($datos['home'])) ? $datos['home'] : -1;
            $this->id              =(isset($datos['id'])) ? $datos['id'] : -1;
    }

    public function reload($datos){
        
            $this->nombre          =(isset($datos['nombre'])) ? $datos['nombre'] : $this->nombre;
            $this->precio          =(isset($datos['precio'])) ? $datos['precio'] : $this->precio;
            $this->siglas          =(isset($datos['siglas'])) ? $datos['siglas'] : $this->siglas;
            $this->fecha_fundacion =(isset($datos['fecha_fundacion'])) ? $datos['fecha_fundacion'] : $this->fecha_fundacion;
            $this->logo            =(isset($datos['logo'])) ? $datos['logo'] : $this->logo;
            $this->home            =(isset($datos['home'])) ? $datos['home'] : $this->home;
            $this->id              =(isset($datos['id'])) ? $datos['id'] : $this->id;
                
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