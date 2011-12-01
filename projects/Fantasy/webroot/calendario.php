<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Equipo.php';
        require_once 'model/Estadio.php';
        require_once 'model/Juego.php';
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
        foreach (Juego::retrieveAll() as $j) {
                $l = new Equipo (); $l->set('id', $j->get('equipo local'    )); $l = $l->select();
                $v = new Equipo (); $v->set('id', $j->get('equipo visitante')); $v = $v->select();
                $s = new Estadio(); $s->set('id', $j->get('estadio'         )); $s = $s->select();
                $date = strtotime($j->get('inicio'));
?>
                        <tr>
                                <td style="border: 1px solid #cccccc">
                                        <?php echo date('d/m/Y', $date); ?>
                                        <br/>
                                        <?php echo date('h:i A', $date); ?>
                                </td>
                                <td style="border: 1px solid #cccccc"><?php echo $l->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $v->get('nombre'); ?></td>
                                <td style="border: 1px solid #cccccc"><?php echo $s->get('nombre'); ?></td>
                        </tr>
<?php
        }
?>
                </table>
        </div>
</div>
<?php require('include/post.html'); ?>
