<?php
        require_once 'Entity.php';

        class Liga extends Entity {
                protected static $table = "Liga";
                protected static $fields = array(
                        "id",
                        "nombre",
                        "creador",
                        "es pública"
                );
        }
?>
