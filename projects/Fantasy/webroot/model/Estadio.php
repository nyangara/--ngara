<?php
        require_once 'include/Entity.php';

        class Estadio extends Entity {
                protected static $table = 'Estadio';
                protected static $fields = array(
                        'id',
                        'nombre',
                        'ciudad',
                        'estado',
                        'capacidad',
                        'año de fundación',
                        'tipo de terreno',
                        'propietario',
                        'medida del left field',
                        'medida del center field',
                        'medida del right field',
                        'descripción',
                        'URL de la foto'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
