<?php   require 'include/pre.php'; ?>
<h2>Resultados</h2>
<div>
  <form>
    <input type="text" name=""/>
    <select name="">
      <option>Fecha  </option>
      <option>Equipo </option>
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
<?php   if (has_auth('admin')) { ?>
    <th            >                </th>
<?php   } ?>
  </tr>
<?php
        foreach (UIFacade::calendario() as $c) {
                $date          = strtotime($c['juego']->get('inicio'));
                $id            = $c['juego'           ]->get('id'          );
                $img_local     = $c['equipo local'    ]->get('URL del logo');
                $img_visitante = $c['equipo visitante']->get('URL del logo');
                if ($img_local     and !filter_var($img_local    , FILTER_VALIDATE_URL)) $img_local     = 'static/images/equipo/' . $img_local    ;
                if ($img_visitante and !filter_var($img_visitante, FILTER_VALIDATE_URL)) $img_visitante = 'static/images/equipo/' . $img_visitante;
?>
  <tr>
    <td><?php echo date('d/m/Y', $date); ?><br/><?php echo date('h:i A', $date); ?></td>
    <td class="img"><img src="<?php echo $img_local; ?>"/></td>
    <td><?php echo $c['equipo local'    ]->get('nombre corto'); ?></td>
    <td class="img"><img src="<?php echo $img_visitante; ?>"/></td>
    <td><?php echo $c['equipo visitante']->get('nombre corto'); ?></td>
    <td><?php echo $c['estadio'         ]->get('nombre'      ); ?></td>
<?php           if (has_auth('admin')) { ?>
    <td>
      <form method="post" action="juego_update">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="submit" name="juego_update" value="Modificar"/>
      </form>
      <form method="post" action="controller">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="goto" value="calendario"/>
        <button type="submit" name="action" value="juego_remove"/>Eliminar</button>
      </form>
    </td>
<?php           } ?>
  </tr>
<?php   } ?>
</table>
<?php   if (has_auth('admin')) { ?>
<form id="form" action="agregar_equipo.php" method="post">
  <input type="submit" value="Agregar juego"/>
</form>
<?php
        }

        require 'include/post.html';
?>
