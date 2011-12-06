<?php   require 'include/pre.php'; ?>
<h2>Usuarios</h2>
<?php
        $u = UIFacade::select('Usuario', array('id' => $_POST['id']));
        $e = $u->get('dirección de e-mail');
        $img = $u->get('URL del avatar') or $img = 'generico.jpg';
        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/usuario/' . $img;
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

<form action="usuarios" method="post">
  <input type="submit" value="Ver todos"/>
</form>
<?php   require 'include/post.html'; ?>
