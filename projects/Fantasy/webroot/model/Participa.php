<?php
        require_once 'include/Entity.php';

        class Participa extends Entity {
                protected static $table = 'Participa';
                protected static $fields = array(
                        'usuario',
                        'liga'
                );
                protected static $pk = array(
                        'usuario',
                        'liga'
                );
                protected $data;
        }
?>
