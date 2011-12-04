<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Ligas privadas</h2>
<?php
        foreach (UIFacade::ligas() as $l) {
                if ($l['liga']->get('es pública') == 'f') {
?>
<div>
        <h3><a href="#"><?php echo $l['liga']->get('nombre'); ?></a></h3>
        <p><strong>Creador:</strong> <a href="#"><?php echo $l['usuario']->get('username'); ?></a></p>
        <input name="" type="submit" value="Modificar"/>
        <input name="" type="submit" value="Eliminar"/>
</div>
<?php
                }
        }
?>
<form action="liga_privada_insert.php">
        <input type="submit" name="" value="Crear liga privada"/>
</form>
<?php   require 'include/post.html'; ?>
