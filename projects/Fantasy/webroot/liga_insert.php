<?php   require 'include/pre.php'; ?>
<h2>Crear liga</h2>
<form action="controller_liga_insert" method="post">
  <p>Nombre: <input type="text" name="nombre"/></p>
<?php   if ($user_class == 'admin') { ?>
  <p>
    Tipo:
    <select name="es pública">
      <option value="t"                    >Pública</option>
      <option value="f" selected="selected">Privada</option>
    </select>
  </p>
<?php   } ?>
  <input type="submit" name="insertLiga" value="Crear"/>
</form>
<?php   require 'include/post.html'; ?>
