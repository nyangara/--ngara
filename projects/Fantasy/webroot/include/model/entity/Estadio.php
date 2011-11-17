<?php
        require_once 'Entity.php';

        class Estadio extends Entity {
                protected static $table = "Estadio";
                protected static $fields = array(
                        'id',
                        'nombre',
                        'ciudad',
                        'estado',
                        'capacidad',
                        'tipo de terreno',
                        'año de fundación'
                );
        }
?>
