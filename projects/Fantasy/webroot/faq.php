<?php   require 'include/pre.php'; ?>
<h2>Preguntas Frecuentes</h2>
<?php   if (has_auth('admin')) { ?>
<form method="get" action="contenido_insert">
  <button type="submit">Agregar contenido</button>
</form>
<?php   } ?>
<form>
  <input name="" type="text"/>
  <input name="" type="submit" value="Buscar"/>
</form>
<?
        foreach (UIFacade::retrieveAll('Contenido') as $c) {
                if ($c->get('tipo') == 'pregunta frecuente') {
                        $id   = $c->get('id'           );
                        $tags = $c->get('tags'         );
                        $img  = $c->get('URL de imagen');
                        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/contenido/' . $img;
?>
<div>
  <div class="admin-options">
    <form action="controller" method="post">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
      <input type="hidden" name="goto" value="faq"/>
      <button type="submit" name="action" value="contenido_remove">Eliminar</button>
    </form>
    <form action="contenido_update" method="get">
      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
      <button type="submit">Modificar</button>
    </form>
  </div>
  <h3><?php echo $c->get('título'); ?></h3>
  <h4><?php echo $c->get('fecha' ); ?></h4>
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
