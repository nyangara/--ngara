<?php
        require_once 'include/config.php';
        require_once 'include/dbconn/user.php';
        require_once 'include/UIFacade.php';

        require 'include/pre.php';
?>
<h2>Resultados</h2>
<div>
        <form>
                <input type="text" name=""/>
                <select name="">
                        <option>Fecha</option>
                        <option>Equipo</option>
                        <option>Estadio</option>
                </select>
                <input type="submit" name="" value="Buscar"/>
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
        foreach (UIFacade::calendario() as $c) {
                $date = strtotime($c['juego']->get('inicio'));
                $img_local     = $c['equipo local'    ]->get('URL del logo') or $img_local     = 'generico.jpg';
                $img_visitante = $c['equipo visitante']->get('URL del logo') or $img_visitante = 'generico.jpg';
?>
        <tr>
                <td>
                        <?php echo date('d/m/Y', $date); ?>
                        <br/>
                        <?php echo date('h:i A', $date); ?>
                </td>

                <td class="img"><img src="static/images/equipo/<?php echo $img_local; ?>"/>
                <td><?php echo $c['equipo local']->get('nombre corto'); ?></td>

                <td class="img"><img src="static/images/equipo/<?php echo $img_visitante; ?>"/>
                <td><?php echo $c['equipo visitante']->get('nombre corto'); ?></td>

                <td><?php echo $c['estadio']->get('nombre'); ?></td>

                <td>
                        <form method="post" action="juego_update">
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <input type="submit" name="juego_update" value="Modificar"/>
                        </form>
                        <form method="post" action="controller">
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <input type="hidden" name="goto" value="juegos"/>
                                <button type="submit" name="action" value="juego_remove">Eliminar</button>
                        </form>
                </td>
        </tr>
<?php   } ?>
</table>
<?php   require 'include/post.html'; ?>
