<?php
        require_once('Facade.php');
        require_once('../entity/Jugador.php');

        class FacadeJugador extends Facade {
                protected static $entity_class = 'Jugador';
        }
?>
