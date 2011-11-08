<?php
        include_once "include/config.php";
        include_once "include/dbconn.php";
?>
<center>
        <h3 style="color:#885411;">Nuevo Jugador</h3>

        <form action="tripleplay.php?a=<?php echo $_GET['a']; ?>&v=<?php echo $_GET['v']; ?>" method="POST" id="insertar_jugador">
                <input type="hidden" name="insert" value="1"/>

                <table border="0" style="text-align:left;" cellpadding="5px;" >
                        <tr>
                                <td>Nombre:</td>
                                <td><input type="text" size="40" name="n" id="nombre"></td>
                        </tr>
                        <tr>
                                <td>Fecha de Nacimiento:</td>
                                <td><input type="text" size="30" name="f" id="fecha de nacimiento"></td>
                        </tr>
                        <tr>
                                <td>Lugar de Nacimiento:</td>
                                <td><input type="text" size="30" name="l" id="lugar de procedencia"></td>
                        </tr>
                        <tr>
                                <td colspan="2" style="text-align:center;">
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
                        "Jugador" ("nombre", "fecha de nacimiento", "lugar de procedencia")
                VALUES
                        ($1, $2, $3)
EOF;

        $result = pg_prepare($dbconn, "jugador", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "jugador", array($_POST['n'],$_POST['f'],$_POST['l'])) or die('pg_execute: ' . pg_last_error());

        pg_free_result($result);
}

pg_close($dbconn);
?>
