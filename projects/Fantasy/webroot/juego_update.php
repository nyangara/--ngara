<?php
        require 'include/pre.php';

        function select_opts($name, $range, $now, $format, $print_empty) {
                $r = '<select name="' . $name . '">';
                if ($print_empty) $r .= '<option value=""></option>';
                foreach ($range as $i) {
                        $r .= sprintf(
                                '<option value="' . $format . '"%s>' . $format . '</option>',
                                $i,
                                ($i === $now ? ' selected="selected"' : ''),
                                $i
                        );
                }
                return $r . "</select>";
        }

        if (has_auth('admin') && array_key_exists('id', $_GET)) {
                $j = UIFacade::select('Juego', array('id' => $_GET['id']));
                $equipos  = UIFacade::retrieveAll('Equipo' );
                $estadios = UIFacade::retrieveAll('Estadio');
?>
<div id="contenido_interno" style="height: auto">
  <div>
    <form action="controller" method="post">
      <input type="hidden" name="goto" value="calendario"/>
      <table width="100%" border="0" cellspacing="5" cellpadding="5" align="left">
        <tr>
          <th style="border: 2px solid #cccccc">
            Agregar juego
          </th>
        </tr>
        <tr>
          <td style="border: 1px solid #cccccc">
            Introduzca la fecha y hora de inicio:
            <input type="text" name="inicio" value="<?php echo $j->get('inicio'); ?>"/>
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #cccccc">
            Seleccione el equipo local:
            <select name="equipo local" id="equipo_local">
              <option value=""></option>
<?php           foreach ($equipos as $e) { ?>
              <option value="<?php echo $e->get('id'); ?>"<?php if ($j->get('equipo local') == $e->get('id')) echo ' selected="selected"'; ?>><?php echo $e->get('nombre completo'); ?></option>
<?php           } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #cccccc">
            Seleccione el equipo visitante:
            <select name="equipo visitante">
              <option value=""></option>
<?php           foreach ($equipos as $e) { ?>
              <option value="<?php echo $e->get('id'); ?>"<?php if ($j->get('equipo visitante') == $e->get('id')) echo ' selected="selected"'; ?>><?php echo $e->get('nombre completo'); ?></option>
<?php           } ?>
            </select>
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid #cccccc">
            Seleccione el estadio:
            <select name="estadio">
              <option value=""></option>
<?php           foreach ($estadios as $s) { ?>
              <option value="<?php echo $s->get('id'); ?>"<?php if ($j->get('estadio') == $s->get('id')) echo ' selected="selected"'; ?>><?php echo $s->get('nombre'); ?></option>
<?php           } ?>
            </select>
          </td>
        </tr>
      </table>
      <input type="hidden" name="id" value="<?php echo $j->get('id'); ?>"/>
      <button type="submit" name="action" value="juego_update">Actualizar</button>
    </form>
  </div>
</div>
<?php
        }

        require 'include/post.html';
?>
