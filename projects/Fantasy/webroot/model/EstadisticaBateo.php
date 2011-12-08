<?php
        require_once 'include/Entity.php';

        class EstadisticaBateo extends Entity {
                protected static $table = 'Estadística de bateo';
                protected static $fields = array(
                        'id',
                        'jugador',
                        'fecha',
                        'ci',
                        'ca',
                        'tb',
                        'br',
                        'bb',
                        'h',
                        'h2',
                        'h3',
                        'hr',
                        'vb',
                        'k'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
