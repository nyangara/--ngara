<?php
    require_once 'include/config.php';
    require_once 'include/dbconn/user.php';
    require_once 'include/UIFacade.php';

    require 'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
    <h2>Ligas privadas</h2>
    <div id="box_info" style="height:500px; overflow-y: scroll;">
        <?php
            foreach (UIFacade::ligas() as $l) {
            if ($l['liga']->get('es pública') == 'f') {
        ?>
        <div class="datos">
            <h4><a href="#"><?php echo $l['liga']->get('nombre'); ?></a></h4>
            <p><strong>Creador:</strong> <a href="#"><?php echo $l['usuario']->get('username'); ?></a></p>
            <input name="" type="submit" value="Modificar"/>
            <input name="" type="submit" value="Eliminar"/>
        </div>
        <?php } } ?>
        <a href="liga_privada_insert.php">Crear liga privada</a>
    </div>
</div>
<?php require 'include/post.html'; ?>
