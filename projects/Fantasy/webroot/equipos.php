<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Equipo.php';
        require      'include/pre.php';
?>
<div id="contenido_interno">
        <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                <form id="form" action="agregar_equipo.php" method="post">
                        <input type="submit" value="Agregar equipo"/>
                </form>
                <h2>Equipos</h2>
<?php   foreach (Equipo::retrieveAll() as $e) { ?>
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
<?php   } ?>
        </div>
</div>
<?php   require('include/post.html'); ?>
