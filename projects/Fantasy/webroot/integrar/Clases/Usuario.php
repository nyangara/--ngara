<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Usuario extends Clases{
    //att de Usuario
    private $id; //Clave
    private $username;
    private $password;

    public function __construct($datos){

            $this->username              =(isset($datos['username'])) ? $datos['username'] : -1;
            $this->password           =(isset($datos['password'])) ? $datos['password'] : -1;
            $this->id                  =(isset($datos['id'])) ? $datos['id'] : -1;
    }
    
    public function reload($datos){
        
            $this->username              =(isset($datos['username'])) ? $datos['username'] : $username;
            $this->password           =(isset($datos['password'])) ? $datos['password'] : $password;
            $this->id                  =(isset($datos['id'])) ? $datos['id'] : $id;
                
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
