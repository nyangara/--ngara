<?php
class Noticia {
        static private $id;
        static private $titulo;
        static private $fecha;
        static private $texto;

        public function fillClass($id, $titulo, $fecha, $texto) {
                $this->id = $id;
                $this->titulo = $titulo;
                $this->fecha = $fecha;
                $this->texto = $texto;
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

        function getTexto(){
                return $this->texto;
        }

        function setTexto($texto){
                $this->texto = $texto;
        }

        function obtenerNoticiaJugador ($idjugador) {
                return $noticia;
        }

        function obtenerNoticiaJuego( $idjuego) {
                return $noticia;
        }

        function obtenerNoticiaEquipo($idequipo){
                return $noticia
        }

        function eliminarNoticia($id){

        }
}
?>
