<?php   require 'include/pre.php'; ?>
<h2>Usuarios</h2>
<?php
        $id = $_POST['id'];
        $u = UIFacade::select('Usuario', array('id' => $id));
        $e = $u->get('dirección de e-mail');
        $img = $u->get('URL del avatar') or $img = 'generico.jpg';
        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/usuario/' . $img;
        $ls = UIFacade::usuario_ligas_invitables($id);
?>
<img src="<?php echo $img; ?>"/>
<p>Nombre de usuario:   <?php echo $u->get('username'           ); ?></p>
<p>Nombre completo:     <?php echo $u->get('nombre completo'    ); ?></p>

<?php   if ($u->get('género')) { ?>
<p>Género:              <?php echo $u->get('género'             ); ?></p>
<?php   } ?>

<?php   if ($u->get('fecha de nacimiento')) { ?>
<p>Fecha de nacimiento: <?php echo $u->get('fecha de nacimiento'); ?></p>
<?php   } ?>

<p>Dirección de e-mail: <a href="mailto:<?php echo $e; ?>"><?php echo $e; ?></a></p>

<?php   if ($u->get('puntaje')) { ?>
<p>Puntaje:             <?php echo $u->get('puntaje'            ); ?></p>
<?php   } ?>

<?php   if ($u->get('es administrador')) { ?>
<p>Es administrador.</p>
<?php   } ?>

<?php   if (!empty($ls)) { ?>
<form action="controller" method="post">
  <p>
    Invitar a liga:
    <select name="liga">
<?php           foreach ($ls as $l) {
?>
      <option value="<?php echo $l['liga']->get('id'); ?>"><?php echo $l['liga']->get('nombre'); ?></option>
<?php           } ?>
    </select>
    <input type="hidden" name="usuario" value="<?php echo $id; ?>"/>
    <input type="hidden" name="goto" value="ligas"/>
    <button type="submit" name="action" value="participa_insert">Invitar</button>
  </p>
</form>
<?php   } ?>

<form action="usuarios" method="post">
  <input type="submit" value="Ver todos"/>
</form>
<?php   require 'include/post.html'; ?>
