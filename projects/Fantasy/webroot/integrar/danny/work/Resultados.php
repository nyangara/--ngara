<?php
    require_once("Clases/fachadaInterface.php");
    $instancia = fachadaInterface::singleton();
    
    if(isset($_POST['Eliminar'])) {
        $_POST['TIPO'] = 'Juego';
        $instancia->eliminar();
        unset($_POST);
    }
    
    $_POST['TIPO']='Juego';
    $Juegos = $instancia->obtenerTodos();
    unset($_POST);
    
    include("Static/head.php");
    include("Static/header.php");
    
    include("Static/navigation.php");
?>

<div id="content">
    <div id="contenido_interno" style="overflow-y: auto">

    <h2>Resultados</h2>

<table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
                <th            >Fecha           </th>
                <th colspan="2">Equipo local    </th>
                <th>C</th>
                <th>H</th>
                <th>E</th>
                <th colspan="2">Equipo visitante</th>
                <th>C</th>
                <th>H</th>
                <th>E</th>
                <th            >Estadio         </th>
                <th            >                </th>
        </tr>
<?php
        $now = strtotime(date('m/d/Y h:i A'));
        foreach ($Juegos as $juego) {
          $date          = strtotime($juego->inicio);
          if ($date < $now) {
                $_POST['id'] = $juego->equipo_local;
                $_POST['TIPO']='Equipo';
                $equipo_local = $instancia->obtener();
                
                $_POST['id'] = $juego->equipo_visitante;
                $equipo_visitante = $instancia->obtener();
                unset($_POST);
                
                $_POST['id'] = $juego->estadio;
                $_POST['TIPO']='Estadio';
                $estadio = $instancia->obtener();
                unset($_POST);
                
                $id            = $juego->id;
                $img_local     = $equipo_local->logo;
                $img_visitante = $equipo_visitante->logo;
                if ($img_local     and !filter_var($img_local    , FILTER_VALIDATE_URL)) $img_local     = 'assets/images/Fotos_Equipos/' . $img_local    ;
                if ($img_visitante and !filter_var($img_visitante, FILTER_VALIDATE_URL)) $img_visitante = 'assets/images/Fotos_Equipos/' . $img_visitante;
?>
        <tr>
                <td><?php echo date('d/m/Y', $date); ?><br/>
                <?php echo date('h:i A', $date); ?></td>
                <td class="img"><img src="<?php echo $img_local; ?>" width="50" height="50" />
                <td><?php echo $equipo_local->nombre; ?></td>
                <td><?php echo $juego->carreras_equipo_local; ?></td>
                <td><?php echo $juego->hits_equipo_local; ?></td>
                <td><?php echo $juego->errores_equipo_local; ?></td>
                <td class="img"><img src="<?php echo $img_visitante; ?>" width="50" height="50" />
                <td><?php echo $equipo_visitante->nombre; ?></td>
                <td><?php echo $juego->carreras_equipo_visitante; ?></td>
                <td><?php echo $juego->hits_equipo_visitante; ?></td>
                <td><?php echo $juego->errores_equipo_visitante; ?></td>
                <td><?php echo $estadio->nombre; ?></td>
                <td>
                  <form action="Modificar_Juego.php" method="post" >
                      <input name="id" type="hidden" value="<?php echo $juego->id; ?>" />
                      <input name="Modificar" type="submit" value="Modificar" />
                  </form>
                  <form action="Resultados.php" method="post">
                      <input name="id" type="hidden" value="<?php echo $juego->id; ?>" />
                      <input name="Eliminar" type="submit" value="Eliminar" />
                  </form>
                </td>
        </tr>
<?php   } }  ?>
</table>

    </div>
</div>

<?php
include("Static/sideBar.php");
include("Static/footer.php");
?>
