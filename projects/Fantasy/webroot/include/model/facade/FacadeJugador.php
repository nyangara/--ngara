<?php
        require_once 'include/model/facade/Facade.php';
        require_once 'include/model/entity/Jugador.php';

        class FacadeJugador extends Facade {
                protected static $entity_class = 'Jugador';
        }
?>
