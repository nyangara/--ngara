<?php
class Contenido {
        static private $id;
        static private $titulo;
        static private $fecha;

        public function fillClass($id, $titulo, $fecha) {
                $this->id = $id;
                $this->titulo = $titulo;
                $this->fecha = $fecha;
        }

        function getId(){
                return $this->id;
        }

        function setId($id){
                $this->id = $id;
        }

        function getTitulo () {
                return $this->titulo;
        }

        function setTitulo($titulo) {
                $this->titulo = $titulo;
        }

        function getFecha(){
                return $this->fecha;
        }

        function setFecha($fecha){
                $this->fecha = $fecha;
        }

        function obtenerContenido ($id) {
                return $contenido;
        }

        function agregarContenido( $titulo, $fecha) {
                return $contenido;
        }

        function eliminarContenido($id){

        }
}

class Documento extends Contenido{
        static private $texto;

        public function fillClass($texto) {
                $this->texto = $texto;
        }

        function getTexto(){
                return $this->texto;
        }

        function setTexto($texto){
                $this->texto = $texto;
        }
}

class Regla extends Contenido{
        static private $id;
        static private $texto;

        public function fillClass( $id, $texto) {
                $this->id = $id;
                $this->texto = $texto;
        }

        function getId(){
                return $this->id;
        }

        function setId($id){
                $this->id = $id;
        }

        function getTexto(){
                return $this->texto;
        }

        function setTexto($texto){
                $this->texto = $texto;
        }
}
?>

