<?php
        require_once 'include/Entity.php';

        class EstadisticaPitcheo extends Entity {
                protected static $table = 'Estadística de pitcheo';
                protected static $fields = array(
                        'id',
                        'jugador',
                        'fecha',
                        'el',
                        'cl',
                        'i',
                        'bb',
                        'k',
                        'jg',
                        'errores'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
