<?php
        require_once 'Entity.php';

        class Equipo extends Entity {
                protected static $fields = array(
                        "id",
                        "nombre completo",
                        "nombre corto",
                        "siglas",
                        "año de fundación",
                        "ciudad",
                        "estado",
                        "estadio principal"
                );
                protected $data;

                private $jugadores;

                function __construct() {
                        $this->data = array();
                        $this->jugadores = new ArrayObject();
                }

                function insert_jugador($jugador) {
                        $this->jugadores[] = $jugador;
                        return $this;
                }

                function delete_jugador($jugador) {
                        $n = $this->jugadores->count();
                        for ($i = 0; i < $n; ++$i) {
                                if ($this->jugadores[$i] == $jugador) {
                                        unset($this->jugadores[$i]);
                                        return $this;
                                }
                        }
                }

                function getIterator_jugadores() {
                        if (isset($this->jugadores)) return $this->jugadores->getIterator();
                }

                function __destruct() {
                        if (isset($this->jugadores)) {
                                $n = $this->jugadores->count();
                                for ($i = $n - 1; 0 <= $i; --$i) unset($this->jugadores[$i]);
                        }
                }
        }
?>
