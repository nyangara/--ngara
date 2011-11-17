<?php
        require_once('Facade.php');
        require_once('../entity/EstadisticaBateo.php');

        class FacadeEstadisticaBateo extends Facade {
                protected static $entity_class = 'EstadisticaBateo';
        }
?>
