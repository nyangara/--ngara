<?php
        require_once 'include/config.php';
        require_once 'include/dbconn-user.php';
        require_once 'include/model/entity/Equipo.php';
        require_once 'include/model/facade/FacadeEquipo.php';
        require      'include/pre.html';
?>
        <!-- FIXME: se puede poner un link fuera del head?  Creo que no... -->
        <link rel="stylesheet" href="static/styles/style_gestionar_equipos.css"  type="text/css"/>
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
                        <form id="form" action="agregar_equipo.php" method="post">
                                <input type="submit" value="Agregar equipo"/>
                        </form>
                        <h2>Equipos</h2>
<?php foreach (FacadeEquipo::retrieveAll() as $e) { ?>
                        <div class="alcanceEquipo">
                                <form class="Fila" action="Datos_Eq.php" method="post" >
                                        <input type="hidden" name="idequipo" value="<?php echo $e->get("id"); ?>"/>
                                        <input value="Ver equipo" class="imagen" type="image" src="static/images/fotosEquipo/generico.jpg"/>
                                        <div class="datos">
                                                <div>Nombre:           <?php echo $e->get("nombre completo" ); ?></div>
                                                <div>Siglas:           <?php echo $e->get("siglas"          ); ?></div>
                                                <div>Año de fundacion: <?php echo $e->get("año de fundación"); ?></div>
                                        </div>
                                </form>
                        </div>
<?php } ?>
                </div>
        </div>
<?php require('include/post.html'); ?>
