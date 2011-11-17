<?php
        require_once 'Entity.php';

        class EstadisticaPitcheo extends Entity {
                protected static $table = "Estadística de pitcheo";
                protected static $fields = array(
                        "jugador",
                        "fecha",
                        "entradas lanzadas",
                        "carreras limpias",
                        "imparables",
                        "bases por bola",
                        "punchouts",
                        "juegos ganados",
                        "errores"
                );
                protected $data;
        }
?>
