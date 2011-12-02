<?php
    require_once 'include/config.php';
    require_once 'include/dbconn/user.php';
    require_once 'include/UIFacade.php';

    require      'include/pre.php';
?>
<h2>¿Qué es una liga de fantasía?</h2>
<br />
<h2>Acceder</h2>
<form action="#">
    <p>Nombre de usuario: <input name="username" type="text" value=""/></p>
    <p>Contraseña: <input name="password" type="password" value=""/></p>
    <p><input name="Login" type="submit" value="Acceder"/></p>
</form>
<br />
<h2>¿Eres nuevo? Regístrate</h2>
<form action="#">
    <p>Nombre: <input name="username" type="text" value=""/></p>
    <p>Apellido: <input name="username" type="text" value=""/></p>
    <p>E-mail: <input name="username" type="text" value=""/></p>
    <p>Nombre de usuario: <input name="username" type="text" value=""/></p>
    <p>Contraseña: <input name="password" type="password" value=""/></p>
    <p><input name="Register" type="submit" value="Regístrate"/></p>
</form>
<?php   require('include/post.html'); ?>
