<?php require('include/pre.html'); ?>
        <link rel="stylesheet" href="assets/styles/style_gestionar_equipos.css"  type="text/css"/> <!-- TODO: se puede poner un link fuera del head?  creo que no... -->
        <ul id="navigation">
                <li           ><a href="index.php"            >Inicio     </a></li>
                <li           ><a href="gestion_jugadores.php">Jugadores  </a></li>
                <li class="on"><a href="gestion_equipos.php"  >Equipos    </a></li>
                <li           ><a href="gestion_estadios.php" >Estadios   </a></li>
                <li           ><a href="#"                    >Mi Perfil  </a></li>
                <li           ><a href="#"                    >Roster     </a></li>
                <li           ><a href="#"                    >Ligas      </a></li>
                <li           ><a href="#"                    >Calendario </a></li>
                <li           ><a href="#"                    >Resultados </a></li>
                <li           ><a href="#"                    >Reglas     </a></li>
                <li           ><a href="#"                    >Contáctenos</a></li>
        </ul>
</div>
<div id="content">
        <div id="contenido_interno">
                <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                        <!--?php echo date("Y-m-d: H:i:s") . '<br/>'; ?-->
<form id="form" action="agregar_equipo.php" method="post">
        <input type="submit" value="Agregar equipo"/>
</form>
                        <table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">
<?php
        require_once("include/classes/Jugador.php");
        require_once("include/classes/Equipo.php");
        require_once("include/classes/EquipoFachada.php");

        require_once('include/config.php');
        require_once('include/dbconn-user.php');

        echo '<h2>Equipos</h2>';

        $query = <<<'EOD'
                SELECT
                        "URL de imagen",
                        "título",
                        "contenido",
                        "fecha"
                FROM
                        "Fantasy"."Noticia"
                WHERE
                        "fecha" <= $1
                OR
                        "fecha" >= $2
                ORDER BY
                        "fecha" DESC
EOD;

        $result = pg_prepare($dbconn, "noticia", $query) or die('pg_prepare: ' . pg_last_error());
        $result = pg_execute($dbconn, "noticia", array(date('Y-m-d'), date('Y-m-d', strtotime("-2 days")))) or die('pg_execute: ' . pg_last_error());

        while ($row = pg_fetch_row($result)) {
                echo '<tr><td><img src="' . $row[0] . '"></img><td>';
                echo '<td width="50px"><h3 >' . $row[1] . '</h3><p>' . $row[2] . '</p>';
                echo '<p><small>' . $row[3] . '</small></p></td></tr>';
        }

        pg_free_result($result);
?>
                        </table>
                </div>
        </div>
<?php require('include/post.html'); ?>
