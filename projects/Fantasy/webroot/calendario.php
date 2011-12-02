<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';
        require      'include/pre.php';
?>
<h2>Calendario</h2>
<table width="100%" border="0" cellspacing="5" cellpadding="5">
    <tr>
        <th>Fecha           </th>
        <th>Equipo local    </th>
        <th>Equipo visitante</th>
        <th>Estadio         </th>
    </tr>
<?php
    foreach (UIFacade::calendario() as $c) {
    $date = strtotime($c['juego']->get('inicio'));
?>
<tr>
    <td><?php echo date('d/m/Y', $date); ?><br /><?php echo date('h:i A', $date); ?></td>
    <td><?php echo $c['equipo local'    ]->get('nombre corto'); ?></td>
    <td><?php echo $c['equipo visitante']->get('nombre corto'); ?></td>
    <td><?php echo $c['estadio'         ]->get('nombre'      ); ?></td>
</tr>
<?php } ?>
</table>
<?php require('include/post.html'); ?>
