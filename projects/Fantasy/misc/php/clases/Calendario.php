<?php

class Calendario {
        static private $id
                static private $fecha;
        static private array $juegos;

        public function fillClass($id,$fecha,$juegos) {
                $this->id = $id;
                $this->fecha = $fecha;
                $this->juegos = $juegos
        }

        function getId(){
                return $this->id;
        }

        function setId($id){
                $this->id = $id;
        }

        function getFecha () {
                return $this->fecha;
        }

        function setFecha($fecha) {
                $this->fecha = $fecha;
        }

        function getJuegos () {
                return $this->juegos;
        }

        function setJuegos($juegos) {
                $this->juegos = $juegos;
        }


        function agregarFecha ($eq1, $eq2, $fecha) {
                return $fecha;
        }

        function eliminarFecha( $id) {

        }
}
?>
