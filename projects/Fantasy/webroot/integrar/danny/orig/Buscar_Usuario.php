<?php

    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    
    if(isset($_POST['Invitar'])) {
        
        $_POST['TIPO'] = 'Participa';
        $instancia->insertar();

        header('Location: Consultar_Ligas_Propias.php'); 

    }
    
    $palabra = $_POST['palabra'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    unset($_POST);
    
    $_POST['TIPO'] ='Usuario';
    $Usuarios = $instancia->obtenerTodos();
    unset($_POST);
    
    $_POST['TIPO'] ='Participa';
    $Participas = $instancia->obtenerTodos();
    unset($_POST);
    
    $Participantes = array();
    
    foreach ($Participas as $participa) {
      if ($participa->liga == $id)
        $Participantes[] = $participa->manager;
    }

    include("Static/head.php");
    include("Static/header.php");

    include("Static/navigation.php");
?>

<div id="content">
    <div id="contenido_interno_datos">
    <h2>Invitar a <?php echo $nombre; ?></h2>
        <div id="box_info">

            <?php 
                foreach($Usuarios as $usuario) {
                    $_POST['usuario'] = $usuario->usuario;
                    $_POST['TIPO'] = 'Perfil_Usuario';
                    $perfil = $instancia->obtener();
                    unset($_POST);
                    
                    $_POST['usuario'] = $usuario->id;
                    $_POST['TIPO'] = 'Manager';
                    $manager = $instancia->obtener();
                    unset($_POST);
                    
                    if (
                      ((stripos($usuario->username, $palabra) !== FALSE) ||
                      (stripos($perfil->nombres, $palabra) !== FALSE) ||
                      (stripos($perfil->apellidos, $palabra) !== FALSE) ||
                      (stripos($perfil->email, $palabra) !== FALSE)) &&
                      !in_array($manager->id, $Participantes)
                    ) {
                      
                      $_POST['usuario']=$usuario->id;
                      $_POST['TIPO']='Manager';
                      $manager = $instancia->obtener();
                      unset($_POST);
            ?>
                      <h3><?php echo $usuario->username; ?></h3>
                      <form action="Buscar_Usuario.php" method="post">
                          <input name="manager" type="hidden" value="<?php echo $manager->id; ?>" />
                          <input name="liga" type="hidden" value="<?php echo $id; ?>" />
                          <input name="Invitar" type="submit" value="Invitar" />
                      </form>
            <?php
                    }
                  }
              ?>
      
        </div>
  </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");	

?>
