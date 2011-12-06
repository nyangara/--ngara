<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Usuario extends Clases {
    
    private $id;
    private $username;
    private $password;

    public function __construct($datos){
        $this->username = (isset($datos['username'])) ? $datos['username'] : -1; 
        $this->password = (isset($datos['password'])) ? $datos['password'] : -1;
        $this->id = (isset($datos['id'])) ? $datos['id'] : -1;
    }

    public function reload($datos){
        $this->id = (isset($datos['id'])) ? $datos['id'] : $this->id;
        $this->username =(isset($datos['username'])) ? $datos['username'] : $this->username;
        $this->password =(isset($datos['password'])) ? $datos['password'] : $this->password;
    }       

    public function get(){
        return get_object_vars($this);
    }    
    
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }     
}    
?>
