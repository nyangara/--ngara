<?php

class Roster_Equipo extends Clases{
        private $id;//Clave
        private $roster;//Foranea a Roster
        private $equipo;//Foranea a Equipo
        private $fecha_compra_equipo; 
        private $fecha_venta_equipo;  
        private $precio_compra_equipo;
        private $equipo_activo;

        public function __construct($datos) {
            
            $this->roster               =(isset($datos['roster'])) ? $datos['roster'] : -1;
            $this->equipo               =(isset($datos['equipo'])) ? $datos['equipo'] : -1;
            $this->fecha_compra_equipo  =(isset($datos['fecha_compra_equipo'])) ? $datos['fecha_compra_equipo'] : -1;
            $this->fecha_venta_equipo   =(isset($datos['fecha_venta_equipo'])) ? $datos['fecha_venta_equipo'] : -1;
            $this->precio_compra_equipo =(isset($datos['precio_compra_equipo'])) ? $datos['precio_compra_equipo'] : -1;
            $this->equipo_activo        =(isset($datos['equipo_activo'])) ? $datos['equipo_activo'] : -1;
            $this->id                   =(isset($datos['id'])) ? $datos['id'] : -1;            
        }
        
    public function reload($datos){
        
            $this->roster               =(isset($datos['roster'])) ? $datos['roster'] : $this->roster;
            $this->equipo               =(isset($datos['equipo'])) ? $datos['equipo'] : $this->equipo;
            $this->fecha_compra_equipo  =(isset($datos['fecha_compra_equipo'])) ? $datos['fecha_compra_equipo'] : $this->fecha_compra_equipo;
            $this->fecha_venta_equipo   =(isset($datos['fecha_venta_equipo'])) ? $datos['fecha_venta_equipo'] : $this->fecha_venta_equipo;
            $this->precio_compra_equipo =(isset($datos['precio_compra_equipo'])) ? $datos['precio_compra_equipo'] : $this->precio_compra_equipo;
            $this->equipo_activo        =(isset($datos['equipo_activo'])) ? $datos['equipo_activo'] : $this->equipo_activo;
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
