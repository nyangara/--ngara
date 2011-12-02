<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';
        require      'include/pre.php';
?>
<h2>Equipos</h2>
<?php
    foreach (UIFacade::retrieveAll('Equipo') as $e) {
        $img = $e->get('URL del logo') or $img = 'generico.jpg';
?>
<div>
    <form class="Fila" action="Datos_Eq.php" method="post">
    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <img class="imagen" src="static/images/equipo/<?php echo $img; ?>"/>
    <div class="datos">
        <div>Nombre:           <?php echo $e->get('nombre completo' ); ?></div>
        <div>Siglas:           <?php echo $e->get('siglas'          ); ?></div>
        <div>Año de fundacion: <?php echo $e->get('año de fundación'); ?></div>
    </div>
    </form>
</div>
<?php } ?>
<form id="form" action="agregar_equipo.php" method="post">
    <input type="submit" value="Agregar equipo"/>
</form>
<?php   require('include/post.html'); ?>
