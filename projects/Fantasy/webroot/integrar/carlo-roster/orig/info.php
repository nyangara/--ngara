<?php
	
    require_once("Clases/fachadaParser.php");
    
    $instancia = fachadaParser::singleton();
    
    //Cambiar en php.ini max_execution_time=30 por max_execution_time=500
    
   //Con esto se cargan todos los jugadores en la BD, es necesario cargar los estadios y equipos antes
   $instancia->sincronizarJugadores();
   //Con esto se cargan las estadisticas
   $instancia->sincronizarEstadisticasJugadores();
?>  