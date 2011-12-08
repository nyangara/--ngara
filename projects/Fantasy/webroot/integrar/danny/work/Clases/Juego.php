<?php

require_once 'Clases.php';
require_once 'fachadaBD.php';

class Juego extends Clases {
    private $id;
    private $status;
    private $inicio;
    private $equipo_local;
    private $equipo_visitante;
    private $estadio;
    private $carreras_equipo_local;
    private $carreras_equipo_visitante;
    private $hits_equipo_local;
    private $hits_equipo_visitante;
    private $errores_equipo_local;
    private $errores_equipo_visitante;

    public function __construct($datos) {
            $this->id                        = (isset($datos['id']))                        ? $datos['id']                        : -1;
            $this->status                    = (isset($datos['status']))                    ? $datos['status']                    : -1;
            $this->inicio                    = (isset($datos['inicio']))                    ? $datos['inicio']                    : -1;
            $this->equipo_local              = (isset($datos['equipo_local']))              ? $datos['equipo_local']              : -1;
            $this->equipo_visitante          = (isset($datos['equipo_visitante']))          ? $datos['equipo_visitante']          : -1;
            $this->estadio                   = (isset($datos['estadio']))                   ? $datos['estadio']                   : -1;
            $this->carreras_equipo_local     = (isset($datos['carreras_equipo_local']))     ? $datos['carreras_equipo_local']     : -1;
            $this->carreras_equipo_visitante = (isset($datos['carreras_equipo_visitante'])) ? $datos['carreras_equipo_visitante'] : -1;
            $this->hits_equipo_local         = (isset($datos['hits_equipo_local']))         ? $datos['hits_equipo_local']         : -1;
            $this->hits_equipo_visitante     = (isset($datos['hits_equipo_visitante']))     ? $datos['hits_equipo_visitante']     : -1;
            $this->errores_equipo_local      = (isset($datos['errores_equipo_local']))      ? $datos['errores_equipo_local']      : -1;
            $this->errores_equipo_visitante  = (isset($datos['errores_equipo_visitante']))  ? $datos['errores_equipo_visitante']  : -1;
    }

    public function reload($datos) {
            $this->id                        = (isset($datos['id']))                        ? $datos['id']                        : $this->id;
            $this->status                    = (isset($datos['status']))                    ? $datos['status']                    : $this->status;
            $this->inicio                    = (isset($datos['inicio']))                    ? $datos['inicio']                    : $this->inicio;
            $this->equipo_local              = (isset($datos['equipo_local']))              ? $datos['equipo_local']              : $this->equipo_local;
            $this->equipo_visitante          = (isset($datos['equipo_visitante']))          ? $datos['equipo_visitante']          : $this->equipo_visitante;
            $this->estadio                   = (isset($datos['estadio']))                   ? $datos['estadio']                   : $this->estadio;
            $this->carreras_equipo_local     = (isset($datos['carreras_equipo_local']))     ? $datos['carreras_equipo_local']     : $this->carreras_equipo_local;
            $this->carreras_equipo_visitante = (isset($datos['carreras_equipo_visitante'])) ? $datos['carreras_equipo_visitante'] : $this->carreras_equipo_visitante;
            $this->hits_equipo_local         = (isset($datos['hits_equipo_local']))         ? $datos['hits_equipo_local']         : $this->hits_equipo_local;
            $this->hits_equipo_visitante     = (isset($datos['hits_equipo_visitante']))     ? $datos['hits_equipo_visitante']     : $this->hits_equipo_visitante;
            $this->errores_equipo_local      = (isset($datos['errores_equipo_local']))      ? $datos['errores_equipo_local']      : $this->errores_equipo_local;
            $this->errores_equipo_visitante  = (isset($datos['errores_equipo_visitante']))  ? $datos['errores_equipo_visitante']  : $this->errores_equipo_visitante;
    }

    public function get(){
        return get_object_vars($this);
    }
    
    public function __get($name){
        return $this->$name;  
    }

    public function __set($name, $value) {
        $this->$name=$value;
    }
}

?>
