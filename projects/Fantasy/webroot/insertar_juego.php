<?php
        include_once "include/config.php";
        include_once "include/dbconn.php";
?>
<center>
        <h3 style="color:#885411;">Nuevo Juego</h3>

        <form action="tripleplay.php?a=<?php echo $_GET['a']; ?>&v=<?php echo $_GET['v']; ?>" method="POST" id="insertar_juego">
                <input type="hidden" name="insert" value="1"/>
                <table border="0" style="text-align:left;" cellpadding="5px;" >
                <tr>
                        <td>EquipoLocal:</td>
                        <td>
                                <select name="equipolocal" id="equipo local">
                                        <option value="">Seleccione el equipo</option>
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
                        echo 'value="' . $row[0] . '">' . $row[1] . '</option>\n';
                }
                echo "\n";
                pg_free_result($result);
        ?>
                                </select>
                        </td>
                </tr>
                <tr>
                        <td>Equipo visitante:</td>
                        <td>
                                <select name="equipovisitante" id="equipo visitante">
                                        <option value="">Seleccione el equipo</option>
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
                        echo 'value="' . $row[0] . '">' . $row[1] . '</option>\n';
                }
                echo "\n";

                pg_free_result($result);
        ?>
                                </select>
                        </td>
                </tr>
                <tr>
                        <td>Estadio:</td>
                        <td>
                                <select name="estadio" id="estadio">
                                        <option value="">Seleccione el estadio</option>
        <?php
                $query = <<<'EOF'
                        SELECT
                                "Estadio"."id",
                                "Estadio"."nombre"
                        FROM
                                "Estadio"
EOF;

                $result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
                while ($row = pg_fetch_row($result)) {
                        echo '<option ';
                        echo 'value="' . $row[0] . '">' . $row[1] . '</option>\n';
                }
                echo "\n";

                pg_free_result($result);
        ?>
                                </select>
                        </td>
                </tr>

                <tr>
                        <td>Fecha del Partido:</td>
                        <td><input type="text" size="30" name="fechapartido" id="inicio"/></td>
                </tr>

                <tr>
                        <td COLSPAN="2" style="text-align:center;">
                                <input type="submit" value="CREAR" style="font-weight:bold; width:100px; height:30px; color:white; background-color:#885411;">
                        </td>
                </tr>

                </table>
        </form>
</center>

<?php
if (array_key_exists('insert',$_POST) && $_POST['insert']) {
        $query = <<<'EOF'
                INSERT INTO
                        "Juego" ("inicio", "equipo local", "equipo visitante", "estadio")
                VALUES
                        ($1, $2, $3, $4)
EOF;

        $result = pg_prepare($dbconn, "juego", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "juego", array($_POST['fechapartido'],$_POST['equipolocal'],$_POST['equipovisitante'],$_POST['estadio'])) or die('pg_execute: ' . pg_last_error());

        pg_free_result($result);
}

pg_close($dbconn);
?>
