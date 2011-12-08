<?php
        require_once 'include/Entity.php';

        class TieneJugador extends Entity {
                protected static $table = 'Usuario tiene jugador';
                protected static $fields = array(
                        'usuario',
                        'jugador',
                        'fecha de compra',
                        'fecha de venta',
                        'precio de compra',
                        'activo',
                        'posición'
                );
                protected static $pk = array(
                        'usuario',
                        'jugador'
                );
                protected $data;
        }
?>
