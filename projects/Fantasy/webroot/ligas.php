<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Liga.php';
        require_once 'model/Usuario.php';
        require      'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
  <h2>Mis ligas</h2>
  <div id="box_info" style="overflow-y: scroll;">
<?php
        foreach (Liga::retrieveAll() as $l) {
                $u = new Usuario();
                $u->set('id', $l->get('creador'));
                $u = $u->select();
?>
    <div>
      <div class="liga">
        <h4><?php echo $l->get("nombre"  ); ?></h4>
        <strong>Creador:</strong> <?php echo $u->get("username"); ?><br />
        <input name="" type="submit" value="Invitar" />
        <input name="" type="submit" value="Modificar" />
        <input name="" type="submit" value="Eliminar" />
      </div>
    </div>
<?php } ?>
  </div>
  <div id="links">
    <a href="#">Crear liga pública</a> | <a href="#">Ver todas las ligas públicas</a><br /><br />
    <a href="ligas-crear_privada.php">Crear liga privada</a> | <a href="#">Ver todas las ligas privadas</a>
  </div>

</div>
<?php require('include/post.html'); ?>
