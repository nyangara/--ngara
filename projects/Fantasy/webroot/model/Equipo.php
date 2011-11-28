<?php
        require_once 'include/Entity.php';

        class Equipo extends Entity {
                protected static $table = 'Equipo';
                protected static $fields = array(
                        'id',
                        'nombre completo',
                        'nombre corto',
                        'siglas',
                        'año de fundación',
                        'ciudad',
                        'estado',
                        'estadio principal'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
