<?php

require_once 'fachadaBD.php';
require_once 'Clases.php';

class Liga extends Clases {
  private $id;
  private $nombre;
  private $creador;
  private $es_publica;

  public function __construct($datos) {
    $this->id          = (isset($datos['id'])) ? $datos['id'] : -1; 
    $this->nombre      = (isset($datos['nombre'])) ? $datos['nombre'] : -1;
    $this->creador     = (isset($datos['creador'])) ? $datos['creador'] : -1;
    $this->es_publica  = (isset($datos['es_publica'])) ? $datos['es_publica'] : -1;
  }

  public function reload($datos){
    $this->id          = (isset($datos['id'])) ? $datos['id'] : $this->id; 
    $this->nombre      = (isset($datos['nombre'])) ? $datos['nombre'] : $this->nombre;
    $this->creador     = (isset($datos['creador'])) ? $datos['creador'] : $this->creador;
    $this->es_publica  = (isset($datos['es_publica'])) ? $datos['es_publica'] : $this->es_publica;
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
