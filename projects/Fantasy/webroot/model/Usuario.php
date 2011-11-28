<?php
        require_once 'include/Entity.php';

        class Usuario extends Entity {
                protected static $table = 'Usuario';
                protected static $fields = array(
                        'id',
                        'username',
                        'nombre completo',
                        'género',
                        'fecha de nacimiento',
                        'es administrador',
                        'dirección de e-mail',
                        'URL del avatar'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
