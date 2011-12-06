<?php   require 'include/pre.php'; ?>
<h2>Crear liga</h2>
<form action="controller" method="post">
  <p>Nombre: <input type="text" name="nombre"/></p>
<?php   if (has_auth('admin')) { ?>
  <p>
    Tipo:
    <select name="es pública">
      <option value="t"                    >Pública</option>
      <option value="f" selected="selected">Privada</option>
    </select>
  </p>
<?php   } ?>
  <input type="hidden" name="goto" value="ligas"/>
  <button type="submit" name="action" value="liga_insert">Crear</button>
</form>
<?php   require 'include/post.html'; ?>
