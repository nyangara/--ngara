<?php


class Roster_Jugador extends Clases{
    private $id;
    private $roster;
    private $jugador;
    private $fecha_compra_jugador;
    private $fecha_venta_jugador;
    private $precio_compra_jugador;
    private $jugador_activo;
    private $posicion_jugador;
        
    public function __construct($datos) {
        $this->roster             =(isset($datos['roster'])) ? $datos['roster'] : -1;
        $this->posicion_jugador      =(isset($datos['posicion_jugador'])) ? $datos['posicion_jugador'] : -1;
        $this->jugador              =(isset($datos['jugador'])) ? $datos['jugador'] : -1;
        $this->fecha_compra_jugador =(isset($datos['fecha_compra_jugador'])) ? $datos['fecha_compra_jugador'] : -1;
        $this->fecha_venta_jugador  =(isset($datos['fecha_venta_jugador'])) ? $datos['fecha_venta_jugador'] : -1;
        $this->precio_compra_jugador=(isset($datos['precio_compra_jugador'])) ? $datos['precio_compra_jugador'] : -1;
        $this->jugador_activo       =(isset($datos['jugador_activo'])) ? $datos['jugador_activo'] : -1;
        $this->id                  =(isset($datos['id'])) ? $datos['id'] : -1;      
    }
    
    public function reload($datos){
        
        $this->roster              =(isset($datos['roster'])) ? $datos['roster'] : $this->roster;
        $this->posicion_jugador       =(isset($datos['posicion_jugador'])) ? $datos['posicion_jugador'] : $this->posicion_jugador;
        $this->jugador               =(isset($datos['jugador'])) ? $datos['jugador'] : $this->jugador;
        $this->fecha_compra_jugador  =(isset($datos['fecha_compra_jugador'])) ? $datos['fecha_compra_jugador'] : $this->fecha_compra_jugador;
        $this->fecha_venta_jugador   =(isset($datos['fecha_venta_jugador'])) ? $datos['fecha_venta_jugador'] : $this->fecha_venta_jugador;
        $this->precio_compra_jugador =(isset($datos['precio_compra_jugador'])) ? $datos['precio_compra_jugador'] : $this->precio_compra_jugador;
        $this->jugador_activo        =(isset($datos['jugador_activo'])) ? $datos['jugador_activo'] : $this->jugador_activo;
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
