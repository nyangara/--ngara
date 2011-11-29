<?php
        require_once 'include/Entity.php';

        class Noticia extends Entity {
                protected static $table = 'Noticia';
                protected static $fields = array(
                        'id',
                        "título",
                        "contenido",
                        "fecha",
                        "URL de imagen",
                        "tags"
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
