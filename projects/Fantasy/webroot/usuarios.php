<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';
        require      'include/pre.php';
?>
<div id="contenido_interno">
        <h2>Usuarios</h2>
<?php
        foreach (UIFacade::retrieveAll('Usuario') as $u) {
                $img = $u->get('URL del avatar') or $img = 'generico.jpg';
?>
        <div class="alcanceUsuario">
                <form class="Fila" action="Datos_Usr.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $u->get('id'); ?>"/>
                        <img class="imagen" src="static/images/usuario/<?php echo $img; ?>"/>
                        <div class="datos">
                                <div>Usuario: <?php echo $u->get('username'           ); ?></div>
                                <div>Nombre:  <?php echo $u->get('nombre completo'    ); ?></div>
                                <div>E-mail:  <?php echo $u->get('dirección de e-mail'); ?></div>
                        </div>
                </form>
        </div>
<?php   } ?>
</div>
<?php   require('include/post.html'); ?>
