<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Estadios</h2>
<?php
        $show = array(
                'nombre',
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
?>
<div>
        <form class="Fila" action="Datos_Es.php" method="post">
                <input type="hidden" name="id" value="<?php echo $s->get('id'); ?>"/>
                <img class="imagen" src="static/images/estadio/<?php echo $img; ?>"/>
                <div class="datos">
<?php           foreach ($show as $f) if ($s->get($f)) { ?>
                        <div><?php echo mb_ucfirst($f, 'utf-8'); ?>: <?php echo $s->get($f); ?></div>
<?php           } ?>
                </div>
        </form>
</div>
<?php   } ?>
<form id="form" action="Agregar_Es.php" method="post">
        <input type="submit" value="Agregar Estadio">
</form>
<?php   require('include/post.html'); ?>
