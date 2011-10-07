<?php

	error_reporting( E_ALL );
		include "config.php";

	$Nombre = pg_escape_string (trim($_POST['nombre']));
	$Cantidad = trim($_POST['cantidad']);
	$Manager = pg_escape_string(trim($_POST['manager']));
	$Ffundacion = trim($_POST['ffundacion']);
	$ciudad = pg_escape_string(trim($_POST['ciudad']));
	$estadio = trim($_POST['estadio']);

        $query = "INSERT INTO \"jugador\" (\"Nombre_jugador\",\"Apellido_jugador\",\"Nro_jugador\",\"Tipo_jugador\",\"Posición_jugador\",\"Fecha_nacimiento\",\"lugar_nacimiento\",\"peso\" ,\"altura\",\"equipo_id\") SELECT '{$Nombre}', '{$Apellido}','{$Numero}','{$Tipo}','{$Posicion}','{$Fecha}','{$Lugar}','{$Peso}','{$Altura}', \"Equipo\".\"id\" FROM \"Equipo\" WHERE \"Equipo\".\"nombre\" = '{$Equipo}'";

INSERT INTO "Equipo" ("nombre", "año de fundación", "ciudad", "estado", "estadio principal")
SELECT "Datos"."nombre", "Datos"."año de fundación", "Datos"."ciudad", "Datos"."estado", "Estadio"."id"
FROM
        "Estadio",
        (
                VALUES
                ('Águilas del Zulia'        , 1968, 'Maracaibo'     , 'Zulia'           , 'Luis Aparicio'             ),
                ('Bravos de Margarita'      , 2007, 'Porlamar'      , 'Nueva Esparta'   , 'Nueva Esparta'             ),
                ('Cardenales de Lara'       , 1942, 'Barquisimeto'  , 'Lara'            , 'Antonio Herrera Gutiérrez' ),
                ('Caribes de Anzoátegui'    , 1987, 'Puerto La Cruz', 'Anzoátegui'      , 'Alfonso "Chico" Carrasquel'),
                ('Leones del Caracas'       , 1952, 'Caracas'       , 'Distrito Capital', 'Universitario de Caracas'  ),
                ('Navegantes del Magallanes', 1917, 'Valencia'      , 'Carabobo'        , 'José Bernardo Pérez'       ),
                ('Tiburones de La Guaira'   , 1962, 'La Guaira'     , 'Vargas'          , 'Universitario'             ),
                ('Tigres de Aragua'         , 1965, 'Maracay'       , 'Aragua'          , 'José Pérez Colmenares'     )
        ) as "Datos" ("nombre", "año de fundación", "ciudad", "estado", "nombre del estadio principal")
WHERE "Datos"."nombre del estadio principal" = "Estadio"."nombre";

	

	$result = pg_query($dbconn, $query);
 
	header( 'Location: insertar.html');
?>
