<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'model/Noticia.php';

        require      'include/pre.php';
?>
<div id="contenido_interno">
        <div id="Layer1" style="width:580px; height:500px; overflow: scroll;">
                <table width="90%" border="0" cellspacing="10" cellpadding="10" align="left">
<?php   foreach (Noticia::retrieveAll() as $n) { ?>
                        <tr>
<?php
                $i = $n->get('URL de imagen');
                if ($i) {
?>
                                <td>
                                        <img src="imágenes/<?php echo $i; ?>"/>
                                </td>
<?php           } ?>
                                <td width="50px">
                                        <h3><?php echo $n->get('título'); ?></h3>
                                        <p><?php echo $n->get('contenido'); ?></p>
                                        <p><small><?php echo $n->get('fecha'); ?></small></p>
                                        <p><small>Tags: <?php echo $n->get('tags'); ?></small></p>
                                </td>
                        </tr>
<?php   } ?>
                </table>
        </div>
</div>
<?php   include('include/post.html'); ?>
