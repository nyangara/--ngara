<?php
include("config.php");

$nombre        = pg_escape_string(trim($_POST['nombre'   ]));
$ciudad        = pg_escape_string(trim($_POST['ciudad'   ]));
$estado        = pg_escape_string(trim($_POST['estado'   ]));
$capacidad     =                  trim($_POST['capacidad']) ;
$tipoDeTerreno = pg_escape_string(trim($_POST['terreno'  ]));
$fundacion     = pg_escape_string(trim($_POST['fundacion']));

$query = <<<EOF
INSERT INTO "Estadio" ("nombre", "ciudad", "estado", "capacidad", "tipo de terreno", "año de fundación")
SELECT "Datos"."nombre", "Datos"."ciudad", "Datos"."estado", "Datos"."capacidad", "Tipo de terreno"."id", "Datos"."año de fundación"
FROM
        "Tipo de terreno",
        (
                VALUES ('{$nombre}', '{$ciudad}', '{$estado}', {$capacidad}, '{$tipoDeTerreno}', {$fundacion})
        ) as "Datos" ("nombre", "ciudad", "estado", "capacidad", "tipo de terreno", "año de fundación")
WHERE "Datos"."tipo de terreno" = "Tipo de terreno"."nombre";
EOF;

$result = pg_query($dbconn, $query) or die('Query 1 failed: ' . pg_last_error() . "\n$query\n$nombre\n$ciudad\n$estado\n$capacidad\n$tipoDeTerreno\n$fundacion\n");

header('Location: insertar.html');
?>
