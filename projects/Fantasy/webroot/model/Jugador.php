<?php
        require_once 'include/Entity.php';

        class Jugador extends Entity {
                protected static $table = 'Jugador';
                protected static $fields = array(
                        'id',
                        'nombre completo',
                        'fecha de nacimiento',
                        'lugar de procedencia',
                        'URL de la foto',
                        'equipo',
                        'número',
                        'posición',
                        'precio'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
