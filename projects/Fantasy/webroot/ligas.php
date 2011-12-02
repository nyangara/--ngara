<?php
    require_once 'include/config.php';
    require_once 'include/dbconn/user.php';
    require_once 'include/UIFacade.php';

    require      'include/pre.php';
?>
<h2>Mis ligas</h2>
<?php foreach (UIFacade::ligas() as $l) { ?>
<div>
    <h4><a href="#"><?php echo $l['liga']->get('nombre'); ?></a></h4>
    <p><strong>Creador:</strong> <a href="#"><?php echo $l['usuario']->get('username'); ?></a></p>
    <form action="Datos_Eq.php" method="post" >
    <input name="id" type="hidden" value="<?php echo $l['liga']->get('id'); ?>"/>
    <input name="" type="submit" value="Invitar"  />
    <input name="" type="submit" value="Modificar"/>
    <input name="" type="submit" value="Eliminar" />
    </form>
</div>
<?php } ?>
<p>
    <a href="liga_publica_insert.php">Crear liga pública</a> | 
    <a href="ligas_publicas.php">Ver todas las ligas públicas</a>
</p>
<p>
    <a href="liga_privada_insert.php">Crear liga privada</a> |
    <a href="ligas_privadas.php">Ver todas las ligas privadas</a>
</p>
<?php   require('include/post.html'); ?>
