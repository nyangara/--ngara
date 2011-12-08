<?php
        require 'include/pre.php';

$Equipo_Roster = array();
foreach (UIFacade::retrieveAll('TieneEquipo') as $ul) {
        if ($ul->get('usuario') == userdata()->get('id')) $Equipo_Roster[] = $ul;
}

$EquipoR = null;
if (!empty($Equipo_Roster)) $EquipoR = UIFacade::select('Equipo', array('id' => $Equipo_Roster[0]->get('id')));

$Jugadores_Roster = array();
foreach (UIFacade::retrieveAll('TieneJugador') as $uj) {
        if ($uj->get('usuario') == userdata()->get('id')) $Jugadores_Roster[] = $uj;
}
$JugadoresR = $Jugadores_Roster;

$Jugadores = UIFacade::retrieveAll('Jugador');
$Equipos   = UIFacade::retrieveAll('Equipo' );

$Usados = array();
foreach ($Jugadores_Roster as $J_R){
    $Tmp = UIFacade::select('Jugador', array('id' => $J_R->get('id')));
    $Aux[$J_R->get('posición')] = '<a class="irA'.$J_R->get('posición').'"><img src="'.$Tmp->get('URL de la foto').'"  width="50" height="50" /></a>' ;
    $Usados[]=$J_R->get('posición');
}
error_log(var_export($Usados, true));
error_log(var_export($Aux, true));
$Aux['DEF'] = '<a class="irADEF"><img src="assets/images/Fotos_Roster/JugadorDefault.jpg"  width="50" height="50" /></a>' ;

//Seleccion de Posicion Disponible;
$Todos = array('C','1B','2B','3B','SS','LF','CF','RF');
$k=0;
$Disponibles = array();
for($i=0;$i<count($Todos);$i++){
    for($j=0;$j<count($Usados);$j++){
        if($Usados[$j]==$Todos[$i])
            break;
    }
    if($j==count($Usados)){
        $Disponibles[$k]=$Todos[$i];
        $k++;
    }
}

$s = '<select name="posicion_jugador">';
for ($i = 0 ; $i< count($Disponibles) ; $i++)
    $s .= "<option value=".$Disponibles[$i].">".$Disponibles[$i]."</option>";
$s .= '</select>';

$i=0;
$P = ''; //Equipos de Pitchers
foreach($Equipos as $Equipo){
    if($EquipoR == null || $Equipo->get('id') != $EquipoR->get('id')){
        if( $i % 2 ) // Impares
            $P .= '<tr class="impar"><form action="controller" method="post"><input type="hidden" name="goto" value="roster"/><input type="hidden" name="action" value="comprar_equipo"/><input type="hidden" name="equipo" value="'.$Equipo->get('id').'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->get('nombre').'</td><td>00</td><td>'.$Equipo->get('precio').'</td></form></tr>';
        else //Pares
            $P .= '<tr class="par">  <form action="controller" method="post"><input type="hidden" name="goto" value="roster"/><input type="hidden" name="action" value="comprar_equipo"/><input type="hidden" name="equipo" value="'.$Equipo->get('id').'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->get('nombre').'</td><td>00</td><td>'.$Equipo->get('precio').'</td></form></tr>';
        $i++;
    }
}

$B = ''; // Bateadores
$i=0;
foreach($Jugadores as $Jugador){
    if($Jugador->get('posicion') != 'P' && !in_array($Jugador,$JugadoresR)){
        if( $i % 2 ) {// Impares
            $B .= '<tr class="impar">';
        } else { //Pares
            $B .= '<tr class="par">  ';
        }
        $B .= '<form action="controller" method="post"><input type="hidden" name="goto" value="roster"/><input type="hidden" name="jugador" value="'.$Jugador->get('id').'" /><td>'.$s.'<input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->get('nombres').'</td><td>'.$Jugador->get('posicion').'</td><td>AVG</td><td>'.$Jugador->get('precio').'</td></form></tr>';
        $i++;
    }
}

// FIXME: img url assets static
if($EquipoR != null) {
        $img = $EquipoR->get('URL del logo') or $img = 'generico.jpg';
        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img;
        $Aux['P'] = '<a class="irAP"><img src="'.$img.'"  width="50" height="50" /></a>' ;
} else {
        $Aux['P'] = '<a class="irAP"><img src="assets/images/Fotos_Roster/EquipoDefault.jpg"  width="50" height="50" /></a>' ;
}

$i=0;
$D = '';
foreach($Jugadores_Roster as $J_R){ // MARK
        $img = $J_R->get('URL de la foto');
        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/jugador/' . $img; // FIXME: img url assets static etc
        $Tmp = UIFacade::select('Jugador', array('id' => $J_R->get('jugador')));
        $D .= '
        <div class="a'.$J_R->get('posición').'">
                <div id="imgjugador">
                <img src="'.$img.'" height="100" width="70" />
                </div>
                <table width="240" align="left">
                        <tr class="impar">
                                <td><p>Nombre:</p></td>
                                <td><p>'.$Tmp->get('nombre completo').'</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Posicion:</p></td>
                                <td><p>'.$J_R->get('posición').'</p></td>
                        </tr>
                        <tr class="impar">
                                <td><p>Valor:</p></td>
                                <td><p>'.$Tmp->get('precio').'</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Efectividad:</p></td>
                                <td><p>.000</p></td>
                        </tr>
                </table>

                <form action="controller" method="post">
                        <input type="hidden" name="jugador" value="'.$Tmp->get('id').'">
                        <input type="hidden" name="action" value="vender_jugador"/>
                        <input type="hidden" name="goto" value="roster"/>
                        <input type="submit" name="Vender" value="Vender Jugador"/>
                </form>
                <form action="controller" method="post">
                        <input type="hidden" name="jugador" value="'.$Tmp->get('id').'">
                        <input type="hidden" name="action" value="renegociar_jugador"/>
                        <input type="hidden" name="goto" value="roster"/>
                        <input type="submit" name="Renegociar" value="Renegociar Jugador">
                </form>
        </div>';
}

        $D .= '
        <div class="aDEF">
                <div id="imgjugador">
                <img src="assets/images/Fotos_Roster/JugadorDefault.jpg" height="100" width="70" />
                </div>
                <table width="240" align="left">
                        <tr class="impar">
                                <td><p>Nombre:</p></td>
                                <td><p>------</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Posicion:</p></td>
                                <td><p>-------</p></td>
                        </tr>
                        <tr class="impar">
                                <td><p>Valor:</p></td>
                                <td><p>---------</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Efectividad:</p></td>
                                <td><p>-------</p></td>
                        </tr>
                </table>
        </div>';

if($EquipoR != null){
        $img = $e->get('URL del logo') or $img = 'generico.jpg';
        if ($img and !filter_var($img, FILTER_VALIDATE_URL)) $img = 'static/images/equipo/' . $img; // FIXME: assets o static
        $D .= '
        <div class="aP">
                <div id="imgjugador">
                <img src="'.$EquipoR->get('logo').'" height="100" width="70" />
                </div>
                <table width="240" align="left">
                        <tr class="impar">
                                <td><p>Nombre:</p></td>
                                <td><p>'.$EquipoR->get('nombre').'</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Posicion:</p></td>
                                <td><p>P</p></td>
                        </tr>
                        <tr class="impar">
                                <td><p>Valor:</p></td>
                                <td><p>'.$EquipoR->get('precio').'</p></td>
                        </tr>
                        <tr class="par">
                                <td><p>Efectividad:</p></td>
                                <td><p>-------</p></td>
                        </tr>
                </table>
                <form action="controller" method="post">
                    <input type="hidden" name="equipo" value="'.$EquipoR->get('id').'"/>
                    <input type="hidden" name="action" value="vender_equipo"/>
                    <input type="hidden" name="goto" value="roster"/>
                    <input type="submit" name="Vender" value="Vender Equipo de Lanzadores"/>
                </form>
        </div> ';
}

?>

<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="assets/styles/style_roster.css"  type="text/css" />
<link rel="stylesheet" href="assets/styles/style_showinfo.css"  type="text/css" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/showinfo.js"></script>

        <div id="content">
            <div id="contenido_roster">

                <div class="toFade">

                    <div id="campo_juego">
                        <h3>Tu Roster</h3>

                        <div id="score_usuario"><?php echo userdata()->get('puntaje'); ?></div>

                        <div id="creditos_usuario"><?php echo userdata()->get('creditos'); ?></div>

                        <div id="LF"><?php $ira = (isset($Aux['LF'])) ? $Aux['LF'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="CF"><?php $ira = (isset($Aux['CF'])) ? $Aux['CF'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="RF"><?php $ira = (isset($Aux['RF'])) ? $Aux['RF'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="SS"><?php $ira = (isset($Aux['SS'])) ? $Aux['SS'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="B2"><?php $ira = (isset($Aux['2B'])) ? $Aux['2B'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="B3"><?php $ira = (isset($Aux['3B'])) ? $Aux['3B'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="B1"><?php $ira = (isset($Aux['1B'])) ? $Aux['1B'] : $Aux['DEF']; echo $ira; ?></div>
                        <div id="P" ><?php $ira = (isset($Aux['P']))  ? $Aux['P']  : $Aux['DEF']; echo $ira; ?></div>
                        <div id="RE"><?php $ira = (isset($Aux['C']))  ? $Aux['C']  : $Aux['DEF']; echo $ira; ?></div>
                    </div>
                </div>

                <div id="lista_jugadores">
                    <div id="Accordion1" class="Accordion" tabindex="0">
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><h1>Lanzadores</h1></div>
                            <div class="AccordionPanelContent">

                                <table width="350" border="0">
                                  <tr class="impar">
                                    <td>Equipo lanzadores:</td>
                                    <td>Efectividad:</td>
                                    <td>Precio</td>
                                  </tr>
                                  <?php echo $P; ?>
                                </table>

                            </div>
                        </div>
                        <div class="AccordionPanel">
                            <div class="AccordionPanelTab"><h1>Bateadores</h1></div>
                            <div class="AccordionPanelContent">

                                <table width="350" border="0">
                                <tr class="impar">
                                    <td>Nombre:</td>
                                    <td>Posicion</td>
                                    <td>AVG</td>
                                    <td>Precio</td>
                                </tr>
                                <?php echo $B; ?>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
          </div>

        </div><!-- main -->
        <div id="sidebar">
        </div>
      </div><!-- content -->
    </div>
    <div id="footer">
      <p><a href="reglas.php">Reglas</a> | <a href="faq.php">FAQ</a> | <a href="informacion.php">Acerca de</a></p>
      <p class="copyright">Ñángara &amp; Cluster System Solutions © 2011</p>
    </div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>

<?php echo $D; ?>
  </body>
</html>
