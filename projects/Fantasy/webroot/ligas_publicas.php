<?php
        require 'include/pre.php';

        if (has_auth('user')) {
                $admin = has_auth('admin');
                $uid = userdata()->get('id');
?>
<h2>Ligas públicas</h2>
<form action="liga_insert">
  <input type="submit" value="Crear liga"/>
</form>
<?php
                foreach (UIFacade::ligas() as $l) if ($l['liga']->get('es pública') == 't') {
                        if (
                                !$admin &&
                                $l['liga']->get('es pública') == 'f' &&
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
  <h3><a href="#"><?php echo $l['liga']->get('nombre'); ?></a></h3>
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
    <input type="hidden" name="goto" value="ligas"/>
    <button type="submit" name="action" value="liga_remove">Eliminar</button>
  </form>
<?php                   } ?>
</div>
<?php           } ?>
<h2><a href="ligas_privadas">Ver solo ligas privadas</a></h2>
<?php
        }

        require 'include/post.html';
?>
