<?php

include 'Static/head.php';
include 'Static/header.php';

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

if(isset($_SESSION['Manager'])){
    $_POST['manager'] = $_SESSION['Manager'];
}  elseif ($_SESSION['Administrador']) {
    $ID_ROSTER = $_POST['id'];
} else {
    header('Location: index.php');
}

$_POST['TIPO']='Roster';
$Roster = $instancia->obtener();
unset($_POST);

if($Roster->id == -1)
    header('Location: Agregar_R.php');

$_POST['TIPO']='Roster_Equipo';
$_POST['roster']=$Roster->id;
$_POST['equipo_activo']= true;
$Equipo_Roster = $instancia->obtener();
unset($_POST);

if($Equipo_Roster->equipo != -1 ){
    $_POST['TIPO']='Equipo';
    $_POST['id']= $Equipo_Roster->equipo;
    $EquipoR = $instancia->obtener();
} else
    $EquipoR = null;
unset($_POST);

$_POST['TIPO']='Roster_Jugador';
$_POST['roster']=$Roster->id;

$ALGO=$Roster->nombre;

$_POST['jugador_activo']= true;
$Jugadores_Roster = $instancia->obtenerTodos();
unset($_POST);

$i=0;
$_POST['TIPO']='Jugador';
$JugadoresR = array();
foreach($Jugadores_Roster as $J_R){
    $_POST['id']=$J_R->jugador;
    $JugadoresR[$i]= $instancia->obtener();
    $i++;
}
unset($_POST);


?>

<?php
$_POST['TIPO']='Jugador';
$Jugadores = $instancia->obtenerTodos();
$_POST['TIPO']='Equipo';
$Equipos = $instancia->obtenerTodos();

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
    if( $i % 2 ) // Impares
        $P .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
    else //Pares
        $P .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
    $i++;
}


$B = ''; // Bateadores
$i=0;
foreach($Jugadores as $Jugador){
    if($Jugador->posicion != 'P'){
        if( $i % 2 ) // Impares
            $B .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td>'.$s.'<input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        else //Pares
            $B .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td>'.$s.'<input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        $i++;
    }
}

        
if($EquipoR != null)
    $Aux['P'] = '<a class="P"><img src="'.$EquipoR->logo.'"  width="50" height="50" /></a>' ;
else
    $Aux['P'] = '<a class="P"><img src="assets/images/Fotos_Roster/EquipoDefault.jpg"  width="50" height="50" /></a>' ;

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
                                <td><p>'.$Tmp->posicion.'</p></td>
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

?>

<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="assets/styles/style_roster.css"  type="text/css" />
<link rel="stylesheet" href="assets/styles/style_showinfo.css"  type="text/css" />
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/showinfo.js"></script>


 <?php

if(isset($_SESSION['Manager'])){?>
	<ul id="navigation">
    	<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li><a href="gestion_miperfil.php">Mi Perfil</a></li>
        <li  class="on"><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
    </ul>
<?php } elseif(isset($_SESSION['Administrador'])){?>
	<ul id="navigation">
    	<li><a class="on" href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        <li  class="on"><a href="gestion_rosters.php">Roster</a></li>
        <li><a href="#">Ligas</a></li>
        <li><a href="#">Calendario</a></li>
        <li><a href="#">Resultados</a></li>
        <li><a href="#">Reglas</a></li>
        <li><a href="#">Cont&aacutectenos</a></li>
		<li><a class="on" href="gestion_usuarios.php">Usuarios</a></li>
	</ul>
<?php } else { 
		echo '<ul id="navigation">
		<li><a href="index.php">Inicio</a></li>
        <li><a href="gestion_jugadores.php">Jugadores</a></li>
        <li><a href="gestion_equipos.php">Equipos</a></li>
        <li><a href="gestion_estadios.php">Estadios</a></li>
        </ul>';
	}
	?>
</div>

	   
	<div id="content">
            <div id="contenido_roster">

                <div class="toFade">

                    <div id="campo_juego">
                        <h3><?php echo $ALGO ?></h3> 
                    
                        <div id="score_usuario">Score:</div>
                    
                        <div id="creditos_usuario">Creditos:</div>
                          
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
		 
		 
      <div id="sideBar">
			
       </div>
   </div>

	
    <div id="footer"> 
			<span class="logoCluster"></span>
				<div id="contacto">
				<p> Powered by Cluster System Solutions & &Ntildeangara <br />
				Septiembre-Diciembre 2011. </p>
				</div>
			<span class="logoNiangara"></span>
	</div>
	
</div>
<script type="text/javascript">
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
</script>

<?php echo $D; ?>

 
</body>
</html>