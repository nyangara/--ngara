<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Liga.php';
        require_once 'model/Usuario.php';
        require      'include/pre.php';
?>
<div id="contenido_interno">
        <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                <h2>Mis ligas</h2>
<?php
        foreach (FacadeLiga::retrieveAll() as $e) {
                $u = new Usuario();
                $u->set('id', $e->get('creador'));
                $u = $u->select();
?>
                <div class="alcanceEquipo">
                        <form class="Fila" action="Datos_Eq.php" method="post" >
                                <input type="hidden" name="idequipo" value="<?php echo $e->get("id"); ?>"/>
                                <input value="Ver equipo" class="imagen" type="image" src="static/images/fotosEquipo/generico.jpg"/>
                                <div class="datos">
                                        <div>Nombre:  <?php echo $e->get("nombre"  ); ?></div>
                                        <div>Creador: <?php echo $u->get("username"); ?></div>
                                </div>
                        </form>
                </div>
<?php } ?>
                <a href="crear_liga_privada.php">Crear liga privada</a>
        </div>
</div>
<?php require('include/post.html'); ?>
