<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';
?>

<?php   function select_opts($name, $range, $now, $format) { ?>
<select name="<?php echo $name; ?>">
<?php   foreach ($range as $i) { 
  $i = sprintf($format, $i);
?>
    <option value="<?php echo $i; ?>"<?php echo ($i == $now) ? ' selected="selected"' : ''; ?>><?php echo $i; ?></option>
<?php } ?>
</select>
<?php } ?>


<?php   function select_objs($name, $objects, $value, $text) { ?>
<select name="<?php echo $name; ?>">
<?php   foreach ($objects as $o) { ?>
    <option value="<?php echo $o->get($value); ?>"><?php echo $o->get($text); ?></option>
<?php } ?>
</select>
<?php } ?>

<?php
        $estadios = UIFacade::retrieveAll('Estadio');

        require 'include/pre.php';
?>

<h2>Agregar equipo</h2>

<div>
<form action="controller" enctype="multipart/form-data" method="post">

<img src="static/images/equipo/generico.jpg" />

<p>Nombre del equipo: </p>
<p><input name="nombre" type="text" value="" /></p>
<p>Siglas: </p>
<p><input name="siglas" type="text" value="" /></p>
<p>Logo: </p>
<p><input name="imagen" type="file" /></p>
<p>Fecha fundación: </p>
<p><?php echo select_opts('day', range(1, 31), date('d'), '%02d'); ?> /
<?php echo select_opts('month', range(1, 12), date('n'), '%02d'); ?> /
<?php $y = date('Y'); echo select_opts('year' , range($y, $y + 3), $y, '%d'); ?></p>
<p>Casa: </p>
<p><?php echo select_objs('estadio', $estadios, 'id', 'nombre'); ?></p>
<p>Precio: </p>
<p><input name="precio" type="text" value="" /></p>

<input type="hidden" name="TIPO" value="Equipo" />
<input type="submit" name="Aplicar" value="Aplicar"  />   
</form>
</div>

<?php   require 'include/post.html'; ?>
