<?php   require 'include/pre.php'; ?>
<h2>Usuarios</h2>
<?php
        if (has_auth('user')) foreach (UIFacade::retrieveAll('Usuario') as $u) {
                $img = $u->get('URL del avatar') or $img = 'generico.jpg';
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/usuario/' . $img;
?>
<div style="border: 1em">
  <form action="usuario_detail" method="get">
    <input type="hidden" name="id" value="<?php echo $u->get('id'); ?>"/>
    <img src="<?php echo $img; ?>" style="float: left; clear: both"/>
    <p>Usuario: <?php echo $u->get('username'       ); ?></p>
    <p>Nombre:  <?php echo $u->get('nombre completo'); ?></p>
    <p><input type="submit" value="Detalles"/></p>
  </form>
</div>
<?php
        }

        require 'include/post.html';
?>
