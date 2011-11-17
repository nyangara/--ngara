<?php
        require_once 'Entity.php';

        class EstadisticaBateo extends Entity {
                protected static $table = "Estadística de bateo";
                protected static $fields = array(
                        "jugador",
                        "fecha",
                        "carreras impulsadas",
                        "carreras anotadas",
                        "total de bases",
                        "bases robadas",
                        "bases por bola",
                        "ponches",
                        "errores",
                );
                protected $data;
        }
?>
