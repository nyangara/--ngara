<?php
        require 'include/pre.php';

        function select_opts($name, $range, $now, $format) {
?>
<select name="<?php echo $name; ?>">
<?php
                foreach ($range as $i) {
                        $i = sprintf($format, $i);
?>
  <option value="<?php echo $i; ?>"<?php echo ($i == $now) ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
<?php           } ?>
</select>
<?php
        }

        function select_objs($name, $objects, $value, $text) {
?>
<select name="<?php echo $name; ?>">
<?php           foreach ($objects as $o) { ?>
    <option value="<?php echo $o->get($value); ?>"><?php echo $o->get($text); ?></option>
<?php           } ?>
</select>
<?php
        }

        if (has_auth('admin') && array_key_exists('id', $_GET)) {
                $e = UIFacade::select('Equipo', array('id' => $_GET['id']));
                $img = $e->get('URL del logo');
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img;
?>
<h2>Agregar equipo</h2>
<div>
  <form action="controller" enctype="multipart/form-data" method="post">
    <img src="static/images/equipo/generico.jpg"/>
    <p>Nombre completo:</p>
    <p><input name="nombre completo" type="text" value="<?php echo $e->get('nombre completo'); ?>"/></p>
    <p>Nombre corto:</p>
    <p><input name="nombre corto" type="text" value="<?php echo $e->get('nombre corto'); ?>"/></p>
    <p>Siglas:</p>
    <p><input name="siglas" type="text" value="<?php echo $e->get('siglas'); ?>"/></p>
    <p>Año de fundación: </p>
    <p><input name="año de fundación" type="text" value="<?php echo $e->get('año de fundación'); ?>"/></p>
    <p>Ciudad:</p>
    <p><input name="ciudad" type="text" value="<?php echo $e->get('ciudad'); ?>"/></p>
    <p>Estado:</p>
    <p><input name="estado" type="text" value="<?php echo $e->get('estado'); ?>"/></p>
    <p>Estadio principal:</p>
    <p><?php echo select_objs('estadio principal', UIFacade::retrieveAll('Estadio'), 'id', 'nombre'); ?></p>
    <p>Logo:</p>
    <p><input name="imagen" type="file"/></p>
    <p>Precio: </p>
    <p><input name="precio" type="text" value="<?php echo $e->get('precio'); ?>" /></p>

    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <input type="hidden" name="goto" value="equipos"/>
    <button type="submit" name="action" value="equipo_update">Actualizar</button>
  </form>
</div>
<?php
        }

        require 'include/post.html';
?>
