<?php   require 'include/pre.php'; ?>
<h2>Equipos</h2>
<?php   if (has_auth('admin')) { ?>
<form id="form" action="equipo_insert.php" method="get">
  <button type="submit">Agregar equipo</button>
</form>
<?php
        }

        foreach (UIFacade::retrieveAll('Equipo') as $e) {
                $img = $e->get('URL del logo') or $img = 'generico.jpg';
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img;
?>
<div>
  <img src="<?php echo $img; ?>"/>
  <br/>
  <h3>
    <?php echo $e->get('nombre completo'); ?> (<?php echo $e->get('siglas'); ?>)
  </h3>
  <br/>
  <form action="equipo_details" method="get">
    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <button type="submit" style="width: 5em">Detalles</button>
  </form>
<?php           if (has_auth('admin')) { ?>
  <form action="equipo_update" method="get">
    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <button type="submit" style="width: 5em">Modificar</button>
  </form>
  <form action="equipo_remove" method="get">
    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <button type="submit" style="width: 5em">Eliminar</button>
  </form>
<?php           } ?>
</div>
<?php
        }

        require 'include/post.html';
?>
