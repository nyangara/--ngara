<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Estadistica_Bateo extends Clases{
    //att de la Clase
    private $ca; // Carreras Anotadas
    private $tb; // Total de Bases
    private $ci; // Carreras impulsadas
    private $bb; // Base por Bola
    private $br; // Bases Robadas
    private $k;  // Ponches
    private $h;  // Hits

    //Clave
    private $fecha;   //Fecha dca Partcido
    private $jugador; //Jugador de la estadcistcica

    public function __construct($datos){
        
        $this->ca      =(isset($datos['ca'])) ? $datos['ca'] : -1;
        $this->tb      =(isset($datos['tb'])) ? $datos['tb'] : -1;
        $this->ci      =(isset($datos['ci'])) ? $datos['ci'] : -1;
        $this->bb      =(isset($datos['bb'])) ? $datos['bb'] : -1;
        $this->br      =(isset($datos['br'])) ? $datos['br'] : -1;
        $this->k       =(isset($datos['k'])) ? $datos['k'] : -1;
        $this->h       =(isset($datos['h'])) ? $datos['h'] : -1;
        $this->fecha   =(isset($datos['fecha'])) ? $datos['fecha'] : -1;
        $this->jugador =(isset($datos['jugador'])) ? $datos['jugador'] : -1;

    }
    
    public function reload($datos){
        
        $this->ca      =(isset($datos['ca'])) ? $datos['ca'] : $this->ca;
        $this->tb      =(isset($datos['tb'])) ? $datos['tb'] : $this->tb;
        $this->ci      =(isset($datos['ci'])) ? $datos['ci'] : $this->ci;
        $this->bb      =(isset($datos['bb'])) ? $datos['bb'] : $this->bb;
        $this->br      =(isset($datos['br'])) ? $datos['br'] : $this->br ;
        $this->k       =(isset($datos['k'])) ? $datos['k']   : $this->k ;
        $this->h       =(isset($datos['h'])) ? $datos['h']   : $this->h  ;
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
