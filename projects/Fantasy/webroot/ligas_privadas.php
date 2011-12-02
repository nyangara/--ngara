<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
        <div style="height:500px; overflow-y: scroll;">
                <h2>Mis ligas</h2>
<?php
        foreach (UIFacade::ligas() as $l) {
                if ($l['liga']->get('es pública') == 'f') {
?>
                <div>
                        <div class="datos">
                                <b><?php echo $l['liga']->get('nombre'); ?> - <?php echo $l['usuario']->get('username'); ?></b>
                                <input name="" type="submit" value="Modificar"/>
                                <input name="" type="submit" value="Eliminar"/>
                        </div>
                </div>
<?php
                }
        }
?>
                <a href="#">Crear liga privada</a>
        </div>
</div>
<?php   require 'include/post.html'; ?>
