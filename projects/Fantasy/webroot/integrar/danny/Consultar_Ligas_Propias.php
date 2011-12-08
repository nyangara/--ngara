<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();

    if(isset($_POST['Dejar'])) {
        $_POST['TIPO'] = 'Participa';
        $instancia->eliminar();
    }
    
    if(isset($_POST['Eliminar'])) {
        $_POST['TIPO'] = 'Liga';
        $instancia->eliminar();
    }
    
    unset($_POST);
    
    include("Static/head.php");
    include("Static/header.php");
    
    $_POST['TIPO']='Participa';
    $Participas = $instancia->obtenerTodos();
    unset($_POST);
    
    $Ligas = array();
    
    foreach($Participas as $p) {
      if ($p->manager == $_SESSION['Manager']) {
        $_POST['id']=$p->liga;
        $_POST['TIPO']='Liga';
        $Ligas[$p->id] = $instancia->obtener();
        unset($_POST);
      }
    }
    
    include("Static/navigation.php");
?>

<div id="content">
    <div id="contenido_interno" style="overflow-y: auto">

    <div class="top-options">
    <form action="Agregar_Liga.php" method="post">
        <?php if (isset($_SESSION['Administrador'])) { ?>
            <input name="Publica" type="submit" value="Agregar Liga Pública" class="link" />
        <?php } ?>
        <input name="Privada" type="submit" value="Agregar Liga Privada" class="link" />
    </form>
    <form action="Consultar_Ligas.php" method="post">
        <input name="id" type="hidden" value="<?php echo $_SESSION['Manager']; ?>" />
        <input name="Publicas" type="submit" value="Ver Ligas Públicas" class="link" />
        <?php if (isset($_SESSION['Administrador'])) { ?>
          <input name="Privadas" type="submit" value="Ver Ligas Privadas" class="link" />
        <?php } ?>
    </form>
    </div>

    <h2>Ligas propias</h2>

<?php foreach($Ligas as $participa => $liga) {
          $_POST['id'] = $liga->creador;
          $_POST['TIPO']='Usuario';
          $usuario = $instancia->obtener();
          unset($_POST);
?>

    <div class="alcanceLiga">
        <div class="datos">
            <form action="Datos_Liga.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <h3>Nombre: <input type="submit" value="<?php echo $liga->nombre; ?>" class="link" /></h3>
            </form>
            <form action="Datos_Usr.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->creador; ?>" />
                <h4>Creador: <input type="submit" value="<?php echo $usuario->username; ?>" class="link"></h4>
            </form>
          </div>
          <div class="options">
            <form action="Invitar.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="nombre" type="hidden" value="<?php echo $liga->nombre; ?>" />
                <input name="Invitar" type="submit" value="Invitar" />
            </form>
            <?php if ($liga->creador == $_SESSION['Manager']) { ?>
              <form action="Consultar_Ligas_Propias.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="Eliminar" type="submit" value="Dejar" />
              </form>
            <?php } else { ?>
              <form action="Consultar_Ligas_Propias.php" method="post">
                <input name="id" type="hidden" value="<?php echo $participa; ?>" />
                <input name="Dejar" type="submit" value="Dejar" />
              </form>
            <?php } ?>
            <?php if ((isset($_SESSION['Manager']) && $_SESSION['Manager'] == $liga->creador) || (isset($_SESSION['Administrador']))) { ?>
            <form action="Modificar_Liga.php" method="post" >
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $liga->es_publica; ?>" />
                <input name="Modificar" type="submit" value="Modificar" />
            </form>
            <?php } ?>
            <?php if (isset($_SESSION['Administrador'])) { ?>
            <form action="Consultar_Ligas_Propias.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="Eliminar" type="submit" value="Eliminar" />
            </form>
            <?php } ?>
        </div>
    </div>

<?php } ?>

    </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");
?>
