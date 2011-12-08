<?php
        require 'include/pre.php';

        if (has_auth('user') and array_key_exists('id', $_POST)) {
                $l = UIFacade::select('Liga', array('id' => $_POST['id']));
                if (has_auth('admin') || $l->get('creador') == userdata()->get('id')) {
                        $s = ' selected="selected"';
                        $p = ($l->get('es pública') == 't');
?>
<h2>Modificar liga</h2>
<form action="controller" method="post">
  <p>Nombre: <input type="text" name="nombre" value="<?php echo $l->get('nombre'); ?>"/></p>
<?php                   if (has_auth('admin')) { ?>
  <p>
    Tipo:
    <select name="es pública">
      <option value="t"<?php if ( $p) echo $s; ?>>Pública</option>
      <option value="f"<?php if (!$p) echo $s; ?>>Privada</option>
    </select>
  </p>
<?php                   } ?>
  <input type="hidden" name="goto" value="ligas"/>
  <input type="hidden" name="id" value="<?php echo $l->get('id'); ?>"/>
  <button type="submit" name="action" value="liga_update">Actualizar</button>
</form>
<?php
                }
        }

        require 'include/post.html';
?>
