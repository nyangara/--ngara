<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Baseball</title>
                <link href="style.css" rel="stylesheet" type="text/css" />
        </head>

        <body>
                <div id="logo">
                        <p>This is the logo.</p>
                </div>

                <div id="container">
                        <div id="header">
                                <p>This is the header.</p>
                        </div>
                        <div id="navigation">
                                <p>This is the navigation.</p>
                        </div>
                        <div id="content">
                                <div id="left">
                                        <p>Acciones disponibles:</p>
                                        <ul>
                                                <li>        <a href="agregar-jugadores.php">Agregar jugadores</a>         </li>
                                                <li>        <a href="agregar-juegos.php"   >Agregar juegos   </a>         </li>
                                                <li>        <a href="ver-juegos.php"       >Ver juegos       </a>         </li>
                                                <li><strong><a href="ver-jugadores.php"    >Ver jugadores    </a></strong></li>
                                                <li>        <a href="ver-juegos.php"       >Ver juegos       </a>         </li>
                                                <li>        <a href="ver-equipos.php"      >Ver equipos      </a>         </li>
                                                <li>        <a href="ver-estadios.php"     >Ver estadios     </a>         </li>
                                        </ul>
                                </div>
                                <div id="right">
                                        <p>Jugadores:</p>
<?php
$dbconn = pg_connect("host=localhost dbname=Baseball user=Baseball password=klasd864") or die('Could not connect: ' . pg_last_error());

#$query = 'SELECT * FROM "Jugador", "Equipo" WHERE "Jugador"."equipo" = "Equipo"."id"';
$query = 'SELECT "Jugador"."nombre" AS a, "Jugador"."número" AS b, "Equipo"."nombre" AS c FROM "Jugador", "Equipo" WHERE "Jugador"."equipo" = "Equipo"."id"';
$result = pg_query($query) or die('Query failed: ' . pg_last_error());

echo "<table>\n";
while ($row = pg_fetch_row($result, null, PGSQL_ASSOC)) {
        echo "<tr>\n";
        foreach ($row as $col_value) {
                echo "<td>$col_value</td>\n";
        }
        echo "</tr>\n";
}
echo "</table>\n";

pg_free_result($result);
pg_close($dbconn);
?>

                                </div>
                        </div>
                </div>

                <div id="footer">
                        <p>Un producto de Ñángara, Inc. <img src="images/vendor.png" /></p>
                </div>
        </body>
</html>
