<?php
        require_once 'include/model/facade/Facade.php';
        require_once 'include/model/entity/Usuario.php';

        class FacadeUsuario extends Facade {
                protected static $entity_class = 'Usuario';
        }
?>
