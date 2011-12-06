<?php   require 'include/pre.php'; ?>
<h2>Estadios</h2>
<?php   if (has_auth('admin')) { ?>
<form action="estadio_insert" method="post">
  <input type="submit" value="Agregar Estadio"/>
</form>
<?php
        }

        $show = array(
                'ciudad',
                'estado',
                'capacidad',
                'año de fundación',
                'tipo de terreno',
                'propietario',
                'medida del left field',
                'medida del center field',
                'medida del right field',
                'descripción'
        );

        foreach (UIFacade::retrieveAll('Estadio') as $s) {
                $img = $s->get('URL de la foto') or $img = 'generico.jpg';
                if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/estadio/' . $img;
?>
<div>
  <h3><?php echo $s->get('nombre'); ?></h3>
  <br/>
  <img src="<?php echo $img; ?>"/>
<?php           foreach ($show as $f) if ($s->get($f)) { ?>
  <p><strong><?php echo mb_ucfirst($f, 'utf-8'); ?>:</strong> <?php echo $s->get($f); ?></p>
<?php           } ?>
</div>
<?php
        }

        require 'include/post.html';
?>
