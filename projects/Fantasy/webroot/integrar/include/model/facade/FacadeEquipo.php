<?php
        require_once('Facade.php');
        require_once('../entity/Equipo.php');

        class FacadeEquipo extends Facade {
                protected static $entity_class = 'Equipo';
        }
?>
