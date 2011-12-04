<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Estadios</h2>
<?php
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
?>
<div>
        <form action="Datos_Es.php" method="post">
                <input name="id" type="hidden" value="<?php echo $s->get('id'); ?>"/>
                <h3><?php echo $s->get('nombre'); ?></h3>
                <br />
                <img src="static/images/estadio/<?php echo $img; ?>"/>
<?php           foreach ($show as $f) if ($s->get($f)) { ?>
                        <p><strong><?php echo mb_ucfirst($f, 'utf-8'); ?>:</strong> <?php echo $s->get($f); ?></p>
<?php           } ?>
        </form>
</div>
<?php   } ?>
<form id="form" action="Agregar_Es.php" method="post">
        <input type="submit" value="Agregar Estadio">
</form>
<?php   require('include/post.html'); ?>
