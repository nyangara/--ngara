<?php
include_once "Database.php";

function testFunction() {
        $database = Database::getInstance();

/*
        $table = '"Fantasy"."Juego"';

        $columns = array('"inicio"', '"equipo local"', '"equipo visitante"', '"estadio"');

        $values = <<<'EOD'
                SELECT
                        to_timestamp(Data."inicio", 'YYYY/MM/DD HH12:MI AM'),
                        Equipo_local.id,
                        Equipo_visitante.id,
                        Estadio.id
                FROM
                        "Fantasy"."Equipo" AS Equipo_local,
                        "Fantasy"."Equipo" AS Equipo_visitante,
                        "Fantasy"."Estadio" AS Estadio,
                        (VALUES
                                ('2010/11/03 06:30 PM', 'Navegantes', 'Leones', 'Universitario')
                        ) AS Data ("inicio", "equipo_local", "equipo_visitante", "estadio")
                WHERE
                        Data.equipo_local = Equipo_local."nombre corto" AND
                        Data.equipo_visitante = Equipo_visitante."nombre corto" AND
                        Data.estadio = Estadio.nombre;
EOD;

        $r = $database->insert($table, $columns, $values) or die("Error in SQL query: " . pg_last_error());

        $columns = array(
                'juego.inicio',
                'equipo1."nombre corto" AS "equipo local"',
                'equipo2."nombre corto" AS "equipo visitante"',
                'estadio."nombre" AS "estadio"'
        );

        $table = <<<'EOD'
                "Fantasy"."Juego" AS juego
                JOIN "Fantasy"."Equipo" AS equipo1 ON juego."equipo local" = equipo1.id
                JOIN "Fantasy"."Equipo" AS equipo2 ON juego."equipo visitante" = equipo2.id
                JOIN "Fantasy"."Estadio" AS estadio ON juego."estadio" = estadio.id
EOD;

        $s = $database->select($columns, $table, NULL);

        echo count($s, 0) . '<br />';

        $n = count($s, 0);
        $i = 0;

        while ($i < $n) {
                $e = $s[$i];
                $n2 = count($e, 0);
                $j = 0;
                while ($j < $n2) {
                        echo $e[$j] . '<br />';
                        $j += 1;
                }
                $i += 1;
        }
*/

/*
        $equipos = $database->select(array('"nombre corto"'), '"Fantasy"."Equipo"', NULL);

        $n = count($equipos, 0);
        $i = 0;

        while ($i < $n) {
                echo $equipos[$i][0];
                $i += 1;
        }
*/

        $table = '"Fantasy"."Juego"';

        $columns = array('"inicio"', '"equipo local"', '"equipo visitante"', '"estadio"');

        $values = <<<'EOD'
                SELECT
                        to_timestamp(Data."inicio", 'YYYY/MM/DD HH12:MI AM'),
                        Equipo_local.id,
                        Equipo_visitante.id,
                        Estadio.id
                FROM
                        "Fantasy"."Equipo"  AS Equipo_local,
                        "Fantasy"."Equipo"  AS Equipo_visitante,
                        "Fantasy"."Estadio" AS Estadio,
                        (VALUES
                                ('2010/11/03 06:30 PM', 'Navegantes', 'Tigres', 'Universitario')
                        ) AS Data ("inicio", "equipo_local", "equipo_visitante", "estadio")
                WHERE
                        Data.equipo_local = Equipo_local."nombre corto" AND
                        Data.equipo_visitante = Equipo_visitante."nombre corto" AND
                        Data.estadio = Estadio.nombre;
EOD;

        $output = $database->insert($table, $columns, $values) or die("Error in SQL query: " . pg_last_error());

        header('Location: calendario.php');
}

testFunction();
?>
