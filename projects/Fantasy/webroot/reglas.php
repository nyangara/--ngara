<?php   require 'include/pre.php'; ?>
<h2>Reglas</h2>
<form>
        <input name="" type="text"/>
        <input name="" type="submit" value="Buscar"/>
</form>
<?
        foreach (UIFacade::retrieveAll('Contenido') as $c) {
                if ($c->get('tipo') == 'regla') {
                        $id   = $c->get('id'           );
                        $tags = $c->get('tags'         );
                        $img  = $c->get('URL de imagen');
                        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/contenido/' . $img;
?>
<div>
        <div class="admin-options">
                <form method="post" action="controller">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="goto" value="reglas"/>
                        <button type="submit" name="action" value="contenido_remove">Eliminar</button>
                </form>
                <form method="post" action="contenido_update">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" name="contenido_update" value="Modificar"/>
                </form>
        </div>
        <h3><?php echo $c->get('título'); ?></h3>
        <h4><?php echo $c->get('fecha'); ?></h4>
        <br/>
<?php                   if ($img) { ?>
        <img src="<?php echo $img; ?>"/>
<?php                   } ?>
        <?php echo $c->get('texto'); ?>
<?php                   if ($tags) { ?>
        <p><strong>Etiquetas:</strong> <?php echo $tags; ?></p>
<?php                   } ?>
</div>
<?php
                }
        }

        require 'include/post.html';
?>
