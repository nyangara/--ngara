<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Noticias</h2>
<form><input name="" type="text" /> <input name="" type="submit" value="Buscar" /></form>
<?
        foreach (UIFacade::retrieveAll('Contenido') as $c) {
                if ($c->get('tipo') == 'noticia') {
                        $img  = $c->get('URL de imagen');
                        $tags = $c->get('tags'         );
                        $id   = $c->get('id'           );
?>
<div>
<div class="admin-options">
<form method="post" action="controller_contenido_remove">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="contenido_remove" value="Eliminar" />
</form>
<form method="post" action="contenido_update">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="contenido_update" value="Modificar"/>
</form>
</div>
<h3><?php echo $c->get('título'); ?></h3>
<h4><?php echo $c->get('fecha'); ?></h4>
<br />
<?php if ($img) { ?><img src="static/images/noticia/<?php echo $img; ?>"/><?php } ?>
<p><?php echo $c->get('texto'); ?></p>
<?php if ($tags) { ?><p><strong>Etiquetas:</strong> <?php echo $tags; ?></p><?php } ?>
</div>
<?php  }  }  require 'include/post.html';  ?>
