<?php
        require_once 'include/Entity.php';

        class Juego extends Entity {
                protected static $table = 'Juego';
                protected static $fields = array(
                        'id',
                        'inicio',
                        'equipo local',
                        'equipo visitante',
                        'estadio',
                        'carreras del equipo local',
                        'carreras del equipo visitante',
                        'hits del equipo local',
                        'hits del equipo visitante',
                        'errores del equipo local',
                        'errores del equipo visitante',
                        'estado'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
