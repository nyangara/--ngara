<?php
        require_once 'include/config.php';
        require_once 'include/dbconn-admin.php';
        require_once 'include/model/facade/FacadeEstadio.php';
        require_once 'include/model/facade/FacadeEquipo.php';

        ////////////////////////////////////////////////////////////////////////////////
        require_once 'include/model/entity/Juego.php';

        if (array_key_exists('submit', $_POST)) {
                $fecha = $_POST['year'  ] . '-' .
                         $_POST['month' ] . '-' .
                         $_POST['day'   ] . ' ' .
                         $_POST['hour'  ] . ':' .
                         $_POST['minute'] . ' ' .
                         $_POST['am_pm'];
                $juego = new Juego();
                $juego->set('fecha'           , $fecha                    )
                      ->set('equipo local'    , $_POST['equipo local'    ])
                      ->set('equipo visitante', $_POST['equipo visitante'])
                      ->set('estadio'         , $_POST['estadio'         ]);
        }
        ////////////////////////////////////////////////////////////////////////////////

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

        $equipos = FacadeEquipo::retrieveAll();
        $estadios = FacadeEstadio::retrieveAll();

        require("include/pre.html");
?>
        <ul id="navigation">
                <li           ><a href="index.php">Inicio     </a></li>
                <li           ><a href="#"        >Jugadores  </a></li>
                <li           ><a href="#"        >Equipos    </a></li>
                <li           ><a href="#"        >Estadios   </a></li>
                <li           ><a href="#"        >Mi Perfil  </a></li>
                <li           ><a href="#"        >Roster     </a></li>
                <li           ><a href="#"        >Ligas      </a></li>
                <li class="on"><a href="#"        >Calendario </a></li>
                <li           ><a href="#"        >Resultados </a></li>
                <li           ><a href="#"        >Reglas     </a></li>
                <li           ><a href="#"        >Contáctenos</a></li>
        </ul>
</div>
<div id="content">
        <div id="contenido_interno" style="height: auto">
                <div style="height:500px; overflow-y: scroll;">
                        <table width="100%" border="0" cellspacing="5" cellpadding="5" align="left" style="color: #cccccc">
                                <tr>
                                        <th style="border: 2px solid #cccccc">
                                                Agregar juego
                                        </th>
                                </tr>
                                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
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
                                                        <?php echo select_opts('am_pm', array('AM', 'PM'), date('A'), '%s'); ?>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td style="border: 1px solid #cccccc">
                                                        Seleccione el equipo local:
                                                        <select name="equipo_local">
<?php
        foreach ($equipos as $e) {
                echo '<option value="' . $e->get('id') . '">' . $e->get('nombre corto') . '</option>';
        }
?>
                                                        </select>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td style="border: 1px solid #cccccc">
                                                        Seleccione el equipo visitante:
                                                        <select name="equipo_visitante">
<?php
        foreach ($equipos as $e) {
                echo '<option value="' . $e->get('id') . '">' . $e->get('nombre corto') . '</option>';
        }
?>
                                                        </select>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td style="border: 1px solid #cccccc">
                                                        Seleccione el estadio:
                                                        <select name="estadio">
<?php
        foreach ($estadios as $e) {
                echo '<option value="' . $e->get('id') . '">' . $e->get('nombre') . '</option>';
        }
?>
                                                        </select>
                                                </td>
                                        </tr>
                                        <tr>
                                                <td style="border: 1px solid #cccccc">
                                                        <input name="submit" type="submit"/>
                                                </td>
                                        </tr>
                                </form>
                        </table>
                </div>
        </div>
<?php require('include/post.html'); ?>
