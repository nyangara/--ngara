<?php
include "config.php";

$Fecha   = pg_escape_string(trim($_POST['fecha'  ]));
$Hora    = pg_escape_string(trim($_POST['hora'   ]));
$Equipo1 = pg_escape_string(trim($_POST['equipo1']));
$Equipo2 = pg_escape_string(trim($_POST['equipo2']));
$Estadio = pg_escape_string(trim($_POST['estadio']));

$query = "SELECT * FROM JUEGA";
/*
        $query = "INSERT INTO \"Juega\" (\"Fecha\",\"Hora_de_inicio\",\"equipo1_id\",\"\",\"equipo2_id\",\"estadio_id\", SELECT '{$Nombre}', '{$Apellido}','{$Numero}','{$Tipo}','{$Posicion}','{$Fecha}','{$Lugar}','{$Peso}','{$Altura}', \"Equipo\".\"id\" FROM \"Equipo\" WHERE \"Equipo\".\"nombre\" = '{$Equipo}'";
 */

$result = pg_query($dbconn, $query);

header( 'Location: insertar.html');
?>
