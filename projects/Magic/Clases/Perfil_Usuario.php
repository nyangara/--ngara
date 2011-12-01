<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Perfil_Usuario extends Clases{
    //att de Perfil Usuario
    private $id; //Clave
    private $nombres;
    private $usuario;
    private $apellidos;
    private $avatar;
    private $email;

    public function __construct($datos){

            $this->nombres              =(isset($datos['nombres'])) ? $datos['nombres'] : -1;
            $this->usuario           =(isset($datos['usuario'])) ? $datos['usuario'] : -1;
            $this->apellidos         =(isset($datos['apellidos'])) ? $datos['apellidos'] : -1;
            $this->avatar           =(isset($datos['avatar'])) ? $datos['avatar'] : -1;
            $this->email   =(isset($datos['email'])) ? $datos['email'] : -1;
            $this->id                  =(isset($datos['id'])) ? $datos['id'] : -1;
    }
    
    public function reload($datos){
        
            $this->nombres              =(isset($datos['nombres'])) ? $datos['nombres'] : $this->nombres;
            $this->usuario           =(isset($datos['usuario'])) ? $datos['usuario'] : $this->usuario;
            $this->apellidos         =(isset($datos['apellidos'])) ? $datos['apellidos'] : $this->apellidos;
            $this->avatar           =(isset($datos['avatar'])) ? $datos['avatar'] : $this->avatar;
            $this->email   =(isset($datos['email'])) ? $datos['email'] : $this->email;
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
