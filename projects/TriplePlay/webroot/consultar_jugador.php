<?php
include "config.php";
include "dbconn.php";

if ($_GET['id']) {
        $query = <<<'EOD'
                SELECT
                        "Jugador"."nombre",
                        "Jugador"."ciudad",
                        "Jugador"."estado",
                        "Jugador"."año de fundación",
                        "Estadio"."nombre" AS "estadio principal"
                FROM
                        "Equipo",
                        "Estadio"
                WHERE
                        "Estadio"."id" = "Equipo"."estadio principal" AND
                        "Equipo"."id" = $1
EOD;

        $result = pg_prepare($dbconn, "equipo", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "equipo", array($_GET['id'])) or die('pg_execute: ' . pg_last_error());

        $row = pg_fetch_row($result) or die('pg_fetch_row: ' . pg_last_error());

        echo '<ul>';
        $n = pg_num_fields($result);
        for ($i = 1; $i < $n; ++$i) {
                $field = pg_field_name($result, $i);
                if ($field == 'estadio principal') {
                        echo '<li><strong>' . mb_ucfirst($field, 'utf-8') . '</strong>: <a href="tripleplay.php?a=consultar&v=estadio&id=' . $row[0] . '">' . $row[$i] . '</a></li>';
                } else {
                        echo '<li><strong>' . mb_ucfirst($field, 'utf-8') . '</strong>: ' . $row[$i] . '</li>';
                }
        }
        pg_free_result($result);
        echo '</ul>';
        echo '<p><a href="tripleplay.php?a=consultar&v=jugador">Ver todos</a></p>';
} else {
        echo '<p>Equipos:</p>';
        $query = <<<'EOD'
                SELECT
                        "Equipo"."id",
                        "Equipo"."nombre"
                FROM
                        "Equipo"
                ORDER BY
                        "Equipo"."nombre"
EOD;

        $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

        echo "<ul>";
        while ($row = pg_fetch_row($result)) {
                echo '<li><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '&id=' . $row[0] . '">' . $row[1] . '</a></li>';
        }
        echo "</ul>";

        pg_free_result($result);
}
pg_close($dbconn);
?>
