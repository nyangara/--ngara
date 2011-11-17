<?php
class Liga {
        static private $id;
        static private $nombre;
        static private $tipo;

        public function fillClass($id, $nombre,$tipo) {
                $this->id = $id;
                $this->nombre = $nombre;
                $this->tipo = $tipo;
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

        function getTipo(){
                return $this->tipo;
        }

        function setTipo($tipo){
                $this->tipo = $tipo;
        }

        function verEquipos ($id) {
                return $equipos;
        }

        function crearLiga( $nombre,$tipo) {
                return $liga;
        }

        function eliminarLiga($id){

        }

        function agregarEquipo($ideq) {

        }

        function eliminarEquipo($ideq) {

        }
}

class LigaPrivada extends Liga{
        function invitarEquipo($u,$ideq) {

        }

        function modificarLiga($id) {
                return liga;
        }
}

class LigaPublica extends Liga{
        function aceptarSolicitud($ideq,$id) {

        }
}
?>

