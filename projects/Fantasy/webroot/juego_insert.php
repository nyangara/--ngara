<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

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

        $equipos  = UIFacade::retrieveAll('Equipo');
        $estadios = UIFacade::retrieveAll('Estadio');

        require 'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
        <div style="height:500px; overflow-y: scroll;">
                <table width="100%" border="0" cellspacing="5" cellpadding="5" align="left" style="color: #cccccc">
                        <tr>
                                <th style="border: 2px solid #cccccc">
                                        Agregar juego
                                </th>
                        </tr>
                        <form action="controller_juego_insert" method="post">
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Introduzca la fecha:
                                                <?php echo select_opts('day', range(1, 31), date('d'), '%02d'); ?>
                                                /
                                                <?php echo select_opts('month', range(1, 12), date('n'), '%02d'); ?>
                                                /
                                                <?php $y = date('Y'); echo select_opts('year' , range($y, $y + 3), $y, '%d'); ?>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Introduzca la hora:
                                                <?php echo select_opts('hour', range(1, 12), date('h'), '%02d'); ?>
                                                :
                                                <?php echo select_opts('minute', range(0, 59), date('i'), '%02d'); ?>
                                                <?php echo select_opts('ampm', array('AM', 'PM'), date('A'), '%s'); ?>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                Seleccione el equipo local:
                                                <select name="equipo local" id="equipo_local">
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
<?php   foreach ($estadios as $s) { ?>
                                                        <option value="<?php echo $s->get('id'); ?>"><?php echo $s->get('nombre'); ?></option>
<?php   } ?>
                                                </select>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="border: 1px solid #cccccc">
                                                <input name="juego_insert" type="submit"/>
                                        </td>
                                </tr>
                        </form>
                </table>
        </div>
</div>
<?php   require 'include/post.html'; ?>
