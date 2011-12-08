<?php

    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    $id = $_POST['id'];
    unset($_POST);

    $_POST['id']=$id;
    $_POST['TIPO']='Liga';
    $Liga = $instancia->obtener();
    unset($_POST);
    
    $_POST['TIPO']='Participa';
    $Participas = $instancia->obtenerTodos();
    unset($_POST);

    include("Static/head.php");
    include("Static/header.php");

    include("Static/navigation.php");
?>

<div id="content">
    <div id="contenido_interno_datos">
    <h2><?php echo $Liga->nombre ?></h2>
        <div id="box_info">

<?php foreach($Participas as $p) { 
          if($p->liga == $id) {
            
            $_POST['id']  = $p->manager;
            $_POST['TIPO']='Manager';
            $Manager = $instancia->obtener();
            
            $_POST['id']  = $Manager->usuario;
            $_POST['TIPO']='Usuario';
            $Usuario = $instancia->obtener();
            
            $_POST['manager']  = $Manager->id;
            $_POST['TIPO']='Roster';
            $Roster = $instancia->obtener();
?>
    <h3><?php echo $Usuario->username; if ($Usuario->id == $Liga->creador) echo ' - Creador' ?></h3>
    <p>Creditos: <?php echo $Manager->creditos; ?>. 
       Puntaje: <?php echo $Manager->puntaje; ?>.
       Roster: <?php echo $Roster->nombre; ?></p>
<?php     }
      } ?>
      </div>
  </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");	

?>
