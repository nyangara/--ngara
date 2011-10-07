<?php

	error_reporting( E_ALL );
		include "config.php";

	$Nombre = pg_escape_string (trim($_POST['nombre']));
	$Apellido = pg_escape_string(trim($_POST['apellido']));
	$Numero = trim($_POST['numero']);
	$Tipo = pg_escape_string(trim($_POST['tipo']));
	$Posicion = trim($_POST['posicion']);
	$Fecha = trim($_POST['fecha']);
	$Lugar = pg_escape_string(trim($_POST['lugar']));
	$Peso = trim($_POST['peso']);
	$Altura = trim($_POST['altura']);
	$Equipo = pg_escape_string(trim($_POST['equipo']));

        $query = "INSERT INTO \"jugador\" (\"Nombre_jugador\",\"Apellido_jugador\",\"Nro_jugador\",\"Tipo_jugador\",\"Posición_jugador\",\"Fecha_nacimiento\",\"lugar_nacimiento\",\"peso\" ,\"altura\",\"equipo_id\") SELECT '{$Nombre}', '{$Apellido}','{$Numero}','{$Tipo}','{$Posicion}','{$Fecha}','{$Lugar}','{$Peso}','{$Altura}', \"Equipo\".\"id\" FROM \"Equipo\" WHERE \"Equipo\".\"nombre\" = '{$Equipo}'";

	

	$result = pg_query($dbconn, $query);
 
	header( 'Location: insertar.html');
?>
