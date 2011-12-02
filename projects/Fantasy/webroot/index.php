<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>¿Qué es una liga de fantasía?</h2>
<br/>
<h2>Acceder</h2>
<form action="#">
        <p>Nombre de usuario: <input type="text"     name="username" value=""/></p>
        <p>Contraseña:        <input type="password" name="password" value=""/></p>
        <p><input name="Login" type="submit" value="Acceder"/></p>
</form>
<br/>
<h2>¿Eres nuevo? Regístrate</h2>
<form action="#">
        <p>Nombre            <input type="text"     name="username" value=""/></p>
        <p>Apellido          <input type="text"     name="username" value=""/></p>
        <p>E-mail            <input type="text"     name="username" value=""/></p>
        <p>Nombre de usuario <input type="text"     name="username" value=""/></p>
        <p>Contraseña        <input type="password" name="password" value=""/></p>
        <p><input type="submit" name="Register" value="Regístrate"/></p>
</form>
<?php   require('include/post.html'); ?>
