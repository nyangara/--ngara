<?php
include_once "config.php";
include_once "dbconn.php";
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
                if ($_GET['equipo'] === $row[0]) echo 'selected ';
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
                                "Juego"."equipo local",
                                "Juego"."equipo visitante",
                                "Juego"."estadio",
				"Juego"."inicio"
                        FROM
                                "Juego", 
				"Equipo"
                        WHERE
                                "Juego"."equipo local" = "Equipo"."nombre"
			AND
				"Equipo"."id" = $1
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
                                        "Juego"."id",
                                        "Juego"."equipo local",
                                        "Juego"."equipo visitante"
                                FROM
                                        "Jugador",
                                        "Juego"
                                WHERE
                                        "Juego"."equipo" = $1
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
                        echo '<p>Juegos:</p>';
                        $query = <<<'EOD'
                                SELECT DISTINCT
                                        "Juego"."id",
                                        "Juego"."equipo local",
                                        "Juego"."equipo visitante",
                                        "Equipo local"."nombre",
                                        "Equipo visitante"."nombre",
					"Juego"."inicio"
                                FROM
                                        "Juego",
					"Equipo" AS "Equipo local",
					"Equipo" AS "Equipo visitante"
				WHERE
					"Juego"."equipo local"     = "Equipo local"."id"     AND
					"Juego"."equipo visitante" = "Equipo visitante"."id"
				ORDER BY 
					"Juego"."inicio"
				DESC
EOD;

                        $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());

                        echo "<table>";
                        while ($row = pg_fetch_row($result)) {
				echo '<tr>';
                                echo '<td><a href="tripleplay.php?a=' . $_GET['a'] . '&v=equipo&id=' . $row[1] . '">' . $row[3] . '</a></td>';
                                echo '<td><a href="tripleplay.php?a=' . $_GET['a'] . '&v=equipo&id=' . $row[2] . '">' . $row[4] . '</a></td>';
                                echo '<td><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '&id=' . $row[0] . '">' . $row[5] . '</a></td>';
				echo '</tr>';
                        }
                        echo "</table>";

                        pg_free_result($result);
                }
        }
        pg_close($dbconn);
?>
