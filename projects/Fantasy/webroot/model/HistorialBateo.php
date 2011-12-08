<?php
        require_once 'include/Entity.php';

        class HistorialBateo extends Entity {
                protected static $table = 'Historial_Bateo';
                protected static $fields = array(
                        'id',
                        'jugador',
                        'anio',
                        'vb',
                        'h'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
