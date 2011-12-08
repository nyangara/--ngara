<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    
    if(isset($_POST['Aplicar'])) {
        
        $_POST['inicio']=$_POST['mes'].'/'.$_POST['dia'].'/'.$_POST['anio'].' '.$_POST['hora'].':'.$_POST['minuto'].' '.$_POST['ampm'];
        unset($_POST['anio']);
        unset($_POST['mes']);
        unset($_POST['dia']);
        unset($_POST['hora']);
        unset($_POST['minuto']);
        unset($_POST['ampm']);
        
        $_POST['TIPO']='Juego';
        $instancia->actualizar();

        header('Location: Calendario.php'); 

    }
    
    $id = $_POST['id'];
    unset($_POST);
    
    $_POST['id'] = $id;
    $_POST['TIPO'] = 'Juego';
    $Juego = $instancia->obtener();
    unset($_POST);
    
    $_POST['TIPO'] = 'Equipo';
    $Equipos = $instancia->obtenerTodos();
    unset($_POST);
    
    $_POST['TIPO'] = 'Estadio';
    $Estadios = $instancia->obtenerTodos();
    unset($_POST);
    
    function select_opts($name, $range, $now, $format) {
        $r = '<select name="' . $name . '">';
        foreach ($range as $i) {
                $r .= sprintf(
                        '<option value="' . $format . '"%s>' . $format . '</option>',
                        $i,
                        ($i == $now ? ' selected="selected"' : ''),
                        $i
                );
        }
        return $r . "</select>";
    }

    include("Static/head.php");
    include("Static/header.php");
    
    include("Static/navigation.php");
?>

    <div id="content">
    <div id="contenido_interno_datos">
        <h2>Modificar juego</h2>
        <div id="box_info">
            <form action="Modificar_Juego.php" method="post">
                Fecha:
                <?php $inicio = strtotime($Juego->inicio); echo select_opts('dia', range(1, 31), date('d', $inicio), '%02d'); ?>               /
                <?php echo select_opts('mes', range(1, 12), date('n', $inicio), '%02d'); ?>             /
                <?php $y = date('Y'); echo select_opts('anio' , range($y, $y + 3), date('Y', $inicio), '%d'); ?> -
                <?php echo select_opts('hora', range(1, 12), date('h', $inicio), '%02d'); ?>              :
                <?php echo select_opts('minuto', range(0, 59), date('i', $inicio), '%02d'); ?>
                <?php echo select_opts('ampm', array('AM', 'PM'), date('A', $inicio), '%s'); ?><br />
                Status: 
                <select name="status">
                <?php $Estados = array('pautado', 'suspendido', 'demorado', 'terminado');
                    foreach($Estados as $estado) { ?>
                    <option value="<?php echo $estado; ?>"<?php echo ($Juego->status == $estado) ? ' selected="selected"' : ''; ?>><?php echo ucwords($estado); ?></option>
                <?php } ?>
                </select><br />
                Equipo local: 
                <select name="equipo_local">
                <?php foreach($Equipos as $equipo) { ?>
                    <option value="<?php echo $equipo->id; ?>"<?php echo ($Juego->equipo_local == $equipo->id) ? ' selected="selected"' : ''; ?>><?php echo $equipo->nombre; ?></option>
                <?php } ?>
                </select><br />
                Carreras: <input name="carreras_equipo_local" type="text" value="<?php echo ($Juego->carreras_equipo_local != -1) ? $Juego->carreras_equipo_local : ''; ?>" style="width: 2em" />
                Hits: <input name="hits_equipo_local" type="text" value="<?php echo ($Juego->hits_equipo_local != -1) ? $Juego->hits_equipo_local : ''; ?>" style="width: 2em" />
                Errores: <input name="errores_equipo_local" type="text" value="<?php echo ($Juego->errores_equipo_local != -1) ? $Juego->errores_equipo_local : ''; ?>" style="width: 2em" />
                <br />
                Equipo visitante: 
                <select name="equipo_visitante">
                <?php foreach($Equipos as $equipo) { ?>
                    <option value="<?php echo $equipo->id; ?>"<?php echo ($Juego->equipo_visitante == $equipo->id) ? ' selected="selected"' : ''; ?>><?php echo $equipo->nombre; ?></option>
                <?php } ?>
                </select><br />
                Carreras: <input name="carreras_equipo_visitante" type="text" value="<?php echo ($Juego->carreras_equipo_visitante != -1) ? $Juego->carreras_equipo_visitante : ''; ?>" style="width: 2em" />
                Hits: <input name="hits_equipo_visitante" type="text" value="<?php echo ($Juego->hits_equipo_visitante != -1) ? $Juego->hits_equipo_visitante : ''; ?>" style="width: 2em" />
                Errores: <input name="errores_equipo_visitante" type="text" value="<?php echo ($Juego->errores_equipo_visitante != -1) ? $Juego->errores_equipo_visitante : ''; ?>" style="width: 2em" />
                <br />
                Equipo estadio: 
                <select name="estadio">
                <?php foreach($Estadios as $estadio) { ?>
                    <option value="<?php echo $estadio->id; ?>"<?php echo ($Juego->estadio == $estadio->id) ? ' selected="selected"' : ''; ?>><?php echo $estadio->nombre; ?></option>
                <?php } ?>
                </select><br />
                <input name="id" type="hidden" value="<?php echo $id; ?>" />
                <input name="Aplicar" type="submit" value="Modificar" />
            </form>
        </div>
    </div>
        
<?php

include("Static/sideBar.php");
include("Static/footer.php");	

?>
