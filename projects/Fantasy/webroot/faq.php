<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Preguntas frecuentes<h2>
<?
        foreach (UIFacade::retrieveAll('Contenido') as $c) {
                if ($c->get('tipo') == 'pregunta frecuente') {
                        $id   = $c->get('id'           );
                        $tags = $c->get('tags'         );
                        $img  = $c->get('URL de imagen');
                        if (!filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/contenido/' . $img;
?>
<div class="contenido_pregunta">
        <div class="admin">
                <form method="post" action="controller_contenido_remove">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="contenido_remove" value="Eliminar" />
                </form>
                <form method="post" action="contenido_update">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="contenido_update" value="Modificar"/>
                </form>
        </div>
        <?php if ($img) { ?><img src="<?php echo $img; ?>"/><?php } ?>
        <h3><?php echo $c->get('título'); ?></h3>
        <h4><?php echo $c->get('fecha'); ?></h4>
        <?php echo $c->get('texto'); ?>
        <?php if ($tags) { ?><p><small>Tags: <?php echo $tags; ?></small></p><?php } ?>
</div>
<?php
                }
        }

        require 'include/post.html';
?>
