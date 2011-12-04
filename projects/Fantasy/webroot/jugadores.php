<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require      'include/pre.php';
?>
<h2>Jugadores</h2>
<?php
        foreach (UIFacade::jugadores() as $j) {
                $img = $j['jugador']->get('URL de la foto') or $img = 'generico.jpg';
?>
        <div>
        <form class="Fila" action="Datos_J.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $j['jugador']->get('id'); ?>"/>
                  <h3><?php echo $j['jugador']->get('nombre completo'); ?></h3>
                  <br />
                  <img class="imagen" src="static/images/jugador/<?php echo $img; ?>"/>
                  <p><strong>Equipo:</strong>   <?php echo $j['equipo' ]->get('nombre completo'); ?></p>
                  <p><strong>Número:</strong>   <?php echo $j['jugador']->get('número'         ); ?></p>
                  <p><strong>Posición:</strong> <?php echo $j['jugador']->get('posición'       ); ?></p>
                  <p><strong>Precio:</strong>   <?php echo $j['jugador']->get('precio'         ); ?></p>
        </form>
        </div>
<?php   } ?>
<form id="form" action="agregar_jugador.php" method="post">
        <input type="submit" value="Agregar jugador">
</form>
<?php   require('include/post.html'); ?>
