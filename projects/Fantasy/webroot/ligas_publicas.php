<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Liga.php';
        require_once 'model/Usuario.php';
        require      'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
  <div style="height:500px; overflow-y: scroll;">
    <h2>Mis ligas</h2>
<?php
        foreach (Liga::retrieveAll() as $l) {
                $u = new Usuario();
                $u->set('id', $l->get('creador'));
                $u = $u->select();
                
                if ($l->get('es pública') == 't') {
?>
    <div>
      <div class="datos">
        <b><?php echo $l->get("nombre"  ); ?> - <?php echo $u->get("username"); ?></b>
        <input name="" type="submit" value="Unirse" /> 
        <input name="" type="submit" value="Modificar" /> 
        <input name="" type="submit" value="Eliminar" />
      </div>
    </div>
<?php } } ?>
    <a href="#">Crear liga pública</a>
  </div>
</div>
<?php require('include/post.html'); ?>
