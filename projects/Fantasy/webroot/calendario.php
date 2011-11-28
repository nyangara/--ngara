<?php
        require_once 'include/config.php';
        require_once 'include/dbconn-user.php';
        require_once 'include/model/facade/FacadeEquipo.php';
        require_once 'include/model/facade/FacadeEstadio.php';
        require_once 'include/model/facade/FacadeJuego.php';
        require      'include/pre.html';
?>
        <!-- FIXME: se puede poner un link fuera del head?  Creo que no... -->
        <link rel="stylesheet" href="static/styles/style_gestionar_equipos.css"  type="text/css"/>
        <ul id="navigation">
                <li           ><a href="index.php"            >Inicio     </a></li>
                <li           ><a href="gestion_jugadores.php">Jugadores  </a></li>
                <li           ><a href="gestion_equipos.php"  >Equipos    </a></li>
                <li           ><a href="gestion_estadios.php" >Estadios   </a></li>
                <li           ><a href="#"                    >Mi Perfil  </a></li>
                <li           ><a href="#"                    >Roster     </a></li>
                <li           ><a href="#"                    >Ligas      </a></li>
                <li class="on"><a href="calendario.php"       >Calendario </a></li>
                <li           ><a href="#"                    >Resultados </a></li>
                <li           ><a href="#"                    >Reglas     </a></li>
                <li           ><a href="#"                    >Contáctenos</a></li>
        </ul>
</div>
<div id="content">
        <div id="contenido_interno" style="height: auto">
                <div style="height:500px; overflow-y: scroll;">
                <table width="100%" border="0" cellspacing="5" cellpadding="5" align="left" style="color: #cccccc">
                        <tr>
                                <th colspan="4" style="border: 2px solid #cccccc">Calendario</th>
                        </tr>
                        <tr>
                                <th style="border: 2px solid #cccccc">Fecha           </th>
                                <th style="border: 2px solid #cccccc">Equipo local    </th>
                                <th style="border: 2px solid #cccccc">Equipo visitante</th>
                                <th style="border: 2px solid #cccccc">Estadio         </th>
                        </tr>
<?php
        foreach (FacadeJuego::retrieveAll() as $j) {
                $l = FacadeEquipo ::retrieve($j->get('equipo local'    ));
                $v = FacadeEquipo ::retrieve($j->get('equipo visitante'));
                $s = FacadeEstadio::retrieve($j->get('estadio'         ));
                $date = strtotime($j->get('inicio'));
?>
                        <tr>
                                <td style="border: 1px solid #cccccc">
                                        <?php echo date('d/m/Y', $date); ?>
                                        <br/>
                                        <?php echo date('h:i A', $date); ?>
                                </td>
                                <td style="border: 1px solid #cccccc"><?php echo $l->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $v->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $s->get('nombre'); ?></td>
                        </tr>
<?php
        }
?>
                </table>
        </div>
</div>
<?php require('include/post.html'); ?>
