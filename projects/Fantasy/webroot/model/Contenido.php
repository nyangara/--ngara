<?php
        require_once 'include/Entity.php';

        class Contenido extends Entity {
                protected static $table = 'Contenido';
                protected static $fields = array(
                        "id",
                        "título",
                        "texto",
                        "fecha",
                        "URL de imagen",
                        "tags",
                        "tipo"
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
