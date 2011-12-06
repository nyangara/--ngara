<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Estadio extends Clases{
    //att de Estadio
    private $id; //Clave
    private $nombre;
    private $ubicacion;
    private $propietario;
    private $capacidad;
    private $medida_left_field;
    private $medida_center_field;
    private $medida_right_field;
    private $tipo_terreno;
    private $fecha_fundacion;
    private $descripcion;
    private $foto;

    public function __construct($datos){

            $this->nombre              =(isset($datos['nombre'])) ? $datos['nombre'] : -1;
            $this->ubicacion           =(isset($datos['ubicacion'])) ? $datos['ubicacion'] : -1;
            $this->propietario         =(isset($datos['propietario'])) ? $datos['propietario'] : -1;
            $this->capacidad           =(isset($datos['capacidad'])) ? $datos['capacidad'] : -1;
            $this->medida_left_field   =(isset($datos['medida_left_field'])) ? $datos['medida_left_field'] : -1;
            $this->medida_center_field =(isset($datos['medida_center_field'])) ? $datos['medida_center_field'] : -1;
            $this->medida_right_field  =(isset($datos['medida_right_field'])) ? $datos['medida_right_field'] : -1;
            $this->tipo_terreno        =(isset($datos['tipo_terreno'])) ? $datos['tipo_terreno'] : -1;
            $this->fecha_fundacion     =(isset($datos['fecha_fundacion'])) ? $datos['fecha_fundacion'] : -1;
            $this->descripcion         =(isset($datos['descripcion'])) ? $datos['descripcion'] : -1;
            $this->foto                =(isset($datos['foto'])) ? $datos['foto'] : -1;
            $this->id                  =(isset($datos['id'])) ? $datos['id'] : -1;
    }
    
    public function reload($datos){
        
            $this->nombre              =(isset($datos['nombre'])) ? $datos['nombre'] : $this->nombre;
            $this->ubicacion           =(isset($datos['ubicacion'])) ? $datos['ubicacion'] : $this->ubicacion;
            $this->propietario         =(isset($datos['propietario'])) ? $datos['propietario'] : $this->propietario;
            $this->capacidad           =(isset($datos['capacidad'])) ? $datos['capacidad'] : $this->capacidad;
            $this->medida_left_field   =(isset($datos['medida_left_field'])) ? $datos['medida_left_field'] : $this->medida_left_field;
            $this->medida_center_field =(isset($datos['medida_center_field'])) ? $datos['medida_center_field'] : $this->this->medida_center_field;
            $this->medida_right_field  =(isset($datos['medida_right_field'])) ? $datos['medida_right_field'] : $this->medida_right_field;
            $this->tipo_terreno        =(isset($datos['tipo_terreno'])) ? $datos['tipo_terreno'] : $this->tipo_terreno;
            $this->fecha_fundacion     =(isset($datos['fecha_fundacion'])) ? $datos['fecha_fundacion'] : $this->fecha_fundacion;
            $this->descripcion         =(isset($datos['descripcion'])) ? $datos['descripcion'] : $this->descripcion;
            $this->foto                =(isset($datos['foto'])) ? $datos['foto'] : $this->foto;
            $this->id                  =(isset($datos['id'])) ? $datos['id'] : $this->id;
                
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

