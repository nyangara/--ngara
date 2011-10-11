<?php
        include_once "config.php";
        include_once "dbconn.php";

        $update_fields = array('n', 'f', 'l');

        if (array_key_exists('es', $_POST)) {
                $query = 'DELETE FROM "Jugador" WHERE "id" = $1';
                $result = pg_prepare($dbconn, 'delete_jugador', $query) or die('pg_prepare: ' . pg_last_error());
                foreach ($_POST['es'] as $e) {
                        $result = pg_execute($dbconn, 'delete_jugador', array($e)) or die('pg_execute: ' . pg_last_error());
                }
        }

        if (
                array_key_exists('update'         , $_POST) and
                array_key_exists($update_fields[0], $_POST) and
                array_key_exists($update_fields[1], $_POST) and
                array_key_exists($update_fields[2], $_POST)
        ) {
                $query = 'UPDATE "Jugador" SET ("nombre", "fecha de nacimiento", "lugar de procedencia") = ($1, $2, $3) WHERE "id" = $4';
                $result = pg_prepare($dbconn, 'update_jugador', $query) or die('pg_prepare: ' . pg_last_error());
                $result = pg_execute($dbconn, 'update_jugador', array($_POST[$update_fields[0]], $_POST[$update_fields[1]], $_POST[$update_fields[2]], $_POST['update'])) or die('pg_execute: ' . pg_last_error());

                echo '<p>Se ejecutó la actualización correctamente.</p>';
        }

        if (array_key_exists('id', $_GET) && $_GET['id']) {
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

                $result = pg_prepare($dbconn, "jugador", $query            ) or die('pg_prepare: ' . pg_last_error());
                $result = pg_execute($dbconn, "jugador", array($_GET['id'])) or die('pg_execute: ' . pg_last_error());

                $row = pg_fetch_row($result);
                $n = pg_num_fields($result);

                if ($row) {
?>
<center>
        <h3 style="color:#885411;">Actualizar jugador:</h3>
        <form action="tripleplay.php?a=<?php echo $_GET['a']; ?>&v=<?php echo $_GET['v']; ?>" method="POST">
                <input type="hidden" name="update" value="<?php echo $_GET['id']; ?>"/>

                <table border="0" style="text-align:left;" cellpadding="5px;" >
<?php
                        for ($i = 0; $i < $n; ++$i) {
                                echo '<tr><td>' . mb_ucfirst(pg_field_name($result, $i), 'utf-8') . ':</td><td><input type="text" size="40" name="' . $update_fields[$i] . '" value="' . $row[$i] . '"/></td></tr>';
                        }
?>
                        <tr>
                                <td colspan="2" style="text-align:center;">
                                        <input type="submit" value="ACTUALIZAR" style="font-weight:bold; width:100px; height:30px; color:white; background-color:#885411;">
                                </td>
                        </tr>
                </table>
        </form>
</center>
<?php
                } else {
                        echo '<p>No se encontró un jugador con ese identificador.  Por favor vuelva a la página anterior e intente realizar su acción otra vez.</p>';
                }
                pg_free_result($result);
                echo '<p><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '">Ver todos</a></p>';
        } else {
?>
<form method="GET" action="tripleplay.php">
        <input type="hidden" name="a" value="<?php echo $_GET['a']; ?>"/>
        <input type="hidden" name="v" value="<?php echo $_GET['v']; ?>"/>
        <tr>
                <td>Equipo:</td>
                <td>
                        <select name="equipo">
                                <option value="" <?php array_key_exists('equipo', $_GET) or print('selected'); ?>>Seleccione el equipo</option>
<?php
                $query = 'SELECT "Equipo"."id", "Equipo"."nombre" FROM "Equipo"';
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
                echo '<p>Jugadores:</p>';
                if (array_key_exists('equipo', $_GET) && $_GET['equipo']) $e = $_GET['equipo'];
                else $e = null;
                if ($e) {
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

                        $result = pg_prepare($dbconn, "jugador", $query   ) or die('pg_prepare: ' . pg_last_error());
                        $result = pg_execute($dbconn, "jugador", array($e)) or die('pg_execute: ' . pg_last_error());
                } else {
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
                }
                echo '<form method="POST" action="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . ($e ? '&equipo=' . $e : '') . '">';
                echo '<table>';
                while ($row = pg_fetch_row($result)) {
                        echo '<tr>';
                        echo '<td><input type="checkbox" name="es[]" value="' . $row[0] . '"/></td>';
                        echo '<td><a href="tripleplay.php?a=' . $_GET['a'] . '&v=' . $_GET['v'] . '&id=' . $row[0] . '">' . $row[1] . '</a></td>';
                        echo '</tr>';
                }
                echo '</table>';
                echo '<input type="submit" value="ELIMINAR SELECCIONADOS" style="font-weight:bold; color:white; background-color:#FF5411;"/>';
                echo '</form>';

                pg_free_result($result);
        }
        pg_close($dbconn);
?>
