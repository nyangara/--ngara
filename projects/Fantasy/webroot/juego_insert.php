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
                                                Introduzca la fecha:
                                                <?php echo select_opts('day', range(1, 31), '', '%02d', true); ?>
                                                /
                                                <?php echo select_opts('month', range(1, 12), '', '%02d', true); ?>
                                                /
                                                <?php $y = date('Y'); echo select_opts('year' , range($y - 10, $y + 10), '', '%d', true); ?>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Introduzca la hora:
                                                <?php echo select_opts('hour', range(1, 12), '', '%02d', true); ?>
                                                :
                                                <?php echo select_opts('minute', range(0, 59), '', '%02d', true); ?>
                                                <?php echo select_opts('ampm', array('AM', 'PM'), '', '%s', true); ?>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Seleccione el equipo local:
                                                <select name="equipo local" id="equipo_local">
                                                        <option value=""></option>
<?php   foreach ($equipos as $e) { ?>
                                                        <option value="<?php echo $e->get('id'); ?>"><?php echo $e->get('nombre completo'); ?></option>
<?php   } ?>
                                                </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Seleccione el equipo visitante:
                                                <select name="equipo visitante">
                                                        <option value=""></option>
<?php   foreach ($equipos as $e) { ?>
                                                        <option value="<?php echo $e->get('id'); ?>"><?php echo $e->get('nombre completo'); ?></option>
<?php   } ?>
                                                </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Seleccione el estadio:
                                                <select name="estadio">
                                                        <option value=""></option>
<?php   foreach ($estadios as $s) { ?>
                                                        <option value="<?php echo $s->get('id'); ?>"><?php echo $s->get('nombre'); ?></option>
<?php   } ?>
                                                </select>
                                        </td>
                                </tr>
                        </table>
                        <button type="submit" name="action" value="juego_insert">Insertar</button>
                </form>
        </div>
</div>
<?php   require 'include/post.html'; ?>
