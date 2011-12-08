<?php
        require 'include/pre.php';

        if (has_auth('user')) {
                $admin = has_auth('admin');
                $uid = userdata()->get('id');
?>
<h2>Ligas</h2>
<p>Ver <a href="ligas">todas</a> | públicas | <a href="ligas_privadas">privadas</a></p>
<form action="liga_insert">
  <button type="submit">Crear liga</button>
</form>
<?php
                foreach (UIFacade::ligas() as $l) if ($l['liga']->get('es pública') == 't') {
                        if (
                                !$admin &&
                                $l['liga']->get('es pública') == 'f' &&
                                $uid != $l['creador']->get('id') &&
                                !in_array(
                                        $uid,
                                        array_map(
                                                function ($p) { return $p->get('id'); },
                                                $l['participantes']
                                        )
                                )
                        ) continue;
                        $id  = $l['liga'   ]->get('id'            );
                        $img = $l['creador']->get('URL de la foto');
                        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/usuario/' . $img;
?>
<div>
  <h3><?php echo $l['liga']->get('nombre'); ?></h3>
  <img class="imagen" src="<?php echo $img; ?>"/>
  <p><strong>Creador:</strong> <a href="#"><?php echo $l['creador']->get('username'); ?></a></p>
  <form action="liga_detail" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <button type="submit" name="action" value="liga_detail">Ver</button>
  </form>
<?php                   if ($admin || ($l['liga']->get('creador') == $uid)) { ?>
  <form action="liga_update" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <button type="submit" name="action" value="liga_update">Modificar</button>
  </form>
  <form action="controller" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="hidden" name="goto" value="ligas_publicas"/>
    <button type="submit" name="action" value="liga_remove">Eliminar</button>
  </form>
<?php                   } ?>
</div>
<?php           } ?>
<?php
        }

        require 'include/post.html';
?>
