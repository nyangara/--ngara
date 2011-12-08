<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    if($_POST['Publica']) {
      $es_publica = 't';
    }
    
    if($_POST['Privada']) {
      $es_publica = 'f';
    }
    
    if(isset($_POST['Agregar'])) {
        
        $_POST['TIPO'] = 'Liga';
        $instancia->insertar();
        
        $liga = $instancia->obtener();
        unset($_POST);
        
        $_POST['liga'] = $liga->id;
        $_POST['manager'] = $liga->creador;
        $_POST['TIPO'] = 'Participa';
        $instancia->insertar();

        header('Location: Consultar_Ligas_Propias.php'); 

    }
    
    unset($_POST);

    include("Static/head.php");
    include("Static/header.php");
    
    include("Static/navigation.php");
?>

    <div id="content">
    <div id="contenido_interno_datos">
        <h2>Agregar liga <?php echo ($es_publica == 't') ? 'pública' : 'privada'; ?></h2>
        <div id="box_info">
            <form action="Agregar_Liga.php" method="post">
                Nombre: <input name="nombre" type="text" value="" /><br />
                <input name="creador" type="hidden" value="<?php echo $_SESSION['Manager'] ?>" /><br />
                <input name="es_publica" type="hidden" value="<?php echo $es_publica ?>" /><br />
                <input name="Agregar" type="submit" value="Agregar" />
            </form>
        </div>
    </div>
        
<?php

include("Static/sideBar.php");
include("Static/footer.php");	

?>
