<?php
        require_once 'include/model/facade/Facade.php';
        require_once 'include/model/entity/Liga.php';

        class FacadeLiga extends Facade {
                protected static $entity_class = 'Liga';
        }
?>
