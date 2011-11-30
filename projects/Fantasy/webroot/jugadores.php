<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Jugador.php';
        require_once 'model/Equipo.php';

        require      'include/pre.php';
?>
<div id="contenido_interno">
        <div id="contenido_interno_jugadores">
                <form id="form" action="agregar_jugador.php" method="post">
                        <input type="submit" value="Agregar jugador">
                </form>
                <h2>Jugadores</h2>
<?php
        foreach (Jugador::retrieveAll() as $j) {
                $e = new Equipo(); $e->set('id', $j->get('equipo')); $e = $e->select();
                $img = $j->get('URL de la foto') or $img = 'generico.jpg';
?>
                <div class="alcanceEquipoJ">
                        <center>
                                <div id="box_jugador">
                                        <form class="Fila" action="Datos_J.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $j->get('id'); ?>"/>
                                                <img class="imagen" src="static/images/jugador/<?php echo $img; ?>"/>
                                                <div class="datos">
                                                        <div>Nombre:   <?php echo $j->get('nombre completo'); ?></div>
                                                        <div>Equipo:   <?php echo $e->get('nombre completo'); ?></div>
                                                        <div>Número:   <?php echo $j->get('número'         ); ?></div>
                                                        <div>Posición: <?php echo $j->get('posición'       ); ?></div>
                                                        <div>Precio:   <?php echo $j->get('precio'         ); ?></div>
                                                </div>
                                        </form>
                                </div>
                        </center>
                </div>
<?php   } ?>
        </div>
</div>
<?php   require('include/post.html'); ?>
