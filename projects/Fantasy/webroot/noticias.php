<?php include('include/pre.html'); ?>
        <ul id="navigation">
                <li class="on"><a href="index.php">Inicio     </a></li>
                <li           ><a href="#"        >Jugadores  </a></li>
                <li           ><a href="#"        >Equipos    </a></li>
                <li           ><a href="#"        >Estadios   </a></li>
                <li           ><a href="#"        >Mi Perfil  </a></li>
                <li           ><a href="#"        >Roster     </a></li>
                <li           ><a href="#"        >Ligas      </a></li>
                <li           ><a href="#"        >Calendario </a></li>
                <li           ><a href="#"        >Resultados </a></li>
                <li           ><a href="#"        >Reglas     </a></li>
                <li           ><a href="#"        >Contáctenos</a></li>
        </ul>
</div>
<div id="content">
        <div id="contenido_interno">
                <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                        <!--?php echo date("Y-m-d: H:i:s") . '<br/>'; ?-->
                        <table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">
<?php
        include_once('include/config.php');
        include_once('include/dbconn-user.php');

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
<?php include('include/post.html'); ?>
