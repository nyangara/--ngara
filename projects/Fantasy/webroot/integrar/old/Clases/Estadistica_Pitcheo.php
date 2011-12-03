<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Estadistica_Pitcheo extends Clases {
    //att de la Clase
    private $el; // Entradas Lanzadas
    private $cl; // Carreras Limpias
    private $i;  // Imparables
    private $bb; // Bases por Bola
    private $k;  // Ponches
    private $jg; // Juegos Ganados

    //Clave
    private $fecha;   //Fecha del Partido
    private $jugador; //Jugador de la estadistica

    public function __construct($datos){
            $this->el      =(isset($datos['el'])) ? $datos['el'] : -1;
            $this->cl      =(isset($datos['cl'])) ? $datos['cl'] : -1;
            $this->i       =(isset($datos['i'])) ? $datos['i'] : -1;
            $this->bb      =(isset($datos['bb'])) ? $datos['bb'] : -1;
            $this->k       =(isset($datos['k'])) ? $datos['k'] : -1;
            $this->jg      =(isset($datos['jg'])) ? $datos['jg'] : -1;
            $this->fecha   =(isset($datos['fecha'])) ? $datos['fecha'] : -1;
            $this->jugador =(isset($datos['jugador'])) ? $datos['jugador'] : -1;

    }
    
    public function reload($datos){
        
            $this->el      =(isset($datos['el'])) ? $datos['el'] : $this->el;
            $this->cl      =(isset($datos['cl'])) ? $datos['cl'] : $this->cl;
            $this->i       =(isset($datos['i'])) ? $datos['i'] : $this->i;
            $this->bb      =(isset($datos['bb'])) ? $datos['bb'] : $this->bb;
            $this->k       =(isset($datos['k'])) ? $datos['k'] : $this->k;
            $this->jg      =(isset($datos['jg'])) ? $datos['jg'] : $this->jg;
            $this->fecha   =(isset($datos['fecha'])) ? $datos['fecha'] : $this->fecha;
            $this->jugador =(isset($datos['jugador'])) ? $datos['jugador'] : $this->jugador;
                
    }

    public function get(){
        return get_object_vars($this);
    }   
    
    function iterador() {
        foreach($this as $key => $value)
            $Tmp[$key]=$value;
        return $Tmp;
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
