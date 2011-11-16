<?php

require_once("Clases/Jugador.php");
require_once("Clases/Equipo.php");
require_once("Clases/EquipoFachada.php");
require_once("Clases/JugadorFachada.php");

$ID_Jugador = isset($_POST['idjugador'])?$_POST['idjugador']:-1;
$FachadaJ = new JugadorFachada();
$Jugador = $FachadaJ->getJugador($ID_Jugador);

include("static/head.php");
include("static/header.php");



echo '<link rel="stylesheet" href="assets/styles/style_Listar_D_J.css"  type="text/css" />'; 

echo '

	
        <ul id="navigation">
          <li><a href="index.php">Inicio</a></li>
          <li><a class="on" href="gestion_jugadores.php">Jugadores</a></li>
          <li><a href="gestion_equipos.php">Equipos</a></li>
          <li><a href="gestion_estadios.php">Estadios</a></li>
          <li><a href="#">Mi Perfil</a></li>
          <li><a href="#">Roster</a></li>
          <li><a href="#">Ligas</a></li>
          <li><a href="#">Calendario</a></li>
          <li><a href="#">Resultados</a></li>
          <li><a href="#">Reglas</a></li>
          <li><a href="#">Cont&aacutectenos</a></li>
        </ul>
  </div>

	   
	<div id="content">
		<div id="contenido_interno_esta">';
		
		echo '<form id="form" action="Agregar_E.php" method="post">
				<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>
		        <input type="submit" value="Agregar Estadistica" />
		      </form>';
		
		echo '<h2>Estadisticas</h2>';


				  $iterador = $Jugador->getIteratorE();
				  while($iterador->valid()) {
					$Tmp = $iterador->current();
					$Desc = $Tmp-> getArregloDescriptor();
					$Estd = $Tmp-> getArregloEstadisticas();
						echo'
							  <div class="Fila">
									<div class="datos">';
										for($i=0;$i<8;$i++){
											echo '<div>'.$Desc[$i].': '.$Estd[$i].'</div>';
										}
						echo'		</div>
						
									<form action="Modificar_E.php" method="post">
										<input type="hidden" name="fecha"     value="'.$Tmp->getfecha().'"/>
										<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>
										<input type="submit" name="Modificar" value="Modificar Estadistica" />										
									</form>
									
									<form action="Modificar_E.php" method="post">
										<input type="hidden" name="fecha"     value="'.$Tmp->getfecha().'"/>
										<input type="hidden" name="idjugador" value="'.$ID_Jugador.'"/>
										<input type="submit" name="Eliminar" value="Eliminar Estadistica" />																				
									</form>
						
									
							  </div>
							';
					$iterador->next();
				  }
				  
		
		
echo '</div>';
include("static/sideBar.php");
include("static/footer.php");

?>
