<?php
        require_once 'Entity.php';

        class Jugador extends Entity {
                protected static $table = "Jugador";
                protected static $fields = array(
                        "id",
                        "nombre",
                        "fecha de nacimiento",
                        "lugar de procedencia"
                );
                protected $data;
        }
?>
