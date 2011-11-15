<?php
        require_once("clases/estadio.php"        );
        require_once("clases/estadio_fachade.php");

        include("static/head.php"  );
        include("static/header.php");
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
<?
        $FachadaEstadio = new EstadioFachade;
        $Estadios = $FachadaEstadio->getAllEstadio();

        $N = count($Estadios);

        for($i = 0; $i < $N; $i++) {
?>
                <div class="alcanceEstadio">
                        <form class="Fila" action="datos_es.php" method="post">
                                <input type="hidden" name="idestadio" value="<? echo $Estadios[$i]->getId(); ?>"/>
                                <input type="image" class="imagen" src="assets/images/fotos_estadios/generico.jpg"/>
                                <div class="datos">
                                        <div>Nombre:      <? echo $Estadios[$i]->getnombre()     ; ?></div>
                                        <div>Ubicacion:   <? echo $Estadios[$i]->getubicacion()  ; ?></div>
                                        <div>Propietario: <? echo $Estadios[$i]->getpropietario(); ?></div>
                                </div>
                        </form>
                </div>
<?
        }

        echo '</div>';
        include("static/side_bar.php");
        include("static/footer.php");
?>
