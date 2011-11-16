<?php
        require_once 'Entity.php';

        class Jugador extends Entity {
                protected static $fields = array(
                        "id",
                        "nombre",
                        "fecha de nacimiento",
                        "lugar de procedencia"
                );
                protected $data;

                private $estadisticas;

                function __construct() {
                        $this->data = array();
                        $this->estadisticas = new ArrayObject();
                }

                function insert_estadistica($estadistica) {
                        $this->estadisticas->append($estadistica);
                }

                function delete_estadistica($Estadistica) {
                        $Cont_E = $this->Estadisticas->count();
                        for($i=0;i<$Cont_E;$i++)
                                if(     $this->estadisticas->offsetGet($i) == $Estadistica) {
                                        $this->estadisticas->offsetUnset($i);
                                        return true;
                                        }
                        return false;
                }

                function getIterator_estadisticas() {
                        if(isset($this->estadisticas)) return $this->estadisticas->getIterator();
                }

                function __destruct() {
                        if (isset($this->estadisticas)) {
                                $n = $this->estadisticas->count();
                                for ($i = $n - 1; 0 <= $i; --$i) unset($this->estadisticas[$i]);
                        }
                }
        }
?>
