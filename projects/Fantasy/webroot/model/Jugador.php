<?php
        require_once 'include/Entity.php';

        class Jugador extends Entity {
                protected static $table = 'Jugador';
                protected static $fields = array(
                        'id',
                        'nombre',
                        'fecha de nacimiento',
                        'lugar de procedencia'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
