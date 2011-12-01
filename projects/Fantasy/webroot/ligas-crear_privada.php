<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Liga.php';
        require_once 'model/Usuario.php';
?>

<?php 
require_once 'include/Facade.php';
require_once 'include/Entity.php';

$fachada = new Facade();

if (isset($_POST['Crear'])) {
  
  $liga = new Entity();
  $liga->set_all($_POST);
  
  $fachada->insert($liga);

  header('Location: ligas.php');
  
}

unset($_POST);
?>

<?php
        require      'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
  <h2>Crear liga privada</h2>
    <form action="ligas-crear_privada.php" method="post">
    Nombre: <input name="nombre" type="text" />
    <br />
    <input type="hidden" name="creador" value="1" />
    <input type="hidden" name="es pública" value="f" />
    <input type="hidden" name="TIPO" value="Liga" />
    <input type="submit" name="Crear" value="Crear">
  </form>
</div>
<?php require('include/post.html'); ?>
