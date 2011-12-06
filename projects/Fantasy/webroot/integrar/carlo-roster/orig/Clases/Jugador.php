<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Jugador extends Clases{
    //att de Jugador
    private $id; //Clave
    private $nombres;
    private $posicion;
    private $precio;
    private $equipo; //Referencia a Equipo
//    private $errores; 
    private $foto;
    
    public function __construct($datos){
        
                $this->nombres          =(isset($datos['nombres'])) ? $datos['nombres'] : -1;
                $this->posicion         =(isset($datos['posicion'])) ? $datos['posicion'] : -1;
                $this->precio           =(isset($datos['precio'])) ? $datos['precio'] : -1;
                $this->equipo           =(isset($datos['equipo'])) ? $datos['equipo'] : -1;
//              $this->errores          =(isset($datos['errores'])) ? $datos['errores'] : -1;
                $this->foto             =(isset($datos['foto'])) ? $datos['foto'] : -1;
                $this->id               =(isset($datos['id'])) ? $datos['id'] : -1;
        
    }
    
    public function reload($datos){
        
                $this->nombres          =(isset($datos['nombres'])) ? $datos['nombres'] : $this->nombres;
                $this->posicion         =(isset($datos['posicion'])) ? $datos['posicion'] : $this->posicion;
                $this->precio           =(isset($datos['precio'])) ? $datos['precio'] : $this->precio;
                $this->equipo           =(isset($datos['equipo'])) ? $datos['equipo'] : $this->equipo;
//              $this->errores          =(isset($datos['errores'])) ? $datos['errores'] : $this->errores;
                $this->foto             =(isset($datos['foto'])) ? $datos['foto'] : $this->foto;
                $this->id               =(isset($datos['id'])) ? $datos['id'] :  $this->id;
                
    }

    public function get(){
        return get_object_vars($this);
    }
    
    public function G_Estadistica($datos){
        
        $datos['jugador']=$this->id;
      
        if($this->posicion == 'P')
            $obj = new Estadistica_Pitcheo($datos);
        else
            $obj = new Estadistica_Bateo($datos);    
        
        //Objeto seria Estadistica_Bateo o Estadistica_Pitcheo dependiendo de que se quiera
        
        if($obj->id==-1)
            $obj->insertar();
        elseif($obj->bb==-1)
            $obj->eliminar();
        else
            $obj->actualizar();
    }
    
    public function obtenerEstadistica($datos){
        
        if($this->posicion == 'P')
            $obj = new Estadistica_Pitcheo($datos);
        else
            $obj = new Estadistica_Bateo($datos);
        
        $obj->obtener();
       
        
        return $obj;
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
    

    //php provee esas funciones para realizar todos los gets y sets
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }          
    
}

?>
