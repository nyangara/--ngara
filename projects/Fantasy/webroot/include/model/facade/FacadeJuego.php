<?php
        require_once 'include/model/facade/Facade.php';
        require_once 'include/model/entity/Juego.php';

        class FacadeJuego extends Facade {
                protected static $entity_class = 'Juego';
        }
?>
