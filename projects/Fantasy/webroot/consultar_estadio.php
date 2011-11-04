<?php
include_once "config.php";
include_once "dbconn.php";

if ($_GET['id']) {
        $query = <<<'EOD'
                SELECT
                        "Estadio"."nombre",
                        "Estadio"."ciudad",
                        "Estadio"."estado",
                        "Estadio"."capacidad",
                        "Estadio"."año de fundación",
                        "Tipo de terreno"."nombre" AS "tipo de terreno"
                FROM
                        "Estadio",
                        "Tipo de terreno"
                WHERE
                        "Estadio"."tipo de terreno" = "Tipo de terreno"."id" AND
                        "Estadio"."id" = $1
EOD;

        $result = pg_prepare($dbconn, "estadio", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "estadio", array($_GET['id'])) or die('pg_execute: ' . pg_last_error());

        $row = pg_fetch_row($result) or die('pg_fetch_row: ' . pg_last_error());

        echo '<ul>';
        $n = pg_num_fields($result);
        for ($i = 0; $i < $n; ++$i) {
                echo '<li><strong>' . mb_ucfirst(pg_field_name($result, $i), 'utf-8') . '</strong>: ' . $row[$i] . '</li>';
        }
        pg_free_result($result);
        echo '</ul>';
        echo '<p><a href="tripleplay.php?a=consultar&v=estadio">Ver todos</a></p>';
} else {
        echo '<p>Estadios:</p>';
        $query = <<<'EOD'
                SELECT
                        "Estadio"."id",
                        "Estadio"."nombre"
                FROM
                        "Estadio"
                ORDER BY
                        "Estadio"."nombre"
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
