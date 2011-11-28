<?php
        require_once 'include/Entity.php';

        class Liga extends Entity {
                protected static $table = 'Liga';
                protected static $fields = array(
                        'id',
                        'nombre',
                        'creador',
                        'es pública'
                );
                protected static $pk = array(
                        'id'
                );
                protected $data;
        }
?>
