<?php
        require_once 'include/model/facade/Facade.php';
        require_once 'include/model/entity/Equipo.php';

        class FacadeEquipo extends Facade {
                protected static $entity_class = 'Equipo';
        }
?>
