<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    if(isset($_POST['Aplicar'])) {
        
        $_POST['TIPO'] = 'Liga';
        $instancia->actualizar();

        header('Location: Consultar_Ligas_Propias.php'); 

    }
    
    $id = $_POST['id'];
    $es_publica = $_POST['es_publica'];
    
    if(isset($_POST['Eliminar'])) {
        
        $participa  = $_POST['participa'];
        unset($_POST);
        
        $_POST['id'] = $participa;
        $_POST['TIPO'] = 'Participa';
        $instancia->eliminar();

    }
    
    unset($_POST);
    
    $_POST['id'] = $id;
    $_POST['TIPO'] = 'Liga';
    $liga = $instancia->obtener();
    unset($_POST);
    
    $_POST['TIPO'] = 'Participa';
    $Participas = $instancia->obtenerTodos();
    unset($_POST);
    
    include("Static/head.php");
    include("Static/header.php");
    
    include("Static/navigation.php");
?>

    <div id="content">
    <div id="contenido_interno_datos">
        <h2>Modificar liga <?php echo ($es_publica == 't') ? 'pública' : 'privada'; ?></h2>
        <div id="box_info">
            <form action="Modificar_Liga.php" method="post">
               
                Nombre: <input name="nombre" type="text" value="<?php echo $liga->nombre; ?>" /><br />
                
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="creador" type="hidden" value="<?php echo $liga->creador; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $es_publica; ?>" />
                <input name="Aplicar" type="submit" value="Modificar" />
            </form>
            
            <?php 
              foreach($Participas as $participa) {
                  if ($participa->liga == $id) {
                      $_POST['id'] = $participa->manager;
                      $_POST['TIPO'] = 'Manager';
                      $manager = $instancia->obtener();
                      unset($_POST);
                      
                      $_POST['id'] = $manager->usuario;
                      $_POST['TIPO'] = 'Usuario';
                      $usuario = $instancia->obtener();
                      unset($_POST);
              ?>
              <h3><?php echo $usuario->username; ?></h3>
              <form action="Modificar_Liga.php" method="post">
                <input name="id" type="hidden" value="<?php echo $id; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $es_publica; ?>" />
                <input name="participa" type="hidden" value="<?php echo $participa->id; ?>" />
                <input name="Eliminar" type="submit" value="Eliminar" />
              </form>
              <?php
                    }
                }
              ?>
        </div>
    </div>
        
<?php

include("Static/sideBar.php");
include("Static/footer.php");	

?>
