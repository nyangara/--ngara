<?php
class Juego {
        static private $id;
        static private $nombre;

        public function fillClass($id, $nombre) {
                $this->id = $id;
                $this->nombre = $nombre;

        }

        function getId(){
                return $this->id;
        }

        function setId($id){
                $this->id = $id;
        }

        function getNombre () {
                return $this->nombre;
        }

        function setNombre($nombre) {
                $this->nombre = $nombre;
        }

        function crearJuego ($eq1, $eq2, $nombre, $fecha) {
                return $juego;
        }

        function eliminarJuego( $id) {

        }
}
?>
