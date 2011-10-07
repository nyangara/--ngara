<?php

	error_reporting( E_ALL );
		include "config.php";

	$Nombre = pg_escape_string (trim($_POST['nombre']));
	$Capacidad = trim($_POST['capacidad']);
	$Ciudad = pg_escape_string(trim($_POST['ciudad']));
	$Estado = pg_escape_string(trim($_POST['estado']));
	$Fundacion = pg_escape_string(trim($_POST['fundacion']));
	$TipoDeTerreno = pg_escape_string(trim($_POST['terreno']));


        $query = "INSERT INTO \"Estadio\" (\"Nombre_estadio\",\"Capacidad_estadio\",\"Ciudad_estadio\",\"Estado_estadio\",\"Fundacion_estadio\",\"Tipo_terreno\", SELECT '{$Nombre}', '{$Apellido}','{$Numero}','{$Tipo}','{$Posicion}','{$Fecha}','{$Lugar}','{$Peso}','{$Altura}', \"Tipo de terreno\".\"id\" FROM \"Estadio\" WHERE \"Tipo de terreno\".\"nombre\" = '{$Nombre}'";

	

	$result = pg_query($dbconn, $query);
 
	header( 'Location: insertar.html');
?>
