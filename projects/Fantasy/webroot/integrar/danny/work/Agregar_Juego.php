<?php
        if(isset($_POST['Aplicar'])) {
                $_POST['inicio']=$_POST['mes'].'/'.$_POST['dia'].'/'.$_POST['anio'].' '.$_POST['hora'].':'.$_POST['minuto'].' '.$_POST['ampm'];
                unset($_POST['anio']);
                unset($_POST['mes']);
                unset($_POST['dia']);
                unset($_POST['hora']);
                unset($_POST['minuto']);
                unset($_POST['ampm']);

                $_POST['TIPO']='Juego';
                $instancia->insertar();

                header('Location: Calendario.php');
        }

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

        include 'Static/navigation.php';
?>

<div id="content">
  <div id="contenido_interno_datos">
    <h2>Agregar juego</h2>
    <div id="box_info">
      <form action="Agregar_Juego.php" method="post">
        Fecha:
        <?php echo select_opts('dia', range(1, 31), date('d'), '%02d'); ?>               /
        <?php echo select_opts('mes', range(1, 12), date('n'), '%02d'); ?>             /
        <?php $y = date('Y'); echo select_opts('anio' , range($y, $y + 3), $y, '%d'); ?> -
        <?php echo select_opts('hora', range(1, 12), date('h'), '%02d'); ?>              :
        <?php echo select_opts('minuto', range(0, 59), date('i'), '%02d'); ?>
        <?php echo select_opts('ampm', array('AM', 'PM'), date('A'), '%s'); ?><br />
        Equipo local:
        <select name="equipo_local">
<?php   foreach($Equipos as $equipo) { ?>
          <option value="<?php echo $equipo->id; ?>"><?php echo $equipo->nombre; ?></option>
<?php   } ?>
        </select><br />
        Equipo visitante:
        <select name="equipo_visitante">
<?php   foreach($Equipos as $equipo) { ?>
          <option value="<?php echo $equipo->id; ?>"><?php echo $equipo->nombre; ?></option>
<?php   } ?>
        </select><br />
        Equipo estadio:
        <select name="estadio">
<?php   foreach($Estadios as $estadios) { ?>
          <option value="<?php echo $estadios->id; ?>"><?php echo $estadios->nombre; ?></option>
<?php   } ?>
        </select><br />
        <input name="Aplicar" type="submit" value="Agregar" />
      </form>
    </div>
  </div>
