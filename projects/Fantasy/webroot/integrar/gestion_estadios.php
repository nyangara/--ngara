<?php
        require_once("include/model/entity/Estadio.php"      );
        require_once("include/model/facade/FacadeEstadio.php");

        include("static/pre.html");
?>
        <link rel="stylesheet" href="assets/styles/style_gestionar_estadios.css" type="text/css"/>
        <ul id="navigation">
                <li           ><a href="index.php"            >Inicio           </a></li>
                <li           ><a href="gestion_jugadores.php">Jugadores        </a></li>
                <li           ><a href="gestion_equipos.php"  >Equipos          </a></li>
                <li class="on"><a href="gestion_estadios.php" >Estadios         </a></li>
                <li           ><a href="#"                    >Mi perfil        </a></li>
                <li           ><a href="#"                    >Roster           </a></li>
                <li           ><a href="#"                    >Ligas            </a></li>
                <li           ><a href="#"                    >Calendario       </a></li>
                <li           ><a href="#"                    >Resultados       </a></li>
                <li           ><a href="#"                    >Reglas           </a></li>
                <li           ><a href="#"                    >Cont&aacutectenos</a></li>
        </ul>
</div>
<div id="content">
        <div id="contenido_interno">
                <form id="form" action="agregar_es.php" method="post">
                        <input type="submit" value="Agregar Estadio"/>
                </form>
                <h2>Estadios</h2>
<?php
        $es = FachadaEstadio::retrieveAll();
        foreach ($es as $e) {
?>
                <div class="alcanceEstadio">
                        <form class="Fila" action="datos_es.php" method="post">
                                <input type="hidden" name="idestadio" value="<?php echo $e[$i]->get("id"); ?>"/>
                                <input type="image" class="imagen" src="assets/images/fotos_estadios/generico.jpg"/>
                                <div class="datos">
                                        <p>Nombre: <?php echo $e[$i]->get("nombre"); ?></p>
                                        <p>Ciudad: <?php echo $e[$i]->get("ciudad"); ?></p>
                                        <p>Estado: <?php echo $e[$i]->get("estado"); ?></p>
                                </div>
                        </form>
                </div>
<?php
        }

        echo '</div>';
        include("static/post.html");
?>
