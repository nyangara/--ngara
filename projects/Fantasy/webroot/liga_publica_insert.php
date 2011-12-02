<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<div id="contenido_interno">
        <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                <h2>Crear liga privada</h2>
                <form action="controller_liga_insert" method="post">
                        <p>Nombre: <input type="text" name="nombre"/></p>
                        <input type="hidden" name="creador"    value="1"    /><!-- FIXME: tomar de sesión -->
                        <input type="hidden" name="es pública" value="t"    />
                        <input type="submit" name="insertLiga" value="Crear"/>
                </form>
        </div>
</div>
<?php   require('include/post.html'); ?>
