<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Preguntas Frecuentes<h2>
<?
        foreach (UIFacade::retrieveAll('Contenido') as $c) {
                if ($c->get('tipo') == 'regla') {
                        $img  = $c->get('URL de imagen');
                        $tags = $c->get('tags'         );
                        $id   = $c->get('id'           );
?>
<div class="contenido_reglas">
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
        <?php if ($img) { ?><img src="static/images/regla/<?php echo $img; ?>"/><?php } ?>
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
