<?php   require 'include/pre.php'; ?>
<h2>Equipos</h2>
<?php   if (has_auth('admin')) { ?>
<form id="form" action="equipo_insert.php" method="post">
  <input type="submit" value="Agregar equipo"/>
</form>
<?php
        }

        foreach (UIFacade::retrieveAll('Equipo') as $e) {
                $img = $e->get('URL del logo') or $img = 'generico.jpg';
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img;
?>
<div>
  <form action="Datos_Eq.php" method="post">
    <input type="hidden" name="id" value="<?php echo $e->get('id'); ?>"/>
    <img src="<?php echo $img; ?>"/>
    <br/>
    <h3>
      <?php echo $e->get('nombre completo'); ?>
      (<?php echo $e->get('siglas'); ?>)
      <input type="submit" value="Detalles"/>
    </h3>
  </form>
</div>
<?php
        }
        require('include/post.html');
?>
