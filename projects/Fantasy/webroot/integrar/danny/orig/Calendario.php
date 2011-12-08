<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    
    if(isset($_POST['Buscar_Fecha'])) {
      
      $fecha = '';
      
      if ($_POST['anio'] != -1) {
        $fecha .= $_POST['anio'];
        
        if ($_POST['mes']  != -1) {
          $fecha .= '-'.$_POST['mes'];
          
          if ($_POST['dia']  != -1) $fecha .= '-'.$_POST['dia'];
        }
      }
      
      $hora  = '';
      
      if ($_POST['hora'] != -1 && $_POST['minuto'] != -1 && $_POST['ampm'] != -1) {
        $hora = $_POST['hora'].':'.$_POST['minuto'].' '.$_POST['ampm'];
        $hora = ' ' . date('H:i', strtotime($hora));
      }
      
      unset($_POST['anio']);
      unset($_POST['mes']);
      unset($_POST['dia']);
      unset($_POST['hora']);
      unset($_POST['minuto']);
      unset($_POST['ampm']);
      
      $inicio = '';
      
      if ($fecha != '' && $hora =='') $inicio = $fecha;
      else if ($fecha == '' && $hora !='') $inicio = $hora;
      else if ($fecha != '' && $hora !='' && strlen($fecha) == 11) $inicio = $fecha . $hora;
    }
    
    if(isset($_POST['Buscar_Equipo'])) {
        $equipo = $_POST['equipo'];
        unset($_POST);
    }
    
    if(isset($_POST['Buscar_Estadio'])) {
        $estadio = $_POST['estadio'];
        unset($_POST);
    }
    
    if(isset($_POST['Eliminar'])) {
        $_POST['TIPO'] = 'Juego';
        $instancia->eliminar();
        unset($_POST);
    }
    
    $_POST['TIPO'] = 'Juego';
    $Juegos = $instancia->obtenerTodos();
    unset($_POST);
    
    if($inicio != NULL) {
        $temp = array();
        foreach($Juegos as $juego) {
          if(strpos($juego->inicio, $inicio) !== false) {
            $temp[] = $juego;
          }
        }
        $Juegos = $temp;
    }
    
    if($equipo != NULL) {
        $temp = array();
        foreach($Juegos as $juego) {
          if(($juego->equipo_local == $equipo) || 
             ($juego->equipo_visitante == $equipo)) {
            $temp[] = $juego;
          }
        }
        $Juegos = $temp;
    }
    
    if($estadio != NULL) {
        $temp = array();
        foreach($Juegos as $juego) {
          if($juego->estadio == $estadio) {
            $temp[] = $juego;
          }
        }
        $Juegos = $temp;
    }
    
    $_POST['TIPO'] = 'Equipo';
    $Equipos = $instancia->obtenerTodos();
    unset($_POST);
    
    $_POST['TIPO'] = 'Estadio';
    $Estadios = $instancia->obtenerTodos();
    unset($_POST);
    
    function select_opts($name, $range, $format) {
        $r = '<select name="' . $name . '">';
        $r .= '<option value="-1" selected="selected"></option>'; 
        foreach ($range as $i) {
                $r .= sprintf(
                        '<option value="' . $format . '">' . $format . '</option>',
                        $i,
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
    <div id="contenido_interno" style="overflow-y: auto">

    <div class="top-options">
    <form action="Agregar_Juego.php" method="post">
            <input name="Agregar" type="submit" value="Agregar Juego" class="link" />
    </form>
    </div>

    <h2>Calendario</h2>
    <h2><?php echo $inicio; ?></h2>

    <div>
      <form action="Calendario.php" method="post">
        Fecha:
        <?php echo select_opts('dia', range(1, 31), '%02d'); ?>               /
        <?php echo select_opts('mes', range(1, 12), '%02d'); ?>             /
        <?php $y = date('Y') - 3; echo select_opts('anio' , range($y, $y + 3), '%d'); ?> -
        <?php echo select_opts('hora', range(1, 12), '%02d'); ?>              :
        <?php echo select_opts('minuto', range(0, 59), '%02d'); ?>
        <?php echo select_opts('ampm', array('AM', 'PM'), '%s'); ?>
        <input name="Buscar_Fecha" type="submit" value="Buscar" />
      </form>
      <form action="Calendario.php" method="post">
        Equipo: 
        <select name="equipo">
        <?php foreach($Equipos as $equipo) { ?>
            <option value="<?php echo $equipo->id; ?>"><?php echo $equipo->nombre; ?></option>
        <?php } ?>
        </select>
        <input name="Buscar_Equipo" type="submit" value="Buscar" />
      </form>
      <form action="Calendario.php" method="post">
        Estadio: 
        <select name="estadio">
        <?php foreach($Estadios as $estadio) { ?>
            <option value="<?php echo $estadio->id; ?>"><?php echo $estadio->nombre; ?></option>
        <?php } ?>
        </select>
        <input name="Buscar_Estadio" type="submit" value="Buscar" />
      </form>
    </div>

<table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
                <th            >Fecha           </th>
                <th colspan="2">Equipo local    </th>
                <th colspan="2">Equipo visitante</th>
                <th            >Estadio         </th>
                <th            >                </th>
        </tr>
<?php
        $now = strtotime(date('m/d/Y h:i A'));
        foreach ($Juegos as $juego) {
          $date = strtotime($juego->inicio);
          if ($date > $now) {
                $_POST['id'] = $juego->equipo_local;
                $_POST['TIPO']='Equipo';
                $equipo_local = $instancia->obtener();
                
                $_POST['id'] = $juego->equipo_visitante;
                $equipo_visitante = $instancia->obtener();
                unset($_POST);
                
                $_POST['id'] = $juego->estadio;
                $_POST['TIPO']='Estadio';
                $estadio = $instancia->obtener();
                unset($_POST);
                
                $id            = $juego->id;
                $img_local     = $equipo_local->logo;
                $img_visitante = $equipo_visitante->logo;
                if ($img_local     and !filter_var($img_local    , FILTER_VALIDATE_URL)) $img_local     = 'assets/images/Fotos_Equipos/' . $img_local    ;
                if ($img_visitante and !filter_var($img_visitante, FILTER_VALIDATE_URL)) $img_visitante = 'assets/images/Fotos_Equipos/' . $img_visitante;
?>
        <tr>
                <td><?php echo date('d/m/Y', $date); ?><br/>
                <?php echo date('h:i A', $date); ?></td>
                <td class="img"><img src="<?php echo $img_local; ?>" width="50" height="50" />
                <td><?php echo $equipo_local->nombre; ?></td>
                <td class="img"><img src="<?php echo $img_visitante; ?>" width="50" height="50" />
                <td><?php echo $equipo_visitante->nombre; ?></td>
                <td><?php echo $estadio->nombre; ?></td>
                <td>
                  <form action="Modificar_Juego.php" method="post" >
                      <input name="id" type="hidden" value="<?php echo $juego->id; ?>" />
                      <input name="Modificar" type="submit" value="Modificar" />
                  </form>
                  <form action="Calendario.php" method="post">
                      <input name="id" type="hidden" value="<?php echo $juego->id; ?>" />
                      <input name="Eliminar" type="submit" value="Eliminar" />
                  </form>
                </td>
        </tr>
<?php   } }  ?>
</table>

    </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");
?>
