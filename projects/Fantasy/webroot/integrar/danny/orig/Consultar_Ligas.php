<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    
    if(isset($_POST['Publicas'])) {
        $es_publica = 't';
    }
    
    else if(isset($_POST['Privadas'])) {
        $es_publica = 'f';
    }
    
    else {
        $es_publica = $_POST['es_publica'];
    }
    
    $id = $_POST['id'];
    
    if(isset($_POST['Unirse'])) {
        $_POST['TIPO'] = 'Participa';
        $instancia->insertar();
    }
    
    if(isset($_POST['Eliminar'])) {
        $_POST['id'] = $_POST['liga'];
        $_POST['TIPO'] = 'Liga';
        $instancia->eliminar();
    }
    
    unset($_POST);
    
    include("Static/head.php");
    include("Static/header.php");
    
    $_POST['TIPO'] = 'Liga';
    $Ligas = $instancia->obtenerTodos();
    unset($_POST);
    
    $_POST['TIPO'] = 'Participa';
    $Participas = $instancia->obtenerTodos();
    unset($_POST);
    
    $Ligas_Propias = array();
    
    foreach($Participas as $participa) {
      if ($participa->manager == $_SESSION['Manager']) {
        $Ligas_Propias[] = $participa->liga;
      }
    }
    
    include("Static/navigation.php");
?>

<div id="content">
    <div id="contenido_interno" style="overflow-y: auto">

    <div class="top-options">
    <form action="Agregar_Liga.php" method="post">
        <?php if ($es_publica == 't' && isset($_SESSION['Administrador'])) { ?>
          <input name="Publica" type="submit" value="Agregar Liga Pública" />
        <?php } 
              if ($es_publica == 'f') { ?>
          <input name="Privada" type="submit" value="Agregar Liga Privada" />
        <?php } ?>
    </form>
    </div>

    <h2>Ligas <?php echo ($es_publica == 't') ? 'públicas' : 'privadas'  ?></h2>

<?php
    foreach($Ligas as $liga) {

    if ($liga->es_publica == $es_publica && !in_array($liga->id, $Ligas_Propias)) {
            $_POST['id'] = $liga->creador;
            $_POST['TIPO']='Usuario';
            $usuario = $instancia->obtener();
            unset($_POST);
?>

    <div class="alcanceLiga">
        <div class="datos">
            <form action="Datos_Liga.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <div>Nombre: <input type="submit" value="<?php echo $liga->nombre; ?>" /></div>
            </form>
            <form action="Datos_Usr.php" method="post">
                <input name="id" type="hidden" value="<?php echo $liga->creador; ?>" />
                <div>Creador: <input type="submit" value="<?php echo $usuario->username; ?>"></div>
            </form>
          </div>
          <div class="options">
            <form action="Consultar_Ligas.php" method="post">
                <input name="liga" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="manager" type="hidden" value="<?php echo $_SESSION['Manager']; ?>" />
                <input name="id" type="hidden" value="<?php echo $id; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $es_publica; ?>" />
                <input name="Unirse" type="submit" value="Unirse" />
            </form>
            <?php if (($es_publica == 't' && isset($_SESSION['Administrador'])) || ($es_publica == 'f' && $liga->creador == $_SESSION['Manager'])) { ?>
            <form action="Modificar_Liga.php" method="post" >
                <input name="id" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $liga->es_publica; ?>" />
                <input name="Modificar" type="submit" value="Modificar" />
            </form>
            <?php }
                  if (isset($_SESSION['Administrador'])) { ?>
            <form action="Consultar_Ligas.php" method="post">
                <input name="liga" type="hidden" value="<?php echo $liga->id; ?>" />
                <input name="id" type="hidden" value="<?php echo $id; ?>" />
                <input name="es_publica" type="hidden" value="<?php echo $es_publica; ?>" />
                <input name="Eliminar" type="submit" value="Eliminar" />
            </form>
            <?php } ?>
        </div>
    </div>

<?php } } ?>

    </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");
?>
