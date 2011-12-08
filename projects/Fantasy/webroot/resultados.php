<?php
        require 'include/pre.php';

        $search = null;
        $q = null;
        if (
                array_key_exists('search', $_GET) &&
                array_key_exists('q'     , $_GET)
        ) {
                $search = $_GET['search'];
                $q      = $_GET['q'     ];
        }

        $search_fields = array(
                'todos'     => 'Todos los campos',
                'fecha'     => 'Fecha',
                'equipo'    => 'Equipo',
                'local'     => 'Equipo local',
                'visitante' => 'Equipo visitante',
                'estadio'   => 'Estadio',
        );
        $default = 'todos';
?>
<h2>Resultados</h2>
<?php   if (has_auth('admin')) { ?>
<form id="form" action="juego_insert" method="get">
  <button type="submit">Agregar juego</button>
</form>
<?php   } ?>
<div>
  <form method="get" action="calendario">
    <select name="search">
<?php   foreach ($search_fields as $k => $v) { ?>
      <option value="<?php echo $k; ?>"<?php if (($search == null && $k == $default) || ($search == $k)) echo ' selected="selected"'; ?>><?php echo $v; ?></option>
<?php   }; ?>
    </select>
    <input type="text" name="q" value="<?php echo $q; ?>"/>
    <button type="submit">Buscar</button>
  </form>
  <form method="get" action="calendario">
    <button type="submit">Ver todos</button>
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
        foreach (UIFacade::calendario($search, $q) as $c) {
                if ($c['juego']->get('estado') == 'pautado') continue;
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
      <form action="juego_update" method="get">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <button type="submit" name="action" value="juego_update" style="width: 5em"/>Modificar</button>
      </form>
      <form action="controller" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
        <input type="hidden" name="goto" value="calendario"/>
        <button type="submit" name="action" value="juego_remove" style="width: 5em"/>Eliminar</button>
      </form>
    </td>
<?php           } ?>
  </tr>
<?php   } ?>
</table>
<?php   require 'include/post.html'; ?>
