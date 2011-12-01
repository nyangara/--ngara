<?php

require_once("Clases/fachadaInterface.php");
$instancia = fachadaInterface::singleton();

//Siempre la Entrada para Especificar el Roster (id)
$ID_Roster  = $_POST['id'];

$_POST['TIPO']='Roster';
$Roster = $instancia->obtener();
unset($_POST);

if($Roster->equipo != -1 ){
    $_POST['TIPO']='Equipo';
    $_POST['id']=$Roster->equipo;
    $_POST['equipo_activo']= true;
    $EquipoR = $instancia->obtener();
    unset($_POST);
}
else 
    $EquipoR = null;

$_POST['TIPO']='tiene';
$_POST['roster']=$Roster->id;
$_POST['jugador_activo']= true;

$tieneJ_R = $instancia->obtenerTodos();
unset($_POST);

$i=0;
$_POST['TIPO']='Jugador';

$JugadoresR = array();
foreach($tieneJ_R as $J_R){
    $_POST['id']=$J_R->jugador;
    $JugadoresR[$i]= $instancia->obtener();
    $i++;
}

$JugadoresR; //Tiene Los Jugadores del Roster
unset($_POST);

?>


<?php

$_POST['TIPO']='Jugador';
$Jugadores = $instancia->obtenerTodos();
$_POST['TIPO']='Equipo';
$Equipos = $instancia->obtenerTodos();

$i=0;
$P = ''; //Equipos de Pitchers
foreach($Equipos as $Equipo){
    if( $i % 2 ) // Pares
        $P .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
    else //Impares
        $P .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Equipo" value="'.$Equipo->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15" />'.$Equipo->nombre.'</td><td>00</td><td>'.$Equipo->precio.'</td></form></tr>';
    $i++;
}


$Re = ''; // Receptores
$If = ''; // Infielders
$Of = ''; // Outfielders
$i=0;
$j=0;
$k=0;
foreach($Jugadores as $Jugador){
    if($Jugador->posicion=='C'){
        if( $i % 2 ) // Pares
            $Re .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        else //Impares
            $Re .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        $i++;
    }
    elseif($Jugador->posicion=='1B' || $Jugador->posicion=='2B' || $Jugador->posicion=='3B' || $Jugador->posicion=='SS'){
        if( $j % 2 ) // Pares
            $If .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        else //Impares
            $If .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';        
     $j++;   
    }
    elseif($Jugador->posicion=='RF' || $Jugador->posicion=='CF' || $Jugador->posicion=='LF'){
        if( $k % 2 ) // Pares
            $Of .= '<tr class="impar"><form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';
        else //Impares
            $Of .= '<tr class="par">  <form action="Manejo_Roster.php" method="post"><input type="hidden" name="id" value="'.$Roster->id.'" /><input type="hidden" name="id_Jugador" value="'.$Jugador->id.'" /><td><input class="imagen" type="image" src="assets/images/Fotos_Roster/Agregar.png" width="15"/>'.$Jugador->nombres.'</td><td>'.$Jugador->posicion.'</td><td>AVG</td><td>'.$Jugador->precio.'</td></form></tr>';                
        $k++;
    }
}



if($EquipoR != null)
    $Aux['P'] = '<img src="'.$EquipoR->logo.'"  width="50" height="50" />' ;
else
    $Aux['P'] = '<img src="assets/images/Fotos_Roster/EquipoDefault.jpg"  width="50" height="50" />' ;



if(count($JugadoresR) > 0)
    foreach($JugadoresR as $Jug)
        $Aux[$Jug->posicion] = '<img src="'.$Jug->foto.'"  width="50" height="50" />' ;


$Aux['DEF'] = '<img src="assets/images/Fotos_Roster/JugadorDefault.jpg"  width="50" height="50" />' ;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Super Sistema 2.0</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="clusterSS, fantasy, beisbol venezolano, liga venezolana de beisbol profesional" />
<meta name="description" content="Proyecto de Fantasy de la liga venezolana de beibol profesional." />


<link rel="stylesheet"    href="assets/styles/style.css"        type="text/css" />
<link rel="stylesheet"    href="assets/styles/Style_Index.css"  type="text/css" />
<!-- AGREGAR ESTE CSS -->
<link rel="stylesheet" href="assets/styles/style_roster.css"  type="text/css" />
<link rel="stylesheet" href="assets/styles/style_showinfo.css"  type="text/css" />

<link rel="Shortcut Icon" href="assets/images/10thinning.ico"/>

<style type="text/css">
body {
	background-image: url(assets/images/background1.png);
}

#sideBar{
	display:none;
}
#login{
	visibility:hidden;
}
</style>

<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/showinfo.js"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>
<body>


<div id="wrapper">
<div id="header">
        <div id="logo">
            <div id="logo_header">
                <div id="logo_carrera">
              <img src="assets/images/LogoGrande.png" alt="logo" width="48" height="48"/> <p id="nombresistema">10th Inning Fantasy</p> 
           	  </div>
       	  </div>
    </div>
<div id="login">
        <form action="#">

         </form>
        <span class="Boton"> <a href="../registro.php"></a></span>    
   	</div>
<div id="updates">
            <span>Novedades:</span></div>
        

        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="#">Equipos</a></li>
          <li><a href="#">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a class="on" href="gestion_rosters.php">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Contactenos </a></li>
        </ul>
</div>

	   
    <div id="content">
        <div id="contenido_roster">

        
            <div id="campo_juego">
                <h3>Tu Roster</h3>
                <div id="LF"><?php $img = (isset($Aux['LF'])) ? $Aux['LF'] : $Aux['DEF']; echo $img; ?></div>
                <div id="CF"><?php $img = (isset($Aux['CF'])) ? $Aux['CF'] : $Aux['DEF']; echo $img; ?></div>
                <div id="RF"><?php $img = (isset($Aux['RF'])) ? $Aux['RF'] : $Aux['DEF']; echo $img; ?></div>
                <div id="SS"><?php $img = (isset($Aux['SS'])) ? $Aux['SS'] : $Aux['DEF']; echo $img; ?></div>
                <div id="B2"><?php $img = (isset($Aux['2B'])) ? $Aux['2B'] : $Aux['DEF']; echo $img; ?></div>
                <div id="B3"><?php $img = (isset($Aux['3B'])) ? $Aux['3B'] : $Aux['DEF']; echo $img; ?></div>
                <div id="B1"><?php $img = (isset($Aux['1B'])) ? $Aux['1B'] : $Aux['DEF']; echo $img; ?></div>
                <div id="P" ><?php $img = (isset($Aux['P']))  ? $Aux['P']  : $Aux['DEF']; echo $img; ?></div>
                <div id="RE"><?php $img = (isset($Aux['C']))  ? $Aux['C']  : $Aux['DEF']; echo $img; ?></div>
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
                  <div class="AccordionPanelTab"><h1>Receptores</h1></div>
                  <div class="AccordionPanelContent">
                      
                        <table width="350" border="0">
                          <tr class="impar">
                            <td>Nombre:</td>
                            <td>Posicion</td>
                            <td>AVG</td>
                            <td>Precio</td>
                          </tr>
                          <?php echo $Re; ?>
                        </table>
                      
                    </div>
                </div>
                <div class="AccordionPanel">
                  <div class="AccordionPanelTab"><h1>Infielders</h1></div>
                  <div class="AccordionPanelContent">
                      
                        <table width="350" border="0">
                          <tr class="impar">
                            <td>Nombre:</td>
                            <td>Posicion</td>
                            <td>AVG</td>
                            <td>Precio</td>
                          </tr>
                          <?php echo $If; ?>
                        </table> 
                      
                  </div>
                </div>
                <div class="AccordionPanel">
                  <div class="AccordionPanelTab"><h1>Outfielders</h1></div>
                  <div class="AccordionPanelContent">
                    
                        <table width="350" border="0">
                          <tr class="impar">
                            <td>Nombre:</td>
                            <td>Posicion</td>
                            <td>AVG</td>
                            <td>Precio</td>
                          </tr>
                          <?php echo $Of; ?>
                        </table>
                       
                  </div>
                </div>
              </div>


            </div>
            

			
			
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
    
    
    
 
</body>
</html>