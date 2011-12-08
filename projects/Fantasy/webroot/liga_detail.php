<?php
        require 'include/pre.php';

        if (has_auth('user') and array_key_exists('id', $_GET)) {
                $d = UIFacade::liga_detail($_GET['id']);
                $uid = userdata()->get('id');

                $see = $d['liga']->get('es pública') || has_auth('admin');
                if (!$see) foreach ($d['participantes'] as $p) {
                        if ($p->get('id') == $uid) {
                                $see = true;
                                break;
                        }
                }

                if ($see) {
                        $own = has_auth('admin') || ($d['creador']->get('id') == $uid);
                        $c_img = $d['creador']->get('URL del avatar') or $c_img = 'generico.jpg';
                        if ($c_img and !filter_var($c_img, FILTER_VALIDATE_URL)) $c_img = 'static/images/usuario/' . $c_img;
?>
<h2>Liga <?php echo ($d['liga']->get('es pública') == 't' ? 'pública ' : 'privada ') . $d['liga']->get('nombre'); ?></h2>
<div style="border: 1em">
  <img src="<?php echo $c_img; ?>" style="float: left; clear: both"/>
  <p>Creador: <?php echo $d['creador']->get('nombre completo'); ?> (<?php echo $d['creador']->get('username'); ?>)</p>
  <form action="usuario_detail" method="get">
    <input type="hidden" name="id" value="<?php echo $d['creador']->get('id'); ?>"/>
    <p><button type="submit">Detalles</button></p>
  </form>
</div>
<hr style="clear: both"/>
<h3>Miembros:</h3>
<?php
                        foreach ($d['participantes'] as $u) {
                                $img = $u->get('URL del avatar') or $img = 'generico.jpg';
                                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/usuario/' . $img;
?>
<div style="border: 1em">
  <img src="<?php echo $img; ?>" style="float: left; clear: both"/>
  <p>Usuario: <?php echo $u->get('username'       ); ?></p>
  <p>Nombre:  <?php echo $u->get('nombre completo'); ?></p>
  <form action="usuario_detail" method="get">
    <input type="hidden" name="id" value="<?php echo $u->get('id'); ?>"/>
    <p><button type="submit" style="width: 5em">Detalles</button></p>
  </form>
<?php                           if ($own) { ?>
  <form action="controller" method="post">
    <input type="hidden" name="usuario" value="<?php echo $u->get('id'); ?>"/>
    <input type="hidden" name="liga"    value="<?php echo $d['liga']->get('id'); ?>"/>
    <input type="hidden" name="goto"    value="ligas"/>
    <p><button type="submit" name="action" value="participa_remove" style="width: 5em">Expulsar</button></p>
  </form>
<?php                           } ?>
</div>
<?php
                        }
                }
        }

        require 'include/post.html';
?>
