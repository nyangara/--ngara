<?php
include 'Static/head.php';
include 'Static/header.php';

$Usados = array();
$i=0;
$_POST['TIPO']='Jugador';
foreach($Jugadores_Roster as $J_R){
        $_POST['id']=$J_R->jugador;
        $Tmp = $instancia->obtener();
        $Aux[$J_R->posicion_jugador] = '<a class="irA'.$J_R->posicion_jugador.'"><img src="'.$Tmp->foto.'"  width="50" height="50" /></a>' ;
        $Usados[$i]=$J_R->posicion_jugador;
        $i++;
}

$Aux['DEF'] = '<a class="irADEF"><img src="assets/images/Fotos_Roster/JugadorDefault.jpg" width="50" height="50"/></a>' ;

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
        if($EquipoR == null || $Equipo->id != $EquipoR->id){
                if( $i % 2 ) // Impares
                        $P .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
                else //Pares
                        $P .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
                $i++;
        }
}



$B = ''; // Bateadores
$i=0;
foreach($Jugadores as $Jugador){
        if($Jugador->posicion != 'P' && !in_array($Jugador,$JugadoresR)){
                if( $i % 2 ) // Impares
                        $B .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td>'.$s.'<input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
                else //Pares
                        $B .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td>'.$s.'<input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
                $i++;
        }

}


if($EquipoR != null)
        $Aux['P'] = '<a class="irAP"><img src="'.$EquipoR->logo.'"  width="50" height="50" /></a>' ;
else
        $Aux['P'] = '<a class="irAP"><img src="assets/images/Fotos_Roster/EquipoDefault.jpg"  width="50" height="50" /></a>' ;

$i=0;
$D = '';
foreach($Jugadores_Roster as $J_R){
        $_POST['id']=$J_R->jugador;
        $Tmp = $instancia->obtener();
        $D .= '
                <div class="a'.$J_R->posicion_jugador.'">
                <div id="imgjugador">
                <img src="'.$Tmp->foto.'" height="100" width="70" />
                </div>
                <table width="240" align="left">
                <tr class="impar">
                <td><p>Nombre:</p></td>
                <td><p>'.$Tmp->nombres.'</p></td>
                </tr>
                <tr class="par">
                <td><p>Posicion:</p></td>
                <td><p>'.$J_R->posicion_jugador.'</p></td>
                </tr>
                <tr class="impar">
                <td><p>Valor:</p></td>
                <td><p>'.$Tmp->precio.'</p></td>
                </tr>
                <tr class="par">
                <td><p>Efectividad:</p></td>
                <td><p>.000</p></td>
                </tr>
                </table>

                <form action="Manejo_Roster.php" method="post">
                <input type="hidden" name="id_Jugador" value="'.$Tmp->id.'">
                <input type="submit" name="Vender" value="Vender Jugador">
                </form>
                <form action="Manejo_Roster.php" method="post">
                <input type="hidden" name="id_Jugador" value="'.$Tmp->id.'">
                <input type="submit" name="Renegociar" value="Renegociar Jugador">
                </form>
                </div> ';
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
        </div> ';

if($EquipoR != null){
        $D .= '
                <div class="aP">
                <div id="imgjugador">
                <img src="'.$EquipoR->logo.'" height="100" width="70" />
                </div>
                <table width="240" align="left">
                <tr class="impar">
                <td><p>Nombre:</p></td>
                <td><p>'.$EquipoR->nombre.'</p></td>
                </tr>
                <tr class="par">
                <td><p>Posicion:</p></td>
                <td><p>P</p></td>
                </tr>
                <tr class="impar">
                <td><p>Valor:</p></td>
                <td><p>'.$EquipoR->precio.'</p></td>
                </tr>
                <tr class="par">
                <td><p>Efectividad:</p></td>
                <td><p>-------</p></td>
                </tr>
                </table>
                <form action="Manejo_Roster.php" method="post">
                <input type="hidden" name="id_Equipo" value="'.$EquipoR->id.'">
                <input type="submit" name="Vender" value="Vender Equipo de Lanzadores">
                </form>
                </div> ';
}

?>

<link rel="stylesheet" href="SpryAssets/SpryAccordion.css"     type="text/css"/>
<link rel="stylesheet" href="assets/styles/style_roster.css"   type="text/css"/>
<link rel="stylesheet" href="assets/styles/style_showinfo.css" type="text/css"/>
<script type="text/javascript" src="SpryAssets/SpryAccordion.js"></script>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/showinfo.js"></script>


<ul id="navigation">
  <li><a href="pruebaRoster.html">Inicio</a></li>
  <li><a href="gestion_jugadores.php">Jugadores</a></li>
  <li><a href="#">Equipos</a></li>
  <li><a href="#">Estadios</a></li>
  <li><a href="#">Mi Perfil</a></li>
  <li><a class="on" href="pruebaRoster.html">Roster</a></li>
  <li><a href="#">Ligas</a></li>
  <li><a href="#">Calendario</a></li>
  <li><a href="#">Resultados</a></li>
  <li><a href="#">Reglas</a></li>
  <li><a href="#">Cont&aacutectenos </a></li>
</ul>
</div>


<div id="content">
  <div id="contenido_roster">

    <div class="toFade">

      <div id="campo_juego">
        <h3>Tu Roster</h3>

        <div id="score_usuario"><?php echo $Manager->puntaje; ?></div>

        <div id="creditos_usuario"><?php echo $Manager-> creditos; ?></div>

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
                <td>Nombre</td>
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
    </div>
    <script type="text/javascript">
        var Accordion1 = new Spry.Widget.Accordion("Accordion1");
    </script>
<?php   echo $D; ?>
  </body>
</html>
