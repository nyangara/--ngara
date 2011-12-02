<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require      'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
        <h2>Mis ligas</h2>
        <div id="box_info" style="overflow-y: scroll;">
<?php   foreach (UIFacade::ligas() as $l) { ?>
                <div class="alcanceLiga">
                        <form class="Fila" action="Datos_Eq.php" method="post" >
                                <input type="hidden" name="id" value="<?php echo $l['liga']->get('id'); ?>"/>
                                <div class="datos">
                                        <h4><?php echo $l['liga']->get('nombre'); ?></div>
                                        <p><strong>Creador:</strong> <?php echo $l['usuario']->get('nombre completo'); ?> (<?php echo $l['usuario']->get('username'); ?>)</p>
                                        <input name="" type="submit" value="Invitar"  />
                                        <input name="" type="submit" value="Modificar"/>
                                        <input name="" type="submit" value="Eliminar" />
                                </div>
                        </form>
                </div>
<?php   } ?>
        </div>
        <div id="links">
                <p>
                        <a href="#">Crear liga pública</a> |
                        <a href="#">Ver todas las ligas públicas</a>
                </p>
                <p>
                        <a href="crear_liga_privada.php">Crear liga privada</a> |
                        <a href="#">Ver todas las ligas privadas</a>
                </p>
        </div>
</div>
<?php   require('include/post.html'); ?>
