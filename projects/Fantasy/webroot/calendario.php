<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';
        require      'include/pre.php';
?>
<div id="contenido_interno" style="height: auto">
        <div style="height:500px; overflow-y: scroll;">
                <table width="100%" border="0" cellspacing="5" cellpadding="5" align="left" style="color: #cccccc">
                        <tr>
                                <th colspan="4" style="border: 2px solid #cccccc">Calendario</th>
                        </tr>
                        <tr>
                                <th style="border: 2px solid #cccccc">Fecha           </th>
                                <th style="border: 2px solid #cccccc">Equipo local    </th>
                                <th style="border: 2px solid #cccccc">Equipo visitante</th>
                                <th style="border: 2px solid #cccccc">Estadio         </th>
                        </tr>
<?php
        foreach (UIFacade::calendario() as $c) {
                $date = strtotime($c['juego']->get('inicio'));
?>
                        <tr>
                                <td style="border: 1px solid #cccccc">
                                        <?php echo date('d/m/Y', $date); ?>
                                        <br/>
                                        <?php echo date('h:i A', $date); ?>
                                </td>
                                <td style="border: 1px solid #cccccc"><?php echo $c['equipo local'    ]->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $c['equipo visitante']->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $c['estadio'         ]->get('nombre'); ?></td>
                        </tr>
<?php
        }
?>
                </table>
        </div>
</div>
<?php require('include/post.html'); ?>
