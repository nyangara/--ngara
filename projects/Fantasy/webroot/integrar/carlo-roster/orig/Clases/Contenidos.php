<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Contenidos extends Clases{
    //att 
    private $id; //Clave
    private $titulo;
    private $contenidoC;
    private $fecha;
    private $urlimg;
    private $tipoC;
    private $tags;
    
    public function __construct($datos){
        
                $this->titulo      =(isset($datos['titulo'])) ? $datos['titulo'] : -1;
                $this->contenidoC  =(isset($datos['contenidoC'])) ? $datos['contenidoC'] : -1;
                $this->fecha		=(isset($datos['fecha'])) ? $datos['fecha'] : -1;
                $this->urlimg         =(isset($datos['urlimg'])) ? $datos['urlimg'] : -1;
                $this->tipoC        =(isset($datos['tipoC'])) ? $datos['tipoC'] : -1;
                $this->tags        =(isset($datos['tags'])) ? $datos['tags'] : -1;
                $this->id          =(isset($datos['id'])) ? $datos['id'] : -1;
        

        
    }
    
    public function reload($datos){
                $this->titulo      =(isset($datos['titulo'])) ? $datos['titulo'] : $this->titulo;
                $this->contenidoC  =(isset($datos['contenidoC'])) ? $datos['contenidoC'] : $this->contenidoC;
                $this->fecha		=(isset($datos['fecha'])) ? $datos['fecha'] : $this->fecha;
                $this->urlimg         =(isset($datos['urlimg'])) ? $datos['urlimg'] : $this->urlimg;
                $this->tipoC        =(isset($datos['tipoC'])) ? $datos['tipoC'] : $this->tipoC;
                $this->tags        =(isset($datos['tags'])) ? $datos['tags'] : $this->tags;
                $this->id          =(isset($datos['id'])) ? $datos['id'] : $this->id;
                
    }

    public function get(){
        return get_object_vars($this);
    }
 /*   
    public function G_Estadistica($datos){
        
        if($this->posicion == 'P')
            $obj = new Estadistica_Pitcheo($datos);
        else
            $obj = new Estadistica_Bateo($datos);    
        
        if($obj->id==-1)
            $obj->insertar();
        elseif($obj->bb==-1)
            $obj->eliminar();
        else
            $obj->actualizar();
    }
    
    public function obtenerTodasEstadisticas(){
        if($this->posicion == 'P')
            $obj = new Estadistica_Pitcheo(array('jugador'=> $this->id));
        else
            $obj = new Estadistica_Bateo(array('jugador'=> $this->id));
        
        return $obj->obtenerTodos();
    }        
    
    public function obtenerSUMEstadisticas(){
        $Tmp = $this->obtenerTodasEstadisticas();
        $Res = array();
        for($i=0;$i<count($Tmp);$i++){
            $Aux = $Tmp[$i];
            foreach ($Aux->iterador() as $key => $value){
                if($key!='fecha' && $key!='jugador' && $key!='id')
                    if(isset($Res[$key]))
                        $Res[$key]+=intval($value);
                    else
                        $Res[$key]=intval($value);
            }
        }
        return $Res;
    }
    
*/
    //php provee esas funciones para realizar todos los gets y sets
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }          
    
}

?>
