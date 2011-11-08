<?php
include_once "include/config.php";
include_once "include/dbconn.php";
?>
<form method="GET" action="tripleplay.php">
        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>"/>
        <input type="hidden" name="v" value="<?php echo $_GET['v']; ?>"/>
        <tr>
                <td>Equipo:</td>
                <td>
                        <select name="equipo">
                                <option value="" <?php $_GET['equipo'] or print('selected'); ?>>Seleccione el equipo</option>
<?php
        $query = <<<'EOF'
                SELECT
                        "Equipo"."id",
                        "Equipo"."nombre"
                FROM
                        "Equipo"
EOF;

        $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
        while ($row = pg_fetch_row($result)) {
                echo '<option ';
                if (array_key_exists('equipo', $_GET) and $_GET['equipo'] === $row[0]) echo 'selected ';
                echo 'value="' . $row[0] . '">' . $row[1] . '</option>\n';
        }

        pg_free_result($result);
?>
                        </select>
                </td>
        </tr>
        <tr>
                <td COLSPAN="2" style="text-align:center;">
                        <input type="submit" value="BUSCAR" style="font-weight:bold; width:100px; height:30px; color:white; background-color:#885411;">
                </td>
        </tr>
</form>
<?php
        if ($_GET['id']) {
                $query = <<<'EOD'
                        SELECT
                                "Jugador"."nombre",
                                "Jugador"."fecha de nacimiento",
                                "Jugador"."lugar de procedencia"
                        FROM
                                "Jugador"
                        WHERE
                                "Jugador"."id" = $1
EOD;

                $result = pg_prepare($dbconn, "jugador", $query) or die('pg_prepare: ' . pg_last_error());
                $result = pg_execute($dbconn, "jugador", array($_GET['id'])) or die('pg_execute: ' . pg_last_error());

                $row = pg_fetch_row($result) or die('pg_fetch_row: ' . pg_last_error());

                echo '<ul>';
                $n = pg_num_fields($result);
                for ($i = 0; $i < $n; ++$i) {
                        $field = pg_field_name($result, $i);
                        echo '<li><strong>' . mb_ucfirst($field, 'utf-8') . '</strong>: ' . $row[$i] . '</li>';
                }
                pg_free_result($result);
                echo '</ul>';
                echo '<p><a href="tripleplay.php?a=consultar&v=jugador">Ver todos</a></p>';
        } else {
                if($_GET['equipo']) {
                        echo '<p>Jugadores:</p>';
                        $query = <<<'EOD'
                                SELECT DISTINCT
                                        "Jugador"."id",
                                        "Jugador"."nombre"
                                FROM
                                        "Jugador",
                                        "Juega"
                                WHERE
                                        "Jugador"."id" = "Juega"."jugador" AND
                                        "Juega"."equipo" = $1
                                ORDER BY
                                        "Jugador"."nombre"
EOD;

                        $result = pg_prepare($dbconn, "jugador", $query) or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, "jugador", array($_GET['equipo'])) or die('pg_execute: ' . pg_last_error());

                        echo "<ul>";
                        while ($row = pg_fetch_row($result)) {
                                echo '<li><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '&id=' . $row[0] . '">' . $row[1] . '</a></li>';
                        }
                        echo "</ul>";

                        pg_free_result($result);
                } else {
                        echo '<p>Jugadores:</p>';
                        $query = <<<'EOD'
                                SELECT
                                        "Jugador"."id",
                                        "Jugador"."nombre"
                                FROM
                                        "Jugador"
                                ORDER BY
                                        "Jugador"."nombre"
EOD;

                        $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

                        echo "<ul>";
                        while ($row = pg_fetch_row($result)) {
                                echo '<li><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '&id=' . $row[0] . '">' . $row[1] . '</a></li>';
                        }
                        echo "</ul>";

                        pg_free_result($result);
                }
        }
        pg_close($dbconn);
?>
