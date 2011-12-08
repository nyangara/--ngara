<?php
        require_once 'include/Entity.php';

        class TieneEquipo extends Entity {
                protected static $table = 'Usuario tiene lanzadores';
                protected static $fields = array(
                        'usuario',
                        'equipo',
                        'fecha de compra',
                        'fecha de venta',
                        'precio de compra',
                        'activo'
                );
                protected static $pk = array(
                        'usuario',
                        'equipo'
                );
                protected $data;
        }
?>
